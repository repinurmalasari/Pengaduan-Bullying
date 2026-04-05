<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(26, 77, 143, 0.15);
            overflow: hidden;
            max-width: 480px;
        }

        .auth-header {
            background: linear-gradient(135deg, #5a8fb8 0%, #4a7ba7 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .auth-header-logo {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(10px);
        }

        .auth-header-logo img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .auth-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: white;
        }

        .auth-header p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .auth-body {
            padding: 40px 30px;
        }

        @media (max-width: 768px) {
            .auth-header {
                padding: 30px 20px;
            }

            .auth-header h1 {
                font-size: 24px;
            }

            .auth-body {
                padding: 30px 20px;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="auth-container">
        <div class="auth-card mx-auto">
            <div class="auth-header">
                <h1>Login Sistem Pengaduan</h1>
                <p>Masuk menggunakan akun Anda</p>
            </div>
            <div class="auth-body">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
