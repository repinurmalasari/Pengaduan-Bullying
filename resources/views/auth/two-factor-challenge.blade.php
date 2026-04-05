<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi 2FA - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <style>
        body {
            background: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .challenge-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 420px;
            width: 100%;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .challenge-header {
            background: linear-gradient(135deg, #4A7AB5, #5B8BC5);
            padding: 40px 30px;
            text-align: center;
        }
        .challenge-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .challenge-icon i {
            font-size: 36px;
            color: white;
        }
        .challenge-header h2 {
            color: white;
            font-weight: 600;
            margin: 0 0 8px 0;
        }
        .challenge-header p {
            color: rgba(255,255,255,0.9);
            margin: 0;
            font-size: 14px;
        }
        .challenge-body {
            padding: 30px;
        }
        .code-input {
            font-size: 32px !important;
            letter-spacing: 12px !important;
            text-align: center !important;
            font-weight: bold !important;
            padding: 15px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
        }
        .code-input:focus {
            border-color: #4A7AB5 !important;
            box-shadow: 0 0 0 4px rgba(74,122,181,0.1) !important;
        }
        .btn-verify {
            background: linear-gradient(135deg, #4A7AB5, #5B8BC5);
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74,122,181,0.4);
        }
        .recovery-toggle {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="challenge-card">
        <div class="challenge-header">
            <div class="challenge-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2>Verifikasi 2FA</h2>
            <p>Masukkan kode yang dikirim ke email Anda</p>
        </div>
        
        <div class="challenge-body">
            @if($errors->any())
                <div class="alert alert-danger" style="border-radius: 10px;">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning" style="border-radius: 10px;">
                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
                </div>
            @endif
            
            <form action="{{ route('two-factor.challenge.verify') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <input type="text" name="code" 
                           class="form-control code-input" 
                           placeholder="------"
                           maxlength="10"
                           autocomplete="off"
                           autofocus required>
                    <small class="text-muted d-block text-center mt-2">
                        Masukkan 6 digit kode atau recovery code (10 karakter)
                    </small>
                </div>
                
                <button type="submit" class="btn btn-primary btn-verify btn-block">
                    <i class="fas fa-unlock mr-2"></i>Verifikasi & Login
                </button>
            </form>
            
            <div class="recovery-toggle">
                <p class="text-muted small mb-2">Tidak punya akses ke email?</p>
                <a href="#" class="text-primary small" data-toggle="collapse" data-target="#recoveryInfo">
                    <i class="fas fa-key mr-1"></i>Gunakan Recovery Code
                </a>
                <div id="recoveryInfo" class="collapse mt-3">
                    <div class="alert alert-info small" style="border-radius: 10px;">
                        <i class="fas fa-info-circle mr-2"></i>
                        Masukkan salah satu recovery code 10 karakter yang Anda simpan saat mengaktifkan 2FA.
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted small">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Login
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
