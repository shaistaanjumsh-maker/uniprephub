<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="">

    <title>@yield('title', 'Super Admin | Login')</title>
    <link rel="shortcut icon" href="{{ $app_setting['favicon'] }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f0ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0e6ff 0%, #ffffff 60%, #e8d5ff 100%);
            padding: 20px;
        }

        .login-card {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(181, 77, 255, 0.15);
            background: #fff;
        }

        /* ---- Left Panel ---- */
        .login-left {
            flex: 1;
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            margin-bottom: 28px;
        }

        .login-logo img {
            height: 44px;
            object-fit: contain;
        }

        .login-heading {
            font-size: 1.65rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .login-sub {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 32px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        .modern-input {
            border-radius: 10px;
            border: 1.5px solid #e0d4f7;
            padding: 12px 16px;
            font-size: 0.9rem;
            color: #333;
            background: #fafafa;
            transition: all 0.2s ease;
            width: 100%;
        }

        .modern-input:focus {
            outline: none;
            border-color: #b54dff;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(181, 77, 255, 0.12);
        }

        .password-wrap {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: #b54dff; }

        .btn-login {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #b54dff, #8a2be2);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            margin-top: 8px;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 16px rgba(181, 77, 255, 0.35);
        }

        .btn-login:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        .text-danger.small { font-size: 0.78rem; margin-top: 4px; display: block; }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f3e8ff;
            color: #8a2be2;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 18px;
            letter-spacing: 0.4px;
        }

        .admin-badge i { font-size: 0.8rem; }

        /* ---- Right Panel ---- */
        .login-right {
            width: 42%;
            background: linear-gradient(160deg, #b54dff 0%, #6a0dad 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-right::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .login-right::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .login-right img {
            width: 85%;
            max-width: 280px;
            object-fit: contain;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.2));
        }

        .right-title {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
            margin-top: 24px;
            position: relative;
            z-index: 1;
        }

        .right-sub {
            color: rgba(255,255,255,0.75);
            font-size: 0.82rem;
            margin-top: 8px;
            position: relative;
            z-index: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-right { display: none; }
            .login-left { padding: 36px 28px; }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">

            {{-- Left: Login Form --}}
            <div class="login-left">

                <div class="login-logo">
                    @if ($app_setting['logo'])
                        <img src="{{ $app_setting['logo'] }}" alt="Logo">
                    @else
                        <img src="{{ asset('assets/images/auth/logo.png') }}" alt="Logo">
                    @endif
                </div>

                <div class="admin-badge">
                    <i class="bi bi-shield-lock-fill"></i>
                    Super Admin Portal
                </div>

                <h2 class="login-heading">{{ __('Welcome Back') }}</h2>
                <p class="login-sub">{{ __('Sign in to your admin account to continue') }}</p>

                <form action="{{ route('admin.authenticate') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email"
                            class="modern-input"
                            placeholder="admin@example.com"
                            value="{{ old('email') }}"
                            autocomplete="email">
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">{{ __('Password') }}</label>
                        <div class="password-wrap">
                            <input type="password" name="password" id="passwordInput"
                                class="modern-input"
                                placeholder="{{ __('Enter your password') }}"
                                autocomplete="current-password">
                            <i class="fa-solid fa-eye-slash toggle-password" id="togglePassword"
                                onclick="togglePasswordView()"></i>
                        </div>
                        @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="loginBtn" onclick="showLoader()" class="btn-login">
                        {{ __('Sign In') }}
                        <span id="is-loading" class="d-none ms-2">
                            <span class="spinner-grow text-white" style="width:6px;height:6px;"></span>
                            <span class="spinner-grow text-white" style="width:6px;height:6px;"></span>
                            <span class="spinner-grow text-white" style="width:6px;height:6px;"></span>
                        </span>
                    </button>
                </form>

            </div>

            {{-- Right: Illustration --}}
            <div class="login-right">
                <img src="{{ asset('assets/images/auth/login.png') }}" alt="Admin Illustration">
                <p class="right-title">{{ $app_setting['name'] ?? config('app.name') }}</p>
                <p class="right-sub">{{ __('Manage your platform with full control and insights') }}</p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePasswordView() {
            const icon = document.getElementById('togglePassword');
            const input = document.getElementById('passwordInput');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        function showLoader() {
            const loader = document.getElementById('is-loading');
            loader.classList.remove('d-none');
            setTimeout(() => loader.classList.add('d-none'), 5000);
        }
    </script>

    @if (session('verification-error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('verification-error') }}",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    @endif

    @if (session('account-created'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('account-created') }}",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    @endif

    @if (session('account-suspended'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Account Has Been Suspended',
                html: "{{ session('account-suspended') }}",
                footer: '<a href="{{ url('/contact-us') }}">Contact support team?</a>'
            });
        </script>
    @endif

</body>
</html>