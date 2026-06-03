<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $setting = Setting::first();

            $app_setting = [
                'name' => $setting?->app_name ?? config('app.name'),
                'favicon' => $setting?->faviconPath ?? '',
                'logo' => $setting?->logoPath ?? '',
                'currency_position' => $setting?->currency_position ?? 'Left',
                'currency_symbol' => $setting?->currency_symbol ?? '$',
            ];

            $notificationMessages = collect();
            if (\Illuminate\Support\Facades\Auth::check()) {
                $notificationMessages = \App\Models\NotificationInstance::where('recipient_id', \Illuminate\Support\Facades\Auth::id())->get();
            }

            $languages = \App\Models\Language::all();

            $view->with('app_setting', $app_setting);
            $view->with('layout_path', 'layouts.app');
            $view->with('storageLink', !file_exists(public_path('storage')));
            $view->with('notificationMessages', $notificationMessages);
            $view->with('languages', $languages);
        });
    }
}
