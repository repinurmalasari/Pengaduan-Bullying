@extends('layouts.app')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .dashboard-header h1 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .dashboard-header p {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    /* Carousel Container */
    .stats-carousel-container {
        position: relative;
        margin-bottom: 20px;
    }
    
    .stats-carousel {
        overflow-x: auto;
        overflow-y: hidden;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    
    .stats-carousel::-webkit-scrollbar {
        display: none;
    }
    
    .stats-carousel-inner {
        display: flex;
        gap: 15px;
        padding: 3px;
    }
    
    .stat-card-wrapper {
        flex: 0 0 auto;
        width: 240px;
    }
    
    /* Navigation Buttons */
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }
    
    .carousel-nav:hover {
        background: #5B8BC5;
        color: white;
        box-shadow: 0 3px 12px rgba(91, 139, 197, 0.3);
    }
    
    .carousel-nav.prev {
        left: -16px;
    }
    
    .carousel-nav.next {
        right: -16px;
    }
    
    .carousel-nav:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    
    .carousel-nav:disabled:hover {
        background: white;
        color: inherit;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        border-left: 4px solid;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        min-height: 130px;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    
    .stat-card.card-primary {
        border-left-color: #5B8BC5;
    }
    
    .stat-card.card-warning {
        border-left-color: #f39c12;
    }
    
    .stat-card.card-info {
        border-left-color: #3498db;
    }
    
    .stat-card.card-success {
        border-left-color: #27ae60;
    }
    
    .stat-card.card-danger {
        border-left-color: #e74c3c;
    }
    
    .stat-card.card-secondary {
        border-left-color: #95a5a6;
    }

    .stat-card.card-purple {
        border-left-color: #9b59b6;
    }
    
    .stat-card .stat-icon {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    
    .stat-card.card-primary .stat-icon {
        background: #5B8BC5;
        color: white;
    }
    
    .stat-card.card-warning .stat-icon {
        background: #f39c12;
        color: white;
    }
    
    .stat-card.card-info .stat-icon {
        background: #3498db;
        color: white;
    }
    
    .stat-card.card-success .stat-icon {
        background: #27ae60;
        color: white;
    }
    
    .stat-card.card-danger .stat-icon {
        background: #e74c3c;
        color: white;
    }
    
    .stat-card.card-secondary .stat-icon {
        background: #95a5a6;
        color: white;
    }

    .stat-card.card-purple .stat-icon {
        background: #9b59b6;
        color: white;
    }
    
    .stat-card .stat-content {
        position: relative;
        z-index: 1;
        padding-right: 60px;
    }
    
    .stat-card p {
        margin: 0 0 8px 0;
        font-size: 0.75rem;
        color: #5a6c7d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .stat-card h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 12px 0;
        color: #2c3e50;
        line-height: 1;
    }
    
    .stat-card .card-footer-link {
        margin-top: auto;
        padding-top: 3px;
    }
    
    .stat-card .card-footer-link a {
        color: #5B8BC5;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .stat-card .card-footer-link a:hover {
        color: #4A7AB5;
    }
    
    .stat-card .card-footer-link a i {
        margin-left: 4px;
        transition: transform 0.2s ease;
        font-size: 0.65rem;
    }
    
    .stat-card .card-footer-link a:hover i {
        transform: translateX(2px);
    }
    
    .chart-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .chart-card .card-header {
        background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
        color: white;
        padding: 12px 18px;
        border: none;
    }
    
    .chart-card .card-title {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .chart-card .card-body {
        padding: 18px;
    }
    
    .activity-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .activity-card .card-header {
        background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
        color: white;
        padding: 12px 18px;
        border: none;
    }
    
    .activity-card .card-title {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .activity-item {
        padding: 12px 18px;
        border-bottom: 1px solid #ecf0f1;
        transition: all 0.2s ease;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-item:hover {
        background: #f8f9fa;
    }
    
    .badge-status {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }
    
    .badge-primary {
        background: #cfe2ff;
        color: #084298;
    }
    
    .badge-success {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .badge-danger {
        background: #f8d7da;
        color: #842029;
    }
    
    .badge-secondary {
        background: #e2e3e5;
        color: #41464b;
    }
    
    .empty-state {
        text-align: center;
        padding: 30px 15px;
    }
    
    .empty-state i {
        font-size: 2.5rem;
        color: #bdc3c7;
        margin-bottom: 12px;
    }
    
    .empty-state p {
        color: #95a5a6;
        margin: 0;
        font-size: 0.85rem;
    }
    
    /* Table Card Style */
    .table-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .table-card .card-header {
        background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
        color: white;
        padding: 12px 18px;
        border: none;
    }
    
    .table-card .card-title {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .table-responsive {
        max-height: 350px;
        overflow-y: auto;
    }
    
    .custom-table {
        margin: 0;
    }
    
    .custom-table thead th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 2px solid #dee2e6;
        padding: 10px 8px;
        position: sticky;
        top: 0;
        z-index: 1;
        white-space: nowrap;
    }
    
    .custom-table tbody tr {
        transition: background 0.2s ease;
    }
    
    .custom-table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .custom-table tbody td {
        padding: 10px 8px;
        vertical-align: middle;
        font-size: 0.75rem;
        color: #495057;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-empty {
        text-align: center;
        padding: 40px 15px;
        color: #95a5a6;
    }
    
    .table-empty i {
        font-size: 2rem;
        margin-bottom: 12px;
        opacity: 0.5;
    }
    
    .table-empty p {
        margin: 0;
        font-size: 0.85rem;
    }

    /* ===== RESPONSIVE TABLET ===== */
    @media (max-width: 1200px) {
        .stat-card-wrapper {
            width: 220px;
        }
        
        .stat-card {
            min-height: 125px;
        }
    }
    
    /* ===== RESPONSIVE MEDIUM TABLET ===== */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .dashboard-header {
            padding: 16px;
            border-radius: 10px;
        }
        
        .dashboard-header h1 {
            font-size: 1.15rem;
        }
        
        .dashboard-header p {
            font-size: 0.8rem;
        }
        
        .stat-card-wrapper {
            width: 200px;
        }
        
        .stat-card {
            min-height: 115px;
            padding: 15px;
            border-radius: 10px;
        }
        
        .stat-card h3 {
            font-size: 1.75rem;
        }
        
        .stat-card .stat-icon {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
            top: 15px;
            right: 15px;
        }
        
        .stat-card .stat-content {
            padding-right: 52px;
        }
        
        .stat-card p {
            font-size: 0.7rem;
            margin-bottom: 6px;
        }
        
        .carousel-nav {
            width: 30px;
            height: 30px;
            font-size: 0.75rem;
        }
        
        .carousel-nav.prev {
            left: -15px;
        }
        
        .carousel-nav.next {
            right: -15px;
        }
        
        .custom-table thead th {
            font-size: 0.65rem;
            padding: 8px 6px;
        }
        
        .custom-table tbody td {
            font-size: 0.7rem;
            padding: 8px 6px;
        }
        
        .chart-card .card-body {
            padding: 14px;
        }
        
        .chart-card .card-title,
        .activity-card .card-title,
        .table-card .card-title {
            font-size: 0.88rem;
        }
    }
    
    /* ===== RESPONSIVE MOBILE ===== */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 20px;
            padding-right: 20px;
        }
        
        .dashboard-header {
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 24px;
        }
        
        .dashboard-header h1 {
            font-size: 1.35rem;
        }
        
        .dashboard-header h1 i {
            font-size: 1.25rem;
        }
        
        .dashboard-header p {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-top: 6px;
        }
        
        /* Stat Cards tetap horizontal scroll di mobile */
        .stats-carousel-container {
            margin-bottom: 24px;
        }
        
        .stat-card-wrapper {
            width: 260px;
        }
        
        .stats-carousel-inner {
            gap: 20px;
            padding: 6px;
        }
        
        .stat-card {
            min-height: 145px;
            padding: 20px;
            border-radius: 16px;
            border-left-width: 5px;
        }
        
        .stat-card h3 {
            font-size: 2.2rem;
            margin-bottom: 14px;
        }
        
        .stat-card p {
            font-size: 0.82rem;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            font-size: 1.5rem;
            top: 18px;
            right: 18px;
            border-radius: 12px;
        }
        
        .stat-card .stat-content {
            padding-right: 64px;
        }
        
        .stat-card .card-footer-link {
            margin-top: 6px;
        }
        
        .stat-card .card-footer-link a {
            font-size: 0.85rem;
            font-weight: 700;
        }
        
        .stat-card .card-footer-link a i {
            font-size: 0.75rem;
            margin-left: 6px;
        }
        
        /* Navigation buttons */
        .carousel-nav {
            width: 36px;
            height: 36px;
            font-size: 0.85rem;
        }
        
        .carousel-nav.prev {
            left: -18px;
        }
        
        .carousel-nav.next {
            right: -18px;
        }
        
        /* Chart & Cards */
        .chart-card,
        .activity-card,
        .table-card {
            margin-bottom: 24px;
            border-radius: 16px;
        }
        
        .chart-card .card-header,
        .activity-card .card-header,
        .table-card .card-header {
            padding: 18px 20px;
        }
        
        .chart-card .card-title,
        .activity-card .card-title,
        .table-card .card-title {
            font-size: 1.05rem;
            font-weight: 700;
        }
        
        .chart-card .card-title i,
        .activity-card .card-title i,
        .table-card .card-title i {
            font-size: 1rem;
            margin-right: 6px;
        }
        
        .chart-card .card-body {
            padding: 20px;
        }
        
        .chart-card .card-body canvas {
            height: 280px !important;
        }
        
        /* Activity card */
        .activity-item {
            padding: 18px 20px;
        }
        
        .activity-item strong {
            font-size: 0.98rem;
            display: block;
            margin-bottom: 8px;
        }
        
        .activity-item small {
            font-size: 0.85rem;
            display: block;
            margin-bottom: 4px;
        }
        
        .activity-card .card-body {
            max-height: 400px !important;
        }
        
        /* Table responsive */
        .table-responsive {
            max-height: 400px;
        }
        
        .custom-table thead th {
            font-size: 0.75rem;
            padding: 12px 8px;
            font-weight: 700;
        }
        
        .custom-table tbody td {
            font-size: 0.82rem;
            padding: 12px 8px;
        }
        
        .badge-status {
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: 12px;
            font-weight: 700;
        }
        
        .empty-state {
            padding: 40px 20px;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
        }
        
        .empty-state p {
            font-size: 0.98rem;
        }
        
        /* Row spacing */
        .row {
            margin-left: -10px;
            margin-right: -10px;
        }
        
        .row > [class*='col-'] {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    /* ===== RESPONSIVE EXTRA SMALL MOBILE ===== */
    @media (max-width: 400px) {
        .container-fluid {
            padding-left: 18px;
            padding-right: 18px;
        }
        
        .dashboard-header {
            padding: 22px;
            border-radius: 14px;
            margin-bottom: 22px;
        }
        
        .dashboard-header h1 {
            font-size: 1.25rem;
        }
        
        .dashboard-header h1 i {
            font-size: 1.15rem;
        }
        
        .dashboard-header p {
            font-size: 0.9rem;
            line-height: 1.55;
            margin-top: 5px;
        }
        
        /* Stat cards sedikit lebih kecil untuk layar sangat kecil tapi tetap besar */
        .stat-card-wrapper {
            width: 240px;
        }
        
        .stats-carousel-inner {
            gap: 18px;
        }
        
        .stat-card {
            min-height: 135px;
            padding: 18px;
            border-radius: 14px;
        }
        
        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 12px;
        }
        
        .stat-card p {
            font-size: 0.78rem;
            margin-bottom: 9px;
        }
        
        .stat-card .stat-icon {
            width: 52px;
            height: 52px;
            font-size: 1.35rem;
            top: 16px;
            right: 16px;
            border-radius: 11px;
        }
        
        .stat-card .stat-content {
            padding-right: 58px;
        }
        
        .stat-card .card-footer-link a {
            font-size: 0.8rem;
        }
        
        .carousel-nav {
            width: 34px;
            height: 34px;
            font-size: 0.8rem;
        }
        
        .carousel-nav.prev {
            left: -17px;
        }
        
        .carousel-nav.next {
            right: -17px;
        }
        
        .chart-card .card-title,
        .activity-card .card-title,
        .table-card .card-title {
            font-size: 1rem;
        }
        
        .chart-card .card-header,
        .activity-card .card-header,
        .table-card .card-header {
            padding: 16px 18px;
        }
        
        .chart-card .card-body {
            padding: 18px;
        }
        
        .chart-card .card-body canvas {
            height: 260px !important;
        }
        
        .custom-table thead th {
            font-size: 0.72rem;
            padding: 10px 6px;
        }
        
        .custom-table tbody td {
            font-size: 0.78rem;
            padding: 10px 6px;
        }
        
        .badge-status {
            font-size: 0.66rem;
            padding: 4px 9px;
        }
        
        .activity-item {
            padding: 16px 18px;
        }
        
        .activity-item strong {
            font-size: 0.92rem;
        }
        
        .activity-item small {
            font-size: 0.8rem;
        }
        
        .empty-state {
            padding: 34px 18px;
        }
        
        .empty-state i {
            font-size: 2.8rem;
        }
        
        .empty-state p {
            font-size: 0.92rem;
        }
    }
    
    /* Smooth scrolling untuk semua ukuran */
    .stats-carousel {
        scroll-snap-type: x proximity;
    }
    
    .stat-card-wrapper {
        scroll-snap-align: start;
    }
    
    /* ===== OPTIMAL SIZE FOR POPULAR PHONES ===== */
    /* iPhone SE, iPhone 12/13 Mini, dan sejenisnya (375px - 390px) */
    @media (min-width: 375px) and (max-width: 430px) {
        .stat-card-wrapper {
            width: 250px;
        }
        
        .stat-card {
            min-height: 140px;
            padding: 19px;
        }
        
        .stat-card h3 {
            font-size: 2.1rem;
        }
        
        .stat-card p {
            font-size: 0.8rem;
        }
        
        .stat-card .stat-icon {
            width: 54px;
            height: 54px;
            font-size: 1.4rem;
        }
    }
    
    /* iPhone 12/13/14 Pro, Samsung S21/S22, dll (390px - 430px) */
    @media (min-width: 390px) and (max-width: 430px) {
        .container-fluid {
            padding-left: 22px;
            padding-right: 22px;
        }
        
        .stat-card-wrapper {
            width: 270px;
        }
        
        .dashboard-header {
            padding: 26px;
        }
        
        .dashboard-header h1 {
            font-size: 1.4rem;
        }
        
        .dashboard-header p {
            font-size: 0.98rem;
        }
        
        .stat-card {
            min-height: 150px;
        }
        
        .stat-card h3 {
            font-size: 2.3rem;
        }
    }
    
    /* ===== LANDSCAPE MODE MOBILE ===== */
    @media (max-width: 768px) and (max-height: 500px) and (orientation: landscape) {
        .container-fluid {
            padding-left: 22px;
            padding-right: 22px;
        }
        
        .dashboard-header {
            padding: 14px 18px;
            margin-bottom: 16px;
        }
        
        .dashboard-header h1 {
            font-size: 1.1rem;
        }
        
        .dashboard-header p {
            font-size: 0.82rem;
        }
        
        .stat-card {
            min-height: 115px;
        }
        
        .stat-card-wrapper {
            width: 230px;
        }
        
        .chart-card .card-body canvas {
            height: 220px !important;
        }
        
        .activity-card .card-body,
        .table-responsive {
            max-height: 300px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    
    <!-- Header -->
    <div class="dashboard-header">
        <h1>
            <i class="fas fa-chart-line mr-2"></i>Dashboard
            @if($role === 'admin')
                Admin
            @elseif($role === 'kepala_sekolah')
                Kepala Sekolah
            @elseif($role === 'guru_bk')
                Guru BK
            @elseif($role === 'wali_kelas')
                Wali Kelas
            @elseif($role === 'siswa')
                Siswa
            @endif
        </h1>
        <p>Selamat datang <strong>{{ Auth::user()->name }}</strong> 
    di Sistem Pengaduan Bullying SMKN 1 Padaherang
    </p>
    </div>
    
    @if($role === 'siswa')
        <!-- Dashboard Siswa -->
        <div class="stats-carousel-container">
            <button class="carousel-nav prev" onclick="scrollCarousel('siswa', -1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="stats-carousel" id="siswaCarousel">
                <div class="stats-carousel-inner">
                    <!-- Stat Cards -->
                    <div class="stat-card-wrapper">
                        <div class="stat-card card-primary">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Pengaduan</p>
                                <h3>{{ $total_pengaduan ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('pengaduan.index') }}">
                                        Lihat Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-warning">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <p>Menunggu</p>
                                <h3>{{ $menunggu ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-info">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-content">
                                <p>Diproses</p>
                                <h3>{{ $diproses ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-success">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>Selesai</p>
                                <h3>{{ $selesai ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-nav next" onclick="scrollCarousel('siswa', 1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="row">
            <!-- Chart Full Width -->
            <div class="col-12 mb-4">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Trend Pengaduan
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pengaduanChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-6 mb-4">
                <div class="card activity-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell mr-2"></i>
                            Pengaduan Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
                        @forelse($pengaduan_terbaru ?? [] as $pengaduan)
                            @if($pengaduan->status !== 'draf' && ($pengaduan->victim_class === Auth::user()->kelas || $pengaduan->perpetrator_class === Auth::user()->kelas))
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <strong class="text-dark">{{ $pengaduan->nomor_laporan }}</strong>
                                        @php
                                            $statusTampil = $pengaduan->getStatusTampil();
                                            $badgeClass = 'badge-secondary';
                                            if (in_array($statusTampil, ['Menunggu Verifikasi', 'Menunggu Tindak Lanjut', 'Draf'])) {
                                                $badgeClass = 'badge-warning';
                                            } elseif (in_array($statusTampil, ['Direncanakan', 'Diproses'])) {
                                                $badgeClass = 'badge-primary';
                                            } elseif ($statusTampil == 'Selesai') {
                                                $badgeClass = 'badge-success';
                                            } elseif ($statusTampil == 'Ditolak') {
                                                $badgeClass = 'badge-danger';
                                            }
                                        @endphp
                                        <span class="badge-status {{ $badgeClass }}">
                                            {{ $statusTampil }}
                                        </span>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted">
                                            <i class="fas fa-user mr-1"></i> {{ $pengaduan->user->name ?? 'N/A' }}
                                        </small>
                                    </div>
                                    <small class="text-muted">
                                        <i class="far fa-clock mr-1"></i> {{ $pengaduan->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            @endif
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada pengaduan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Table Data Pengaduan -->
            <div class="col-lg-6 mb-4">
                <div class="card table-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-table mr-2"></i>
                            Tabel Data Pengaduan
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if(isset($pengaduan_list) && count($pengaduan_list) > 0)
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Laporan</th>
                                        <th>Pelapor</th>
                                        <th>Korban</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengaduan_list as $item)
                                    <tr>
                                        <td><strong>{{ $item->nomor_laporan }}</strong></td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->korban ?? 'N/A' }}</td>
                                        <td>
                                            @if(isset($item->jenis_bullying))
                                                {{ ucfirst(str_replace('_', ' ', $item->jenis_bullying)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @php
                                                $statusTampil = $item->getStatusTampil();
                                                $badgeClass = 'badge-secondary';
                                                
                                                if (in_array($statusTampil, ['Menunggu Verifikasi', 'Menunggu Tindak Lanjut', 'Draf'])) {
                                                    $badgeClass = 'badge-warning';
                                                } elseif (in_array($statusTampil, ['Direncanakan', 'Diproses'])) {
                                                    $badgeClass = 'badge-primary';
                                                } elseif ($statusTampil == 'Selesai') {
                                                    $badgeClass = 'badge-success';
                                                } elseif ($statusTampil == 'Ditolak') {
                                                    $badgeClass = 'badge-danger';
                                                }
                                            @endphp
                                            <span class="badge-status {{ $badgeClass }}">
                                                {{ $statusTampil }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(isset($item->prioritas) && !empty($item->prioritas))
                                                <span class="badge-status
                                                    @if($item->prioritas == 'rendah') badge-success
                                                    @elseif($item->prioritas == 'sedang') badge-warning
                                                    @else badge-danger
                                                    @endif">
                                                    {{ ucfirst($item->prioritas) }}
                                                </span>
                                            @else
                                                <span class="badge-status badge-secondary">
                                                    Belum diset
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="table-empty">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data pengaduan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif($role === 'guru_bk')
        <!-- Dashboard Guru BK -->
        <div class="stats-carousel-container">
            <button class="carousel-nav prev" onclick="scrollCarousel('guru_bk', -1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="stats-carousel" id="guru_bkCarousel">
                <div class="stats-carousel-inner">
                    <!-- Stat Cards -->
                    <div class="stat-card-wrapper">
                        <div class="stat-card card-primary">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Pengaduan</p>
                                <h3>{{ $total_pengaduan ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('pengaduan.index') }}">
                                        Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-warning">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <p>Menunggu Verifikasi</p>
                                <h3>{{ $menunggu ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-secondary">
                            <div class="stat-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Tindak Lanjut</p>
                                <h3>{{ $total_tindak_lanjut ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('tindak-lanjut.index') }}">
                                        Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-info">
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="stat-content">
                                <p>TL Direncanakan</p>
                                <h3>{{ $tl_direncanakan ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-purple">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-content">
                                <p>TL Diproses</p>
                                <h3>{{ $tl_diproses ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-success">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>TL Selesai</p>
                                <h3>{{ $tl_selesai ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-danger">
                            <div class="stat-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>Ditolak</p>
                                <h3>{{ $ditolak ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-nav next" onclick="scrollCarousel('guru_bk', 1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="row">
            <!-- Chart Full Width -->
            <div class="col-12 mb-4">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Statistik Pengaduan
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pengaduanChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-6 mb-4">
                <div class="card activity-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell mr-2"></i>
                            Pengaduan Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
                    @forelse($pengaduan_terbaru ?? [] as $pengaduan)
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong class="text-dark">{{ $pengaduan->nomor_laporan ?? 'N/A' }}</strong>
                                @php
                                    $statusClass = 'badge-secondary';
                                    if ($pengaduan->tindakLanjutAwal && $pengaduan->tindakLanjutAwal->status === 'direkomendasi_bk') {
                                        $statusClass = 'badge-primary';
                                    } elseif ($pengaduan->tindakLanjutAwal && $pengaduan->tindakLanjutAwal->status === 'diproses') {
                                        $statusClass = 'badge-warning';
                                    } elseif ($pengaduan->tindakLanjutAwal && $pengaduan->tindakLanjutAwal->status === 'selesai') {
                                        $statusClass = 'badge-success';
                                    } elseif ($pengaduan->tindakLanjutAwal && $pengaduan->tindakLanjutAwal->status === 'direkomendasi_bk') {
                                        $statusClass = 'badge-primary';
                                    }
                                @endphp
                                <span class="badge-status {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $pengaduan->tindakLanjutAwal->status)) }}
                                </span>
                            </div>
                            <div class="mb-1">
                                <small class="text-muted">
                                    <i class="fas fa-user mr-1"></i> {{ $pengaduan->user->name ?? 'N/A' }}
                                </small>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock mr-1"></i> {{ $pengaduan->created_at->diffForHumans() }}
                            </small>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada pengaduan</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>

            <!-- Table Data Tindak Lanjut -->
            <div class="col-lg-6 mb-4">
                <div class="card table-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks mr-2"></i>
                            Tindak Lanjut Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if(isset($tindak_lanjut_list) && count($tindak_lanjut_list) > 0)
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Laporan</th>
                                        <th>Korban</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tindak_lanjut_list as $item)
                                    <tr>
                                        <td><strong>{{ $item->pengaduan->nomor_laporan ?? 'N/A' }}</strong></td>
                                        <td>{{ $item->nama_korban ?? ($item->pengaduan->korban ?? 'N/A') }}</td>
                                        <td>
                                            @if(isset($item->pengaduan->jenis_bullying))
                                                {{ ucfirst(str_replace('_', ' ', $item->pengaduan->jenis_bullying)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @php
                                                $statusClass = 'badge-secondary';
                                                if ($item->status == 'direncanakan') $statusClass = 'badge-warning';
                                                elseif ($item->status == 'diproses') $statusClass = 'badge-primary';
                                                elseif ($item->status == 'selesai') $statusClass = 'badge-success';
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="table-empty">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data tindak lanjut</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif($role === 'wali_kelas')
        <!-- Dashboard Wali Kelas -->
        <div class="stats-carousel-container">
            <button class="carousel-nav prev" onclick="scrollCarousel('wali_kelas', -1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="stats-carousel" id="wali_kelasCarousel">
                <div class="stats-carousel-inner">
                    <!-- Stat Cards -->
                    <div class="stat-card-wrapper">
                        <div class="stat-card card-primary">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <p>Pengaduan Kelas</p>
                                <h3>{{ $total_pengaduan ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('pengaduan.index') }}">
                                        Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-warning">
                            <div class="stat-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>Pengaduan Baru</p>
                                <h3>{{ $pengaduan_baru ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-secondary">
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total TL Awal</p>
                                <h3>{{ $tla_total ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('tindak-lanjut-awal.index') }}">
                                        Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-info">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-content">
                                <p>TLA Diproses</p>
                                <h3>{{ $tla_diproses ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-success">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>TLA Selesai</p>
                                <h3>{{ $tla_selesai ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-purple">
                            <div class="stat-icon">
                                <i class="fas fa-arrow-circle-right"></i>
                            </div>
                            <div class="stat-content">
                                <p>Direkomendasi BK</p>
                                <h3>{{ $tla_direkomendasi ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-danger">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <p>Siswa Kelas</p>
                                <h3>{{ $siswa_kelas ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-nav next" onclick="scrollCarousel('wali_kelas', 1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="row">
            <!-- Chart Full Width -->
            <div class="col-12 mb-4">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Statistik Tindak Lanjut Awal
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pengaduanChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-6 mb-4">
                <div class="card activity-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell mr-2"></i>
                            Tindak Lanjut Awal Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
                    @forelse($tindak_lanjut_awal_terbaru ?? [] as $tla)
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong class="text-dark">{{ $tla->pengaduan->nomor_laporan ?? 'N/A' }}</strong>
                                @php
                                    $statusClass = 'badge-secondary';
                                    if ($tla->status == 'diproses') $statusClass = 'badge-warning';
                                    elseif ($tla->status == 'selesai') $statusClass = 'badge-success';
                                    elseif ($tla->status == 'direkomendasi_bk') $statusClass = 'badge-primary';
                                @endphp
                                <span class="badge-status {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $tla->status)) }}
                                </span>
                            </div>
                            <div class="mb-1">
                                <small class="text-muted">
                                    <i class="fas fa-user-injured mr-1"></i> Korban: {{ $tla->nama_korban ?? 'N/A' }}
                                </small>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock mr-1"></i> {{ $tla->created_at->diffForHumans() }}
                            </small>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada tindak lanjut awal</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>

            <!-- Table Data Tindak Lanjut Awal -->
            <div class="col-lg-6 mb-4">
                <div class="card table-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-check mr-2"></i>
                            Data Tindak Lanjut Awal
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if(isset($tindak_lanjut_awal_list) && count($tindak_lanjut_awal_list) > 0)
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Laporan</th>
                                        <th>Korban</th>
                                        <th>Pelaku</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tindak_lanjut_awal_list as $item)
                                    <tr>
                                        <td><strong>{{ $item->pengaduan->nomor_laporan ?? 'N/A' }}</strong></td>
                                        <td>{{ $item->nama_korban ?? 'N/A' }}</td>
                                        <td>{{ $item->nama_pelaku ?? 'N/A' }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @php
                                                $statusClass = 'badge-secondary';
                                                if ($item->status == 'diproses') $statusClass = 'badge-warning';
                                                elseif ($item->status == 'selesai') $statusClass = 'badge-success';
                                                elseif ($item->status == 'direkomendasi_bk') $statusClass = 'badge-primary';
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="table-empty">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data tindak lanjut awal</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif(in_array($role, ['kepala_sekolah', 'admin']))
        <!-- Dashboard Kepala Sekolah / Admin -->
        <div class="stats-carousel-container">
            <button class="carousel-nav prev" onclick="scrollCarousel('{{ $role }}', -1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="stats-carousel" id="{{ $role }}Carousel">
                <div class="stats-carousel-inner">
                    <!-- Stat Cards -->
                    <div class="stat-card-wrapper">
                        <div class="stat-card card-primary">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Pengaduan</p>
                                <h3>{{ $total_pengaduan ?? 0 }}</h3>
                                <div class="card-footer-link">
                                    <a href="{{ route('pengaduan.index') }}">
                                        Detail <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-warning">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <p>Menunggu Verifikasi</p>
                                <h3>{{ $menunggu ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-info">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-content">
                                <p>TL Diproses</p>
                                <h3>{{ $tl_diproses ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-success">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>TL Selesai</p>
                                <h3>{{ $tl_selesai ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-secondary">
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="stat-content">
                                <p>TLA Diproses</p>
                                <h3>{{ $tla_diproses ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-purple">
                            <div class="stat-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="stat-content">
                                <p>TLA Selesai</p>
                                <h3>{{ $tla_selesai ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card card-danger">
                            <div class="stat-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-content">
                                <p>Ditolak</p>
                                <h3>{{ $ditolak ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card-wrapper">
                        <div class="stat-card" style="border-left-color: #0891b2;">
                            <div class="stat-icon" style="background: #0891b2;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Siswa</p>
                                <h3>{{ $total_siswa ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    @if($role === 'kepala_sekolah')
                    <div class="stat-card-wrapper">
                        <div class="stat-card" style="border-left-color: #7c3aed;">
                            <div class="stat-icon" style="background: #7c3aed;">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Guru</p>
                                <h3>{{ $total_guru ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($role === 'admin')
                    <div class="stat-card-wrapper">
                        <div class="stat-card" style="border-left-color: #7c3aed;">
                            <div class="stat-icon" style="background: #7c3aed;">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Users</p>
                                <h3>{{ $total_users ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <button class="carousel-nav next" onclick="scrollCarousel('{{ $role }}', 1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="row">
            <!-- Chart Full Width -->
            <div class="col-12 mb-4">
                <div class="card chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Statistik Pengaduan
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pengaduanChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-6 mb-4">
                <div class="card activity-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell mr-2"></i>
                            Pengaduan Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
                    @forelse($pengaduan_terbaru ?? [] as $pengaduan)
                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong class="text-dark">{{ $pengaduan->nomor_laporan }}</strong>
                                @php
                                    $statusTampil = $pengaduan->getStatusTampil();
                                    $badgeClass = 'badge-secondary';
                                    
                                    if (in_array($statusTampil, ['Menunggu Verifikasi', 'Menunggu Tindak Lanjut', 'Draf'])) {
                                        $badgeClass = 'badge-warning';
                                    } elseif (in_array($statusTampil, ['Direncanakan', 'Diproses'])) {
                                        $badgeClass = 'badge-primary';
                                    } elseif ($statusTampil == 'Selesai') {
                                        $badgeClass = 'badge-success';
                                    } elseif ($statusTampil == 'Ditolak') {
                                        $badgeClass = 'badge-danger';
                                    }
                                @endphp
                                <span class="badge-status {{ $badgeClass }}">
                                    {{ $statusTampil }}
                                </span>
                            </div>
                            <div class="mb-1">
                                <small class="text-muted">
                                    <i class="fas fa-user mr-1"></i> {{ $pengaduan->user->name ?? 'N/A' }}
                                </small>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock mr-1"></i> {{ $pengaduan->created_at->diffForHumans() }}
                            </small>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada pengaduan</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>

            <!-- Table Data Pengaduan -->
            <div class="col-lg-6 mb-4">
                <div class="card table-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-table mr-2"></i>
                            Tabel Data Pengaduan
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if(isset($pengaduan_list) && count($pengaduan_list) > 0)
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Laporan</th>
                                        <th>Pelapor</th>
                                        <th>Korban</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengaduan_list as $item)
                                    <tr>
                                        <td><strong>{{ $item->nomor_laporan }}</strong></td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->korban ?? 'N/A' }}</td>
                                        <td>
                                            @if(isset($item->jenis_bullying))
                                                {{ ucfirst(str_replace('_', ' ', $item->jenis_bullying)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @php
                                                $statusTampil = $item->getStatusTampil();
                                                $badgeClass = 'badge-secondary';
                                                
                                                if (in_array($statusTampil, ['Menunggu Verifikasi', 'Menunggu Tindak Lanjut', 'Draf'])) {
                                                    $badgeClass = 'badge-warning';
                                                } elseif (in_array($statusTampil, ['Direncanakan', 'Diproses'])) {
                                                    $badgeClass = 'badge-primary';
                                                } elseif ($statusTampil == 'Selesai') {
                                                    $badgeClass = 'badge-success';
                                                } elseif ($statusTampil == 'Ditolak') {
                                                    $badgeClass = 'badge-danger';
                                                }
                                            @endphp
                                            <span class="badge-status {{ $badgeClass }}">
                                                {{ $statusTampil }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(isset($item->prioritas) && !empty($item->prioritas))
                                                <span class="badge-status
                                                    @if($item->prioritas == 'rendah') badge-success
                                                    @elseif($item->prioritas == 'sedang') badge-warning
                                                    @else badge-danger
                                                    @endif">
                                                    {{ ucfirst($item->prioritas) }}
                                                </span>
                                            @else
                                                <span class="badge-status badge-secondary">
                                                    Belum diset
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="table-empty">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data pengaduan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
// Carousel Function dengan smooth scroll
function scrollCarousel(role, direction) {
    const carousel = document.getElementById(role + 'Carousel');
    if (!carousel) return;
    
    // Hitung lebar card + gap
    const cardWidth = carousel.querySelector('.stat-card-wrapper')?.offsetWidth || 220;
    const gap = 15;
    const scrollAmount = cardWidth + gap;
    
    carousel.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
    
    // Update button state setelah scroll selesai
    setTimeout(updateNavButtons, 300);
}

// Update navigation button states
function updateNavButtons() {
    const carousels = document.querySelectorAll('.stats-carousel');
    
    carousels.forEach(carousel => {
        const container = carousel.closest('.stats-carousel-container');
        const prevBtn = container?.querySelector('.carousel-nav.prev');
        const nextBtn = container?.querySelector('.carousel-nav.next');
        
        if (prevBtn && nextBtn) {
            const isAtStart = carousel.scrollLeft <= 5;
            const isAtEnd = carousel.scrollLeft >= (carousel.scrollWidth - carousel.clientWidth - 5);
            
            prevBtn.disabled = isAtStart;
            nextBtn.disabled = isAtEnd;
            
            // Visual feedback
            prevBtn.style.opacity = isAtStart ? '0.3' : '1';
            nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
        }
    });
}

// Touch swipe support untuk mobile
function addTouchSupport() {
    const carousels = document.querySelectorAll('.stats-carousel');
    
    carousels.forEach(carousel => {
        let isDown = false;
        let startX;
        let scrollLeft;
        
        carousel.addEventListener('touchstart', (e) => {
            isDown = true;
            startX = e.touches[0].pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });
        
        carousel.addEventListener('touchend', () => {
            isDown = false;
        });
        
        carousel.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.touches[0].pageX - carousel.offsetLeft;
            const walk = (x - startX) * 2;
            carousel.scrollLeft = scrollLeft - walk;
        });
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateNavButtons();
    addTouchSupport();
    
    // Listen to scroll events
    const carousels = document.querySelectorAll('.stats-carousel');
    carousels.forEach(carousel => {
        carousel.addEventListener('scroll', updateNavButtons);
    });
    
    // Update on window resize
    window.addEventListener('resize', () => {
        updateNavButtons();
    });

    @if(in_array($role, ['siswa', 'guru_bk', 'wali_kelas', 'kepala_sekolah', 'admin']))
    // Label legend disesuaikan berdasarkan role
    var chartLabel = 'Jumlah Pengaduan';
    @if($role === 'wali_kelas')
        chartLabel = 'Jumlah Tindak Lanjut Awal';
    @endif

    var ctx = document.getElementById('pengaduanChart');
    if (ctx) {
        var pengaduanChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_data['labels'] ?? []) !!},
                datasets: [{
                    label: chartLabel,
                    data: {!! json_encode($chart_data['data'] ?? []) !!},
                    backgroundColor: 'rgba(91, 139, 197, 0.1)',
                    borderColor: 'rgba(91, 139, 197, 1)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(91, 139, 197, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: 'rgba(91, 139, 197, 1)',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 12,
                            font: {
                                size: 11,
                                weight: '600',
                                family: "'Segoe UI', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 8,
                        titleFont: {
                            size: 12,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 11
                        },
                        cornerRadius: 5,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 10
                            },
                            color: '#7f8c8d'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            },
                            color: '#7f8c8d'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
