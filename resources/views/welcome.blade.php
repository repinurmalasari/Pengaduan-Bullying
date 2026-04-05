<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Pengaduan Siswa - SMK Negeri 1 Padaherang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <style>
        /* ===== BASE ===== */
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
        }

        /* ===== HEADER / NAVBAR ===== */
        .header-section {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: relative;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-width: 0; /* prevent overflow */
        }

        .navbar-logo {
            width: 60px;
            height: 60px;
            background-color: transparent;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            object-fit: contain;
        }

        .school-info {
            min-width: 0; /* prevent text overflow */
        }

        .school-info h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1a4d8f;
            margin: 0;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .school-info p {
            font-size: 13px;
            color: #999;
            margin: 3px 0 0 0;
        }

        /* Desktop Nav */
        .navbar-custom {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }

        .btn-nav {
            padding: 8px 14px;
            font-size: 13px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            font-weight: 500;
            display: inline-block;
            border: 2px solid transparent;
            color: #1a4d8f;
            background: none;
            white-space: nowrap;
        }

        .btn-nav:hover {
            background-color: #eef3f8;
            color: #1a4d8f;
        }

        .btn-nav-primary {
            background-color: #1a4d8f;
            color: white;
            border-color: #1a4d8f;
            font-weight: 600;
        }

        .btn-nav-primary:hover {
            background-color: #16408c;
            border-color: #16408c;
            color: white;
        }

        .btn-nav-secondary {
            background-color: white;
            color: #1a4d8f;
            border-color: #1a4d8f;
            font-weight: 600;
        }

        .btn-nav-secondary:hover {
            background-color: #f5f5f5;
            border-color: #16408c;
        }

        /* Hamburger — hidden on desktop */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
            margin-left: 10px;
            flex-shrink: 0;
            padding: 4px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: #1a4d8f;
            border-radius: 2px;
            transition: 0.3s;
        }

        /* ===== BANNER ===== */
        .banner-section {
            background: linear-gradient(135deg, #4a7ba7 0%, #5a8fb8 100%);
            color: white;
            padding: 60px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .banner-section::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .banner-section::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .banner-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .banner-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: white;
            margin: 20px auto 0;
        }

        .banner-description {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.95;
            margin-top: 20px;
        }

        .banner-btn {
            display: inline-block;
            margin-top: 30px;
            font-size: 18px;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            background-color: #fff;
            color: #174a8b;
            border: 2px solid #174a8b;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .banner-btn:hover {
            background-color: #174a8b;
            color: #fff;
        }

        /* ===== INFO BOX ===== */
        .info-box-section {
            background-color: white;
            padding: 40px 30px;
            margin-top: -30px;
            position: relative;
            z-index: 2;
            border-radius: 0 0 8px 8px;
        }

        .info-box {
            background-color: #d9e9f7;
            border-left: 5px solid #7d9bb5;
            padding: 30px;
            border-radius: 8px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .info-box-title {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #1a4d8f;
            margin-bottom: 15px;
        }

        .info-box-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .info-box-content {
            font-size: 15px;
            color: #4a5f75;
            line-height: 1.8;
        }

        /* ===== SHARED SECTION TITLE ===== */
        .section-title-wrapper {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a4d8f;
            margin-bottom: 12px;
        }

        .section-subtitle {
            font-size: 15px;
            color: #666;
            margin: 0;
        }

        /* ===== FEATURES (Jenis Pengaduan) ===== */
        .features-section {
            padding: 60px 30px;
            background-color: #ffffff;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a4d8f;
            margin-bottom: 10px;
        }

        .feature-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* ===== ALUR PENGADUAN ===== */
        .alur-section {
            padding: 60px 30px;
            background-color: #f8f9fa;
        }

        .alur-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a4d8f;
            text-align: center;
            margin-bottom: 50px;
        }

        .alur-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .alur-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 24px;
            align-items: start;
        }

        .alur-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .alur-number {
            width: 80px;
            height: 80px;
            background-color: #5a8fb8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(90, 143, 184, 0.3);
            flex-shrink: 0;
        }

        .alur-item-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a4d8f;
            margin-bottom: 10px;
        }

        .alur-item-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* ===== KEUNGGULAN ===== */
        .keunggulan-section {
            padding: 60px 30px;
            background-color: white;
        }

        .keunggulan-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }

        /* ===== FAQ ===== */
        .faq-section {
            padding: 60px 30px;
            background-color: #f8f9fa;
        }

        .faq-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .faq-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .accordion-item {
            border: none !important;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .accordion-button {
            background-color: white !important;
            color: #1a4d8f !important;
            font-weight: 600;
            padding: 20px;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: #eef3f8 !important;
        }

        .accordion-body {
            background-color: #f8f9fa;
            padding: 20px;
            line-height: 1.8;
            color: #555;
        }

        /* ===== CONTACT ===== */
        .contact-section {
            padding: 60px 30px;
            background-color: white;
        }

        .contact-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .contact-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact-info-box {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            height: 100%;
        }

        .contact-info-title {
            color: #1a4d8f;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .contact-info-item i {
            font-size: 24px;
            color: #5a8fb8;
            flex-shrink: 0;
            line-height: 1.2;
        }

        .contact-info-item strong {
            color: #333;
            display: block;
            margin-bottom: 4px;
        }

        .contact-info-item p {
            color: #666;
            margin: 0;
            line-height: 1.6;
        }

        .contact-hours-title {
            color: #333;
            display: block;
            margin-bottom: 10px;
            margin-top: 25px;
        }

        .contact-hours-text {
            color: #666;
            margin: 0;
            line-height: 1.8;
        }

        .contact-form-box {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }

        .contact-form-box .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .contact-form-box .form-control {
            border-radius: 6px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .btn-send {
            background-color: #5a8fb8;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-send:hover {
            background-color: #4a7fa8;
        }

        /* ===== FOOTER ===== */
        .footer-section {
            background-color: #143e6c;
            color: white;
            padding: 50px 30px 30px;
        }

        .footer-title {
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            font-size: 14px;
        }

        .footer-social a {
            color: white;
            font-size: 20px;
            margin-right: 15px;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .footer-social a:hover {
            opacity: 0.75;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-contact p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            line-height: 2;
            margin-bottom: 8px;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.2);
            margin: 30px 0;
        }

        .footer-bottom {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        /* ========================================================
           RESPONSIVE BREAKPOINTS
           ======================================================== */

        /* --- TABLET (max 1024px) --- */
        @media (max-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .alur-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* --- MOBILE (max 768px) --- */
        @media (max-width: 768px) {

            /* Navbar */
            .navbar-logo {
                width: 44px;
                height: 44px;
                font-size: 20px;
            }

            .school-info h1 {
                font-size: 17px;
            }

            .school-info p {
                font-size: 12px;
            }

            .navbar-custom {
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                left: 0;
                right: 0;
                background-color: white;
                flex-direction: column;
                padding: 16px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
                border-radius: 8px;
                gap: 4px;
                z-index: 200;
            }

            .navbar-custom.active {
                display: flex;
            }

            .navbar-custom .btn-nav {
                text-align: center;
                width: 100%;
                padding: 10px 12px;
            }

            .hamburger {
                display: flex;
            }

            /* Banner */
            .banner-section {
                padding: 45px 20px;
            }

            .banner-title {
                font-size: 30px;
                min-height: 40px !important;
            }

            .banner-description {
                font-size: 14px;
            }

            .banner-btn {
                font-size: 15px;
                padding: 10px 24px;
                margin-top: 22px;
            }

            /* Info Box */
            .info-box-section {
                padding: 28px 16px;
                margin-top: -20px;
            }

            .info-box {
                padding: 20px;
            }

            .info-box-title {
                font-size: 17px;
                gap: 10px;
            }

            .info-box-content {
                font-size: 14px;
            }

            /* Section titles */
            .section-title {
                font-size: 24px;
            }

            .section-subtitle {
                font-size: 14px;
            }

            .alur-title {
                font-size: 24px;
                margin-bottom: 35px;
            }

            /* Features grid */
            .features-section {
                padding: 45px 18px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .feature-card {
                padding: 20px 14px;
            }

            .feature-icon {
                font-size: 32px;
            }

            .feature-title {
                font-size: 15px;
            }

            .feature-description {
                font-size: 13px;
            }

            /* Alur grid — single column on mobile */
            .alur-section {
                padding: 45px 18px;
            }

            .alur-grid {
                grid-template-columns: 1fr;
                gap: 8px;
                max-width: 420px;
                margin: 0 auto;
            }

            .alur-item {
                flex-direction: row;
                text-align: left;
                gap: 18px;
            }

            .alur-number {
                width: 52px;
                height: 52px;
                font-size: 22px;
                margin-bottom: 0;
                flex-shrink: 0;
            }

            .alur-item-title {
                font-size: 15px;
                margin-bottom: 4px;
            }

            .alur-item-description {
                font-size: 13px;
            }

            /* Keunggulan */
            .keunggulan-section {
                padding: 45px 18px;
            }

            .keunggulan-subtitle {
                font-size: 14px;
            }

            /* FAQ */
            .faq-section {
                padding: 45px 18px;
            }

            .faq-subtitle {
                font-size: 14px;
            }

            .accordion-button {
                padding: 16px !important;
                font-size: 14px;
            }

            .accordion-body {
                padding: 16px;
                font-size: 14px;
            }

            /* Contact */
            .contact-section {
                padding: 45px 18px;
            }

            .contact-subtitle {
                font-size: 14px;
            }

            .contact-info-box,
            .contact-form-box {
                padding: 22px 18px;
            }

            /* Footer */
            .footer-section {
                padding: 40px 18px 24px;
            }
        }

        /* --- SMALL MOBILE (max 480px) --- */
        @media (max-width: 480px) {
            .features-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .feature-card {
                padding: 18px 16px;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 16px;
                text-align: left;
            }

            .feature-icon {
                font-size: 28px;
                margin-bottom: 0;
                flex-shrink: 0;
            }

            .banner-title {
                font-size: 26px;
            }

            .banner-section {
                padding: 36px 16px;
            }

            .alur-number {
                width: 44px;
                height: 44px;
                font-size: 18px;
            }

            .info-box {
                padding: 18px;
            }
        }
    </style>

</head>

<body>
    <!-- ===== HEADER / NAVBAR ===== -->
    <div class="header-section">
        <div class="container">
            <div class="navbar-content">
                <div class="logo-section">
                    <img src="{{ asset('img/logo_SMKN1Padaherang.png') }}" alt="Logo SMK Negeri 1 Padaherang" class="navbar-logo">
                    <div class="school-info">
                        <h1>SMK Negeri 1 Padaherang</h1>
                        <p>Sistem Pengaduan Bullying</p>
                    </div>
                </div>
                
                @if (Route::has('login'))
                    <!-- Desktop + Mobile Menu (JS toggles .active on mobile) -->
                    <nav class="navbar-custom" id="navbarMenu">
                        <a href="#jenis-pengaduan" class="btn-nav">Jenis</a>
                        <a href="#alur-section" class="btn-nav">Alur</a>
                        <a href="#keunggulan-section" class="btn-nav">Keunggulan</a>
                        <a href="#faq-section" class="btn-nav">FAQ</a>
                        <a href="#contact-section" class="btn-nav">Kontak</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-nav btn-nav-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-nav btn-nav-secondary">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">Daftar</a>
                            @endif
                        @endauth
                    </nav>

                    <!-- Hamburger (visible only on mobile via CSS) -->
                    <div class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== BANNER ===== -->
    <div class="banner-section">
        <div class="banner-content">
            <h2 class="banner-title" id="typing-title" style="min-height: 56px;"></h2>
            <p class="banner-description">Platform resmi untuk menyampaikan pengaduan, keluhan, atau saran terkait lingkungan sekolah. Setiap laporan akan ditangani dengan serius dan profesional oleh tim yang berpengalaman.</p>
            <a href="{{ route('login') }}" class="banner-btn">Mulai Sekarang</a>
        </div>
    </div>

    <!-- Typing animation script -->
    <script>
        (function() {
            const text = "Sistem Pengaduan Bullying";
            const el = document.getElementById('typing-title');
            let idx = 0;
            el.textContent = "";
            function typeAnim() {
                if (idx <= text.length) {
                    el.textContent = text.substring(0, idx);
                    idx++;
                    setTimeout(typeAnim, 70);
                }
            }
            typeAnim();
        })();
    </script>

    <!-- ===== INFO BOX ===== -->
    <div class="info-box-section">
        <div class="container">
            <div class="info-box">
                <div class="info-box-title">
                    <div class="info-box-icon"><i class="bi bi-exclamation-triangle"></i></div>
                    <span>Informasi Penting</span>
                </div>
                <div class="info-box-content">
                    Sistem ini dikelola langsung oleh pihak sekolah. Semua pengaduan yang masuk akan dijaga kerahasiaannya dan ditindaklanjuti sesuai prosedur yang berlaku. Gunakan sistem ini dengan bijak dan bertanggung jawab.
                </div>
            </div>
        </div>
    </div>

    <!-- ===== JENIS PENGADUAN ===== -->
    <div class="features-section" id="jenis-pengaduan">
        <div class="container">
            <div class="section-title-wrapper">
                <h2 class="section-title">Jenis Pengaduan yang Dapat Dilaporkan</h2>
                <p class="section-subtitle">Pilih kategori pengaduan sesuai dengan permasalahan yang ingin Anda laporkan</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-shield-exclamation"></i></div>
                    <div>
                        <div class="feature-title">Bullying / Perundungan</div>
                        <div class="feature-description">Tindakan intimidasi, kekerasan fisik/verbal, atau cyberbullying terhadap siswa</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="feature-title">Fasilitas Sekolah</div>
                        <div class="feature-description">Kerusakan atau keluhan terkait gedung, ruang kelas, toilet, dan fasilitas lainnya</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-book"></i></div>
                    <div>
                        <div class="feature-title">Akademik</div>
                        <div class="feature-description">Permasalahan dalam proses belajar mengajar, penilaian, atau administrasi akademik</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-question-circle"></i></div>
                    <div>
                        <div class="feature-title">Lainnya</div>
                        <div class="feature-description">Keluhan, saran, atau pengaduan lain yang berkaitan dengan kegiatan sekolah</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ALUR PENGADUAN ===== -->
    <div class="alur-section" id="alur-section">
        <div class="alur-container">
            <h2 class="alur-title">Alur Pengaduan</h2>
            <div class="alur-grid">
                <div class="alur-item">
                    <div class="alur-number">1</div>
                    <div>
                        <div class="alur-item-title">Buat Akun & Login</div>
                        <div class="alur-item-description">Klik menu <b>Daftar</b> untuk membuat akun baru menggunakan alamat email aktif Anda. Setelah mendaftar, login ke sistem menggunakan email dan password yang sudah didaftarkan.</div>
                    </div>
                </div>
                <div class="alur-item">
                    <div class="alur-number">2</div>
                    <div>
                        <div class="alur-item-title">Buat Pengaduan</div>
                        <div class="alur-item-description">Pilih menu <b>Buat Pengaduan</b>. Isi formulir pengaduan dengan data, kronologi, dan bukti pendukung (jika ada) secara lengkap dan jelas.</div>
                    </div>
                </div>
                <div class="alur-item">
                    <div class="alur-number">3</div>
                    <div>
                        <div class="alur-item-title">Verifikasi & Proses</div>
                        <div class="alur-item-description">Petugas (wali kelas/guru BK/admin) akan memeriksa, memverifikasi, dan memproses laporan Anda.</div>
                    </div>
                </div>
                <div class="alur-item">
                    <div class="alur-number">4</div>
                    <div>
                        <div class="alur-item-title">Tindak Lanjut</div>
                        <div class="alur-item-description">Pengaduan ditangani sesuai prosedur sekolah, termasuk pemanggilan pihak terkait jika diperlukan.</div>
                    </div>
                </div>
                <div class="alur-item">
                    <div class="alur-number">5</div>
                    <div>
                        <div class="alur-item-title">Penyelesaian & Notifikasi</div>
                        <div class="alur-item-description">Anda akan menerima notifikasi hasil tindak lanjut dan status penyelesaian pengaduan.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== KEUNGGULAN SISTEM ===== -->
    <div class="keunggulan-section" id="keunggulan-section">
        <div class="alur-container">
            <h2 class="alur-title">Keunggulan Sistem Kami</h2>
            <p class="keunggulan-subtitle">Sistem pengaduan modern untuk menciptakan lingkungan sekolah yang aman dan nyaman</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="color: #1976d2;"><i class="bi bi-shield-lock"></i></div>
                    <div>
                        <div class="feature-title">Keamanan Data Terjamin</div>
                        <div class="feature-description">Data pengaduan tersimpan dengan aman dan hanya dapat diakses oleh pihak berwenang</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #388e3c;"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <div class="feature-title">Pelacakan Real-time</div>
                        <div class="feature-description">Pantau status pengaduan Anda secara langsung dari tahap verifikasi hingga penyelesaian</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #f57c00;"><i class="bi bi-bell"></i></div>
                    <div>
                        <div class="feature-title">Notifikasi Otomatis</div>
                        <div class="feature-description">Dapatkan notifikasi setiap ada perkembangan terkait pengaduan yang Anda laporkan</div>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="color: #00796b;"><i class="bi bi-lightning"></i></div>
                    <div>
                        <div class="feature-title">Respon Cepat</div>
                        <div class="feature-description">Sistem dirancang untuk memastikan pengaduan mendapat tanggapan dan tindak lanjut dengan cepat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FAQ ===== -->
    <div class="faq-section" id="faq-section">
        <div class="alur-container">
            <h2 class="alur-title">Pertanyaan yang Sering Diajukan</h2>
            <p class="faq-subtitle">Temukan jawaban atas pertanyaan umum seputar sistem pengaduan</p>
            <div class="faq-wrapper">
                <div class="accordion" id="faqAccordion">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="bi bi-question-circle me-2"></i> Bagaimana cara melaporkan pengaduan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                1. Klik menu <b>Daftar</b> untuk membuat akun baru menggunakan alamat email aktif Anda.<br>
                                2. Login ke sistem menggunakan email dan password yang sudah didaftarkan.<br>
                                3. Pilih menu <b>Data Pengaduan</b> dan klik tombol <b>Buat Pengaduan</b>.<br>
                                4. Isi formulir pengaduan dengan data, kronologi, dan bukti pendukung (jika ada) secara lengkap dan jelas.<br>
                                5. Klik <b>Kirim</b>.<br>
                                6. Tunggu proses verifikasi dan tindak lanjut dari petugas. Anda akan menerima notifikasi setiap ada perkembangan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="bi bi-question-circle me-2"></i> Apakah identitas pelapor akan dirahasiakan?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, identitas pelapor dijaga kerahasiaannya. Hanya petugas yang berwenang (guru BK, wali kelas, dan admin) yang dapat melihat detail lengkap pengaduan. Data Anda tersimpan dengan aman dalam sistem.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="bi bi-question-circle me-2"></i> Berapa lama proses penanganan pengaduan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Waktu penanganan bervariasi tergantung kompleksitas kasus. Verifikasi awal biasanya dilakukan dalam 1–2 hari kerja. Setelah disetujui, wali kelas akan melakukan tindak lanjut awal untuk kasus ringan, atau guru BK untuk kasus yang lebih serius. Anda akan mendapat notifikasi di setiap tahapan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="bi bi-question-circle me-2"></i> Bagaimana cara melihat status pengaduan saya?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Setelah login, buka menu "Riwayat Pengaduan" untuk melihat semua pengaduan yang pernah Anda laporkan beserta statusnya. Anda juga akan menerima notifikasi otomatis setiap kali ada update pada pengaduan Anda.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                <i class="bi bi-question-circle me-2"></i> Apa yang harus saya lakukan jika lupa password?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Jika lupa password, Anda dapat menghubungi admin sekolah atau guru BK untuk melakukan reset password. Pastikan Anda memberikan informasi yang valid untuk verifikasi identitas.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                <i class="bi bi-question-circle me-2"></i> Apakah saya bisa melaporkan masalah yang terjadi di luar sekolah?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sistem ini dikhususkan untuk pengaduan yang terkait dengan lingkungan sekolah. Namun, jika masalah di luar sekolah berdampak pada kegiatan belajar atau keamanan di sekolah, Anda dapat melaporkannya dan akan ditangani sesuai kebijakan sekolah.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ===== HUBUNGI KAMI ===== -->
    <div class="contact-section" id="contact-section">
        <div class="alur-container">
            <h2 class="alur-title">Hubungi Kami</h2>
            <p class="contact-subtitle">Ada pertanyaan atau memerlukan bantuan? Kirimkan pesan kepada kami</p>

            <div class="contact-wrapper">
                <div class="row g-4">
                    <!-- Contact Info -->
                    <div class="col-md-5">
                        <div class="contact-info-box">
                            <h4 class="contact-info-title"><i class="bi bi-geo-alt me-2"></i>Informasi Kontak</h4>

                            <div class="contact-info-item">
                                <i class="bi bi-building"></i>
                                <div>
                                    <strong>Alamat</strong>
                                    <p>Jl. Raya Padaherang KM.1 Desa Karangsari Kec. Padaherang Kab. Pangandaran, Jawa Barat 46385</p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <strong>Telepon</strong>
                                    <p>(0265) - 655621</p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <i class="bi bi-envelope"></i>
                                <div>
                                    <strong>Email</strong>
                                    <p>sistempengaduanbullying@gmail.com</p>
                                </div>
                            </div>

                            <strong class="contact-hours-title"><i class="bi bi-clock me-2"></i>Jam Operasional</strong>
                            <p class="contact-hours-text">
                                Senin – Jumat: 07.00 – 15.30 WIB<br>
                                Sabtu & Minggu: Libur
                            </p>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-md-7">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="contact-form-box">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn-send">
                                <i class="bi bi-send me-2"></i>Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="footer-section">
        <div class="container">
            <div class="row g-4">
                <!-- About -->
                <div class="col-md-4">
                    <h5 class="footer-title"><i class="bi bi-building me-2"></i>SMK Negeri 1 Padaherang</h5>
                    <p class="footer-text">
                        Sistem Pengaduan Siswa adalah platform digital untuk melaporkan berbagai permasalahan di lingkungan sekolah dengan aman, cepat, dan terpercaya.
                    </p>
                    <div class="footer-social mt-3">
                        <a href="https://www.facebook.com/SMKNegeri1Padaherang/" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/smknegeri1padaherang/" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@JurnalistikSMKN1PADAHERANG/streams" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4">
                    <h5 class="footer-title"><i class="bi bi-link-45deg me-2"></i>Tautan Cepat</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right me-2"></i>Login Sistem</a></li>
                        <li><a href="#alur-section"><i class="bi bi-chevron-right me-2"></i>Alur Pengaduan</a></li>
                        <li><a href="#faq-section"><i class="bi bi-chevron-right me-2"></i>FAQ</a></li>
                        <li><a href="#contact-section"><i class="bi bi-chevron-right me-2"></i>Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4">
                    <h5 class="footer-title"><i class="bi bi-telephone me-2"></i>Kontak Kami</h5>
                    <div class="footer-contact">
                        <p><i class="bi bi-geo-alt me-2"></i>Jl. Raya Padaherang KM.1 Desa Karangsari Kec. Padaherang Kab. Pangandaran</p>
                        <p><i class="bi bi-telephone me-2"></i>(0265) 655621</p>
                        <p><i class="bi bi-envelope me-2"></i>sistempengaduanbullying@gmail.com</p>
                        <p><i class="bi bi-clock me-2"></i>Senin – Jumat: 07.00 – 15.30 WIB</p>
                    </div>
                </div>
            </div>

            <hr class="footer-divider">
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 SMK Negeri 1 Padaherang – Sistem Pengaduan Bullying. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Hamburger Menu Script -->
    <script>
        (function() {
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const navbarMenu  = document.getElementById('navbarMenu');

            if (hamburgerBtn && navbarMenu) {
                hamburgerBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    navbarMenu.classList.toggle('active');
                });

                // Close menu when clicking a nav link
                navbarMenu.querySelectorAll('.btn-nav').forEach(function(link) {
                    link.addEventListener('click', function() {
                        navbarMenu.classList.remove('active');
                    });
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.header-section')) {
                        navbarMenu.classList.remove('active');
                    }
                });
            }
        })();
    </script>
</body>

</html>