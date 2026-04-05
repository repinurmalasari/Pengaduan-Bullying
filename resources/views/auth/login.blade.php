<x-guest-layout>
    <style>
        .auth-card {
            max-width: 900px !important;
            border-radius: 16px !important;
            overflow: hidden !important;
            box-shadow: 0 10px 40px rgba(91, 139, 197, 0.15) !important;
            display: flex !important;
            flex-direction: row !important;
            background: white !important;
            width: 100% !important;
        }

        .auth-header {
            display: none !important;
        }

        .auth-body {
            padding: 0 !important;
            flex: 1 !important;
        }

        .auth-container {
            padding: 20px !important;
            width: 100% !important;
        }

        body {
            background-color: #f5f7fa !important;
            min-height: 100vh !important;
        }

        .login-card {
            display: flex;
            width: 100%;
            overflow: hidden;
            flex-wrap: nowrap;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 30px;
            position: relative;
            overflow: visible;
            border-radius: 0;
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
            border-top-right-radius: 100px 50px;
            border-bottom-right-radius: 100px 50px;
            min-width: 280px;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -50px;
            left: -50px;
            z-index: 0;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -40px;
            right: -40px;
            z-index: 0;
        }

        .left-content {
            text-align: center;
            color: white;
            position: relative;
            z-index: 1;
        }

        .left-content h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .left-content p {
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 25px;
            opacity: 0.95;
        }

        .btn-register {
            display: inline-block;
            border: 2px solid white;
            color: white;
            padding: 10px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: transparent;
        }

        .btn-register:hover {
            background: white;
            color: #5B8BC5;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            background: white;
            border-radius: 0 16px 16px 0;
        }

        .login-form-container {
            width: 100%;
            max-width: 380px;
        }

        .login-form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            text-align: left;
        }

        .login-form-subtitle {
            font-size: 14px;
            font-weight: 400;
            color: #718096;
            margin-bottom: 25px;
            text-align: left; /* Rata kiri */
            line-height: 1.5;
        }


        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 7px;
            display: block;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            color: #2d3748;
            width: 100%;
        }

        .form-control:focus {
            border-color: #5B8BC5;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(91, 139, 197, 0.1);
            color: #2d3748;
            outline: none;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .form-control.is-invalid,
        .form-control.is-invalid:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            font-weight: 500;
        }

        .form-link {
            color: #5B8BC5;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form-link:hover {
            color: #4A7AB5;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
            border: none;
            border-radius: 8px;
            padding: 11px 24px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4A7AB5 0%, #3A6AA5 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91, 139, 197, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .g-recaptcha {
            display: flex;
            justify-content: center;
            margin: 15px 0;
            transform: scale(0.9);
            transform-origin: top center;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 18px 0;
            color: #cbd5e1;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e2e8f0;
        }

        .divider-text {
            padding: 0 10px;
            font-size: 12px;
            color: #718096;
            font-weight: 500;
        }

        .social-login {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 15px;
        }

        .social-btn {
            width: 42px;
            height: 42px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            color: #2d3748;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: #5B8BC5;
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
        }

        .register-link p {
            font-size: 13px;
            color: #4a5568;
            margin: 0;
        }

        .register-link a {
            color: #5B8BC5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #4A7AB5;
        }

        .session-status {
            padding: 10px 12px;
            background-color: #dcfce7;
            border: 1px solid #86efac;
            border-radius: 8px;
            color: #166534;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #5B8BC5;
            border: 1.5px solid #e2e8f0;
            border-radius: 4px;
        }

        .form-check-label {
            font-size: 13px;
            color: #4a5568;
            cursor: pointer;
            font-weight: 500;
            margin: 0;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column !important;
                max-width: 100% !important;
                margin: 0 auto !important;
            }

            .login-card {
                flex-direction: column;
                width: 100%;
            }

            .login-left {
                flex: 0 0 auto;
                border-top-left-radius: 16px;
                border-top-right-radius: 16px;
                border-bottom-left-radius: 80px 40px;
                border-bottom-right-radius: 80px 40px;
                padding: 40px 25px;
                min-width: auto;
                width: 100%;
                order: -1;
            }

            .login-right {
                flex: 0 0 auto;
                border-radius: 0 0 16px 16px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                padding: 35px 25px;
                width: 100%;
                order: 1;
            }

            .login-form-container {
                max-width: 100%;
            }

            .left-content h1 {
                font-size: 26px;
                margin-bottom: 8px;
            }

            .left-content p {
                font-size: 13px;
                margin-bottom: 18px;
            }

            .btn-register {
                padding: 9px 26px;
                font-size: 13px;
            }

            .login-form-title {
                font-size: 24px;
                margin-bottom: 6px;
            }

            .login-form-subtitle {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .form-label {
                font-size: 12px;
            }

            .form-control {
                padding: 9px 11px;
                font-size: 13px;
            }

            .remember-forgot {
                flex-direction: row;
                justify-content: space-between;
                gap: 10px;
                margin-top: 12px;
                margin-bottom: 12px;
            }

            .form-link {
                font-size: 12px;
            }

            .form-check-label {
                font-size: 12px;
            }

            .divider {
                margin: 15px 0;
            }

            .divider-text {
                font-size: 11px;
            }

            .social-login {
                gap: 10px;
                margin-top: 12px;
            }

            .social-btn {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }

            .register-link {
                margin-top: 12px;
                padding-top: 10px;
            }

            .register-link p {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                flex-direction: column;
            }

            .login-left {
                border-bottom-left-radius: 60px 30px;
                border-bottom-right-radius: 60px 30px;
                padding: 35px 20px;
                order: -1;
            }

            .login-right {
                padding: 25px 20px;
                order: 1;
            }

            .login-form-container {
                width: 100%;
                max-width: 100%;
            }

            .left-content h1 {
                font-size: 24px;
                margin-bottom: 6px;
            }

            .left-content p {
                font-size: 12px;
                margin-bottom: 16px;
            }

            .btn-register {
                padding: 8px 24px;
                font-size: 12px;
            }

            .login-form-title {
                font-size: 22px;
                margin-bottom: 5px;
            }

            .login-form-subtitle {
                font-size: 12px;
                margin-bottom: 18px;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-label {
                font-size: 11px;
                margin-bottom: 5px;
            }

            .form-control {
                padding: 8px 10px;
                font-size: 12px;
            }

            .remember-forgot {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .form-check-input {
                width: 14px;
                height: 14px;
            }

            .form-check-label {
                font-size: 11px;
                gap: 4px;
            }

            .form-link {
                font-size: 11px;
                align-self: flex-start;
            }

            .btn-login {
                padding: 10px 20px;
                font-size: 13px;
                margin-top: 6px;
            }

            .divider {
                margin: 12px 0;
            }

            .divider-text {
                font-size: 10px;
                padding: 0 8px;
            }

            .social-login {
                gap: 8px;
                margin-top: 10px;
            }

            .social-btn {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }

            .register-link {
                margin-top: 10px;
                padding-top: 8px;
            }

            .register-link p {
                font-size: 11px;
            }

            .session-status {
                padding: 8px 10px;
                font-size: 12px;
            }

            .g-recaptcha {
                transform: scale(0.85);
                transform-origin: top center;
                margin: 8px 0;
            }
        }
    </style>

    <div class="login-card">
        <!-- Left Section -->
        <div class="login-left">
            <div class="left-content">
                <h1>Pengaduan Bullying</h1>
                <p>Tidak punya akun?</p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                @endif
            </div>
        </div>

        <!-- Right Section -->
        <div class="login-right">
            <div class="login-form-container">
                <h2 class="login-form-title">Login</h2>
                <p class="login-form-subtitle">Masuk menggunakan akun Anda</p>

                <!-- Session Status -->
                <x-auth-session-status class="session-status" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="Masukkan email Anda"
                               required autofocus autocomplete="username" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password Anda"
                               required autocomplete="current-password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Footer -->
                    <div class="remember-forgot">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input" />
                            <label for="remember" class="form-check-label">{{ __('Ingatkan saya') }}</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="form-link" href="{{ route('password.request') }}">
                                {{ __('Lupa kata sandi?') }}
                            </a>
                        @endif
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->  
                    <button type="submit" class="btn-login" id="loginButton" disabled style="opacity: 0.6; cursor: not-allowed;">
                        {{ __('Login') }}
                    </button>
                </form>

                <script>
                    // Enable login button only after reCAPTCHA is checked and all fields are filled
                    function checkLoginButton() {
                        const loginButton = document.getElementById('loginButton');
                        const email = document.getElementById('email').value.trim();
                        const password = document.getElementById('password').value.trim();
                        const recaptcha = document.querySelector('.g-recaptcha-response')?.value;
                        if (email && password && recaptcha) {
                            loginButton.disabled = false;
                            loginButton.style.opacity = '1';
                            loginButton.style.cursor = 'pointer';
                        } else {
                            loginButton.disabled = true;
                            loginButton.style.opacity = '0.6';
                            loginButton.style.cursor = 'not-allowed';
                        }
                    }

                    function onRecaptchaSuccess() {
                        checkLoginButton();
                    }

                    window.onload = function() {
                        const recaptchaElement = document.querySelector('.g-recaptcha');
                        if (recaptchaElement) {
                            recaptchaElement.setAttribute('data-callback', 'onRecaptchaSuccess');
                        }
                        document.getElementById('email').addEventListener('input', checkLoginButton);
                        document.getElementById('password').addEventListener('input', checkLoginButton);
                        setInterval(checkLoginButton, 500); // fallback for recaptcha async
                    };
                </script>
            </div>
        </div>
    </div>
</x-guest-layout>