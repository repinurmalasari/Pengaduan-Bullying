<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kelas - SafeSchool</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            padding: 40px;
            animation: slideUp 0.4s ease;
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

        .back-button {
            background: none;
            border: none;
            color: #5B8BC5;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
            padding: 8px 0;
            transition: all 0.2s;
        }

        .back-button:hover {
            color: #4A7AB5;
            gap: 10px;
        }

        h1 {
            text-align: center;
            color: #1f2937;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 24px;
            font-size: 15px;
        }

        .info-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1e40af;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .class-label {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            display: block;
            font-size: 16px;
        }

        .class-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .class-option {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: #4b5563;
            font-size: 16px;
        }

        .class-option:hover {
            border-color: #5B8BC5;
            background: #f8f9ff;
            transform: scale(1.05);
        }

        .class-option.selected {
            border-color: #5B8BC5;
            background: #5B8BC5;
            color: white;
            box-shadow: 0 4px 12px rgba(91, 139, 197, 0.3);
        }

        .jurusan-option {
            padding: 14px;
            font-size: 14px;
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .jurusan-code {
            font-weight: 700;
            font-size: 16px;
        }

        .jurusan-name {
            font-size: 12px;
            opacity: 0.8;
            font-weight: 500;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: #9ca3af;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 12px;
        }

        .custom-input-wrapper {
            position: relative;
        }

        .custom-class {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .custom-class:focus {
            outline: none;
            border-color: #5B8BC5;
            box-shadow: 0 0 0 4px rgba(91, 139, 197, 0.1);
        }

        .custom-class::placeholder {
            color: #9ca3af;
        }

        .btn-continue {
            width: 100%;
            background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-continue:hover:not(:disabled) {
            background: linear-gradient(135deg, #4A7AB5 0%, #3A6AA5 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91, 139, 197, 0.3);
        }

        .btn-continue:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .arrow {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .btn-continue:hover:not(:disabled) .arrow {
            transform: translateX(4px);
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="goBack()">
            <span>←</span>
            <span>Kembali</span>
        </button>

        <h1 id="pageTitle">Pilih Kelas Anda</h1>
        <p class="subtitle" id="pageSubtitle">Tentukan kelas tempat Anda bersekolah</p>

        <div class="info-badge">
            <span>🏫</span>
            <span>SMK - Sekolah Menengah Kejuruan</span>
        </div>

        <!-- Tingkat Kelas Selection -->
        <label class="class-label">Tingkat Kelas</label>
        <div class="class-grid">
            <div class="class-option" onclick="selectTingkat(this, 'X')">Kelas X</div>
            <div class="class-option" onclick="selectTingkat(this, 'XI')">Kelas XI</div>
            <div class="class-option" onclick="selectTingkat(this, 'XII')">Kelas XII</div>
        </div>

        <!-- Jurusan Selection -->
        <div id="jurusanSection" class="section">
            <label class="class-label">Pilih Jurusan</label>
            <div class="class-grid" style="grid-template-columns: repeat(2, 1fr);">
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'GP/TGP')">
                    <span class="jurusan-code">GP / TGP</span>
                    <span class="jurusan-name">Geologi Pertambangan / Teknik Geologi Pertambangan</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'TKJ/TJKT')">
                    <span class="jurusan-code">TKJ / TJKT</span>
                    <span class="jurusan-name">Teknik Komputer Jaringan / Teknik Jaringan Komputer dan Telekomunikasi</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'RPL/PPLG')">
                    <span class="jurusan-code">RPL / PPLG</span>
                    <span class="jurusan-name">Rekayasa Perangkat Lunak / Pengembangan Perangkat Lunak dan Gim</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'TEIN')">
                    <span class="jurusan-code">TEIN</span>
                    <span class="jurusan-name">Teknik Elektronika Industri / Teknik Elektronika</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'TPMP')">
                    <span class="jurusan-code">TPMP</span>
                    <span class="jurusan-name">Teknik Pengolahan Migas dan Petrokimia / Teknik Perminyakan</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'TKR')">
                    <span class="jurusan-code">TKR</span>
                    <span class="jurusan-name">Teknik Kendaraan Ringan / Teknik Otomotif</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'UPW')">
                    <span class="jurusan-code">UPW</span>
                    <span class="jurusan-name">Usaha Perjalanan Wisata / Usaha Layanan Pariwisata</span>
                </div>
                <div class="class-option jurusan-option" onclick="selectJurusan(this, 'MM/BDP')">
                    <span class="jurusan-code">MM / BDP</span>
                    <span class="jurusan-name">Multimedia / Broadcasting dan Perfilman</span>
                </div>
            </div>
        </div>

        <!-- Sub-kelas Selection -->
        <div id="subkelasSection" class="section">
            <label class="class-label">Pilih Sub-Kelas</label>
            <div class="class-grid">
                <div class="class-option" onclick="selectSubkelas(this, 'A')">A</div>
                <div class="class-option" onclick="selectSubkelas(this, 'B')">B</div>
                <div class="class-option" onclick="selectSubkelas(this, 'C')">C</div>
            </div>
        </div>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="custom-input-wrapper">
            <input 
                type="text" 
                class="custom-class" 
                id="customClass" 
                placeholder="Ketik kelas lain (contoh: X TKJ 1)"
                oninput="handleCustomClass()"
            >
        </div>

        <button class="btn-continue" id="btnContinue" onclick="submitClass()" disabled>
            <span>Lanjutkan ke Dashboard</span>
            <span class="arrow">→</span>
        </button>
    </div>

    <script>
        // Get role from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const role = urlParams.get('role') || 'siswa';

        // Update title based on role
        if (role === 'siswa') {
            document.getElementById('pageTitle').textContent = 'Pilih Kelas Anda';
            document.getElementById('pageSubtitle').textContent = 'Tentukan kelas tempat Anda bersekolah';
        } else if (role === 'guru') {
            document.getElementById('pageTitle').textContent = 'Pilih Kelas';
            document.getElementById('pageSubtitle').textContent = 'Tentukan kelas yang Anda tangani';
        } else if (role === 'wali') {
            document.getElementById('pageTitle').textContent = 'Pilih Kelas';
            document.getElementById('pageSubtitle').textContent = 'Tentukan kelas yang Anda ampu';
        }

        let selectedTingkat = '';
        let selectedJurusan = '';
        let selectedSubkelas = '';
        let finalClass = '';

        function goBack() {
            // Kembali ke halaman role selection
            window.history.back();
            // Atau bisa menggunakan:
            // window.location.href = 'role-selection.html';
        }

        function selectTingkat(element, tingkat) {
            selectedTingkat = tingkat;
            selectedJurusan = '';
            selectedSubkelas = '';
            
            // Clear custom input
            document.getElementById('customClass').value = '';
            
            // Update selected state for tingkat
            const parent = element.parentElement;
            parent.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            element.classList.add('selected');
            
            // Show jurusan section
            const jurusanSection = document.getElementById('jurusanSection');
            const subkelasSection = document.getElementById('subkelasSection');
            
            jurusanSection.classList.add('active');
            subkelasSection.classList.remove('active');
            
            // Reset jurusan and subkelas selection
            jurusanSection.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            subkelasSection.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            updateFinalClass();
        }

        function selectJurusan(element, jurusan) {
            selectedJurusan = jurusan;
            
            // Update selected state
            const parent = element.parentElement;
            parent.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            element.classList.add('selected');
            
            // Show subkelas section
            const subkelasSection = document.getElementById('subkelasSection');
            subkelasSection.classList.add('active');
            
            // Reset subkelas selection
            subkelasSection.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            selectedSubkelas = '';
            
            updateFinalClass();
        }

        function selectSubkelas(element, subkelas) {
            selectedSubkelas = subkelas;
            
            // Update selected state
            const parent = element.parentElement;
            parent.querySelectorAll('.class-option').forEach(option => {
                option.classList.remove('selected');
            });
            element.classList.add('selected');
            
            updateFinalClass();
        }

        function updateFinalClass() {
            // Build final class string for SMK
            if (selectedTingkat && selectedJurusan && selectedSubkelas) {
                finalClass = `${selectedTingkat} ${selectedJurusan} ${selectedSubkelas}`;
                document.getElementById('btnContinue').disabled = false;
            } else {
                finalClass = '';
                document.getElementById('btnContinue').disabled = true;
            }
        }

        function handleCustomClass() {
            const customInput = document.getElementById('customClass');
            const customValue = customInput.value.trim();
            
            if (customValue) {
                finalClass = customValue;
                
                // Clear grid selections
                document.querySelectorAll('.class-option').forEach(option => {
                    option.classList.remove('selected');
                });
                
                // Hide sections
                document.getElementById('jurusanSection').classList.remove('active');
                document.getElementById('subkelasSection').classList.remove('active');
                
                // Reset selections
                selectedTingkat = '';
                selectedJurusan = '';
                selectedSubkelas = '';
                
                document.getElementById('btnContinue').disabled = false;
            } else {
                finalClass = '';
                document.getElementById('btnContinue').disabled = true;
            }
        }

        function submitClass() {
            if (finalClass) {
                // Simpan data ke localStorage
                localStorage.setItem('userRole', role);
                localStorage.setItem('userClass', finalClass);
                
                // Redirect ke dashboard
                window.location.href = 'dashboard.html';
                
                // Untuk demo, tampilkan alert
                const roleText = role === 'wali' ? 'Wali Kelas' : 
                                 role === 'guru' ? 'Guru BK' : 'Siswa';
                alert(`Melanjutkan sebagai ${roleText} kelas ${finalClass} ke dashboard...`);
            }
        }
    </script>
</body>
</html>