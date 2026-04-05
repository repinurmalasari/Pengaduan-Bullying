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

        .register-card {
            display: flex;
            width: 100%;
            overflow: hidden;
            flex-wrap: nowrap;
        }

        .register-left {
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

        .register-left::before {
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

        .register-left::after {
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

        .btn-login {
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

        .btn-login:hover {
            background: white;
            color: #5B8BC5;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .register-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            background: white;
            border-radius: 0 16px 16px 0;
        }

        .register-form-container {
            width: 100%;
            max-width: 380px;
        }

        .register-form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            text-align: left;
        }

        .register-form-subtitle {
            font-size: 14px;
            font-weight: 400;
            color: #718096;
            margin-bottom: 25px;
            text-align: left;
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

        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(135deg, #4A7AB5 0%, #3A6AA5 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91, 139, 197, 0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link p {
            font-size: 13px;
            color: #4a5568;
            margin: 0;
        }

        .login-link a {
            color: #5B8BC5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #4A7AB5;
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

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column !important;
                max-width: 100% !important;
                margin: 0 auto !important;
            }

            .register-card {
                flex-direction: column;
                width: 100%;
            }

            .register-left {
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

            .register-right {
                flex: 0 0 auto;
                border-radius: 0 0 16px 16px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                padding: 35px 25px;
                width: 100%;
                order: 1;
            }

            .register-form-container {
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

            .btn-login {
                padding: 9px 26px;
                font-size: 13px;
            }

            .register-form-title {
                font-size: 24px;
                margin-bottom: 6px;
            }

            .register-form-subtitle {
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

            .login-link {
                margin-top: 12px;
                padding-top: 10px;
            }

            .login-link p {
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
        }

        @media (max-width: 480px) {
            .register-card {
                flex-direction: column;
            }

            .register-left {
                border-bottom-left-radius: 60px 30px;
                border-bottom-right-radius: 60px 30px;
                padding: 35px 20px;
                order: -1;
            }

            .register-right {
                padding: 25px 20px;
                order: 1;
            }

            .register-form-container {
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

            .btn-login {
                padding: 8px 24px;
                font-size: 12px;
            }

            .register-form-title {
                font-size: 22px;
                margin-bottom: 5px;
            }

            .register-form-subtitle {
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

            .btn-register {
                padding: 10px 20px;
                font-size: 13px;
                margin-top: 6px;
            }

            .login-link {
                margin-top: 10px;
                padding-top: 8px;
            }

            .login-link p {
                font-size: 11px;
            }
        }
    </style>

    <div class="register-card">
        <!-- Left Section -->
        <div class="register-left">
            <div class="left-content">
                <h1>Pengaduan Bullying</h1>
                <p>Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="register-right">
            <div class="register-form-container">
                <h2 class="register-form-title">Daftar</h2>
                <p class="register-form-subtitle">Buat akun baru Anda</p>

                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Nama') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Masukkan nama lengkap Anda"
                               required autofocus autocomplete="name" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="Masukkan alamat email Anda"
                               required autocomplete="username" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Buat password Anda"
                               required autocomplete="new-password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="Konfirmasi password Anda"
                               required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->  
                    <button type="submit" class="btn-register">
                        {{ __('Daftar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>