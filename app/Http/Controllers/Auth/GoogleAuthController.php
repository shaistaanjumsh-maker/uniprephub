<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $exception) {
            Log::error('Google OAuth callback failed: ' . $exception->getMessage());
            return redirect('/login?social_error=' . urlencode('Google authentication failed. Please try again.'));
        }

        if (!$googleUser || !$googleUser->getEmail()) {
            return redirect('/login?social_error=' . urlencode('Google did not return a valid email address.'));
        }

        $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

        if ($user) {
            if ($user->deleted_at) {
                return redirect('/login?social_error=' . urlencode('Your account is suspended. Please contact support.'));
            }

            if ($user->is_admin || $user->hasRole('admin') || $user->is_org || $user->hasRole('organization') || $user->instructor || $user->hasRole('instructor')) {
                return redirect('/login?social_error=' . urlencode('Google sign-in is only available for student accounts.'));
            }

            $user->provider_name = 'google';
            $user->provider_id = $googleUser->getId();
            $user->name = $user->name ?: $googleUser->getName() ?: $googleUser->getNickname();
            $user->email_verified_at = $user->email_verified_at ?: now();
            if (!$user->password) {
                $user->password = Hash::make(uniqid('google_', true));
            }
            $user->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(uniqid('google_', true)),
                'provider_name' => 'google',
                'provider_id' => $googleUser->getId(),
                'email_verified_at' => now(),
                'is_active' => true,
            ]);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $exception) {
            Log::error('Google OAuth JWT generation failed: ' . $exception->getMessage());
            return redirect('/login?social_error=' . urlencode('Unable to create authentication token. Please try again.'));
        }

        return view('auth.google-callback', [
            'token' => $token,
            'user' => $user,
        ]);
    }
}
