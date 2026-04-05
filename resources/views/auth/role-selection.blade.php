<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Peran - SafeSchool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            max-width: 520px;
            width: 100%;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            animation: slideUp .4s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== SUCCESS ICON ANIMATION ===== */
        .success-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,#5B8BC5,#4A7AB5);
            box-shadow: 0 8px 24px rgba(91,139,197,.4);
            animation: pop .6s ease;
        }

        .success-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 3px solid rgba(91,139,197,.7);
            animation: ripple 2s infinite;
        }

        @keyframes pop {
            0% { transform: scale(0); opacity: 0; }
            60% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        .success-wrapper i {
            color: white;
            font-size: 42px;
            z-index: 1;
        }

        h1 {
            text-align: center;
            font-size: 26px;
            color: #1f2937;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }

        /* ===== ROLE CARD ===== */
        .role-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            display: flex;
            gap: 15px;
            cursor: pointer;
            margin-bottom: 12px;
            transition: .3s;
        }

        .role-card:hover {
            border-color: #5B8BC5;
            background: #f8f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(91,139,197,.15);
        }

        .role-card.selected {
            border-color: #5B8BC5;
            background: #e8f0f8;
        }

        .role-card input {
            accent-color: #5B8BC5;
            margin-top: 4px;
        }

        .role-icon {
            width: 48px;
            height: 48px;
            background: #f3f4f6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #374151;
        }

        .role-title {
            font-weight: 600;
            margin-bottom: 4px;
            color: #1f2937;
        }

        .role-desc {
            font-size: 14px;
            color: #6b7280;
        }

        /* ===== BUTTON ===== */
        .btn-submit {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #cbd5e1;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: not-allowed;
            transition: .3s;
        }

        .btn-submit.active {
            background: linear-gradient(135deg,#5B8BC5,#4A7AB5);
            cursor: pointer;
        }

        .btn-submit.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91,139,197,.3);
        }
    </style>
</head>
<body>

<div class="container">

    <div class="success-wrapper">
        <i class="fas fa-check-circle"></i>
    </div>

    <h1>Pendaftaran Berhasil!</h1>
    <p class="subtitle">Selamat datang, {{ auth()->user()->name }}</p>

    <form method="POST" action="{{ route('role.store') }}">
        @csrf

        <div class="role-card" onclick="selectRole(this)">
            <input type="radio" name="role" value="siswa">
            <div class="role-icon"><i class="fas fa-user-graduate"></i></div>
            <div>
                <div class="role-title">Siswa</div>
                <div class="role-desc">Melaporkan atau memantau kasus bullying</div>
            </div>
        </div>

        <div class="role-card" onclick="selectRole(this)">
            <input type="radio" name="role" value="guru_bk">
            <div class="role-icon"><i class="fas fa-user-tie"></i></div>
            <div>
                <div class="role-title">Guru BK</div>
                <div class="role-desc">Menangani laporan bullying siswa</div>
            </div>
        </div>

        <div class="role-card" onclick="selectRole(this)">
            <input type="radio" name="role" value="wali_kelas">
            <div class="role-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="role-title">Wali Kelas</div>
                <div class="role-desc">Bertanggung jawab atas siswa kelas</div>
            </div>
        </div>

        @error('role')
            <p style="color:red;margin-top:10px">{{ $message }}</p>
        @enderror

        <button type="submit" id="btnSubmit" class="btn-submit" disabled>
            Lanjutkan <i class="fas fa-arrow-right me-2"></i> 
        </button>
    </form>
</div>

<script>
    function selectRole(card) {
        document.querySelectorAll('.role-card').forEach(c => {
            c.classList.remove('selected');
            c.querySelector('input').checked = false;
        });

        card.classList.add('selected');
        card.querySelector('input').checked = true;

        const btn = document.getElementById('btnSubmit');
        btn.classList.add('active');
        btn.disabled = false;
    }
</script>

</body>
</html>
