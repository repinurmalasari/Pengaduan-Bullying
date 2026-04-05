@extends('layouts.app')

@section('content')
<style>
    /* ========== BASIC RESETS ========== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* ========== STAT CARDS ========== */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-left: 4px solid;
        position: relative;
        height: 100%;
        min-height: 130px;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .stat-card.card-total {
        border-left-color: #5B8BC5;
    }

    .stat-card.card-menunggu {
        border-left-color: #f59e0b;
    }

    .stat-card.card-ditolak {
        border-left-color: #dc2626;
    }

    .stat-card.card-disetujui {
        border-left-color: #059669;
    }

    .stat-card.card-selesai {
        border-left-color: #16a34a;
    }
    
    .stat-label {
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-number {
        color: #1f2937;
        font-size: 32px;
        font-weight: bold;
        margin: 8px 0 0 0;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        position: absolute;
        top: 18px;
        right: 18px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }

    /* ========== SWIPEABLE CARDS CONTAINER ========== */
    .stats-container {
        position: relative;
        width: 100%;
        margin-bottom: 24px;
    }

    .stats-scroll-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding-bottom: 10px;
    }

    .stats-scroll-wrapper::-webkit-scrollbar {
        display: none;
    }

    .stats-grid {
        display: flex;
        gap: 15px;
        min-width: min-content;
        padding: 3px;
    }

    .stat-card-wrapper {
        flex: 0 0 auto;
        width: 240px;
    }
    /* Responsive: samakan dengan dashboard */
    @media (max-width: 1200px) {
        .stat-card-wrapper {
            width: 220px;
        }
        .stat-card {
            min-height: 125px;
        }
    }
    @media (max-width: 768px) {
        .stat-card-wrapper {
            width: 290px;
        }
        .stat-card {
            min-height: 170px;
            padding: 32px 22px;
            border-radius: 18px;
        }
        .stat-label {
            font-size: 18px;
        }
        .stat-number {
            font-size: 48px;
        }
        .stat-icon {
            width: 70px;
            height: 70px;
            font-size: 2.2rem;
            top: 22px;
            right: 22px;
        }
    }
    @media (max-width: 576px) {
        .stat-card-wrapper {
            width: 260px;
        }
        .stats-grid {
            gap: 22px;
            padding: 3px;
        }
        .stat-card {
            min-height: 150px;
            padding: 26px 16px;
            border-radius: 16px;
            border-left-width: 4px;
        }
        .stat-label {
            font-size: 16px;
        }
        .stat-number {
            font-size: 38px;
        }
        .stat-icon {
            width: 58px;
            height: 58px;
            font-size: 1.7rem;
            top: 18px;
            right: 18px;
            border-radius: 16px;
        }
    }
    @media (max-width: 400px) {
        .stat-card-wrapper {
            width: 200px;
        }
        .stats-grid {
            gap: 12px;
        }
        .stat-card {
            min-height: 110px;
            padding: 14px;
            border-radius: 12px;
        }
        .stat-label {
            font-size: 13px;
        }
        .stat-number {
            font-size: 26px;
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            top: 10px;
            right: 10px;
            border-radius: 12px;
        }
    }

    /* Navigation Arrows */
    .scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        color: #1f2937;
        font-size: 18px;
    }

    .scroll-arrow:hover {
        background: #f9fafb;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    .scroll-arrow:active {
        transform: translateY(-50%) scale(0.95);
    }

    .scroll-arrow.left {
        left: -8px;
    }

    .scroll-arrow.right {
        right: -8px;
    }

    .scroll-arrow.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* ========== TABLE CARD ========== */
    .table-card {
        background: white;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-header-section {
        background: linear-gradient(135deg, #5B8BC5 0%, #4a7ab5 100%);
        padding: 20px 24px;
        color: white;
    }

    .table-content-section {
        padding: 24px;
    }

    .table-title {
        color: white;
        font-size: 18px;
        font-weight: bold;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title i {
        font-size: 20px;
    }

    /* ========== TABLE STYLES ========== */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 16px;
    }

    .data-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        padding: 14px 16px;
        text-align: left;
        font-size: 13px;
        border-top: 2px solid #e2e8f0;
        border-bottom: 2px solid #e2e8f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table thead th:first-child {
        border-left: 2px solid #e2e8f0;
        border-top-left-radius: 8px;
    }

    .data-table thead th:last-child {
        border-right: 2px solid #e2e8f0;
        border-top-right-radius: 8px;
    }

    .data-table tbody tr {
        background: white;
        transition: all 0.2s ease;
    }

    .data-table tbody tr:nth-child(odd) {
        background: #f9fafb;
    }

    .data-table tbody tr:hover {
        background: #f0f9ff;
        box-shadow: 0 2px 8px rgba(75, 126, 196, 0.15);
    }

    .data-table tbody td {
        padding: 14px 16px;
        border-left: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        border-bottom: none;
        font-size: 14px;
        color: #1f2937;
        vertical-align: middle;
    }

    .data-table tbody td:first-child {
        border-left: 2px solid #e2e8f0;
    }

    .data-table tbody td:last-child {
        border-right: 2px solid #e2e8f0;
    }

    .data-table tbody tr:last-child td {
        border-bottom: 2px solid #e2e8f0;
    }

    .data-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 8px;
    }

    .data-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 8px;
    }

    /* ========== STATUS BADGE ========== */
    .badge-status {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 6px;
        display: inline-block;
        text-transform: capitalize;
    }

    .badge-menunggu {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .badge-disetujui {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-diproses {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-direncanakan {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-sedang-berjalan {
        background-color: #fde68a;
        color: #92400e;
    }

    .badge-selesai {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-ditolak {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-direkomendasi_bk {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    /* ========== PRIORITY BADGE ========== */
    .badge-priority {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 6px;
        display: inline-block;
        text-transform: capitalize;
    }

    .badge-tinggi {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-sedang {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-rendah {
        background-color: #dcfce7;
        color: #166534;
    }

    /* ========== ACTION BUTTONS ========== */
    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .action-btn {
        background: white;
        border: 1.5px solid #e5e7eb;
        padding: 6px 10px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
        min-width: 34px;
        height: 34px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        border-color: currentColor;
    }

    /* ========== FILTERS ========== */
    .filter-input {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        transition: all 0.2s;
    }

    .filter-input:focus {
        outline: none;
        border-color: #4B7EC4;
        box-shadow: 0 0 0 3px rgba(75, 126, 196, 0.1);
    }

    .filter-select {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        min-width: 150px;
        transition: all 0.2s;
    }

    .filter-select:focus {
        outline: none;
        border-color: #4B7EC4;
        box-shadow: 0 0 0 3px rgba(75, 126, 196, 0.1);
    }

    .filter-btn {
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .filter-btn-secondary {
        background: white;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }

    .filter-btn-secondary:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    /* ========== NOMOR LAPORAN ========== */
    .nomor-laporan {
        font-weight: 700;
        color: #4B7EC4;
        font-family: 'Courier New', monospace;
    }

    /* ========== RESPONSIVE ========== */
    @media (min-width: 769px) {
        /* Desktop: Show all cards in a row */
        .stats-scroll-wrapper {
            overflow-x: visible;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
        }

        .stat-card-wrapper {
            min-width: auto;
        }
    }

    @media (max-width: 768px) {
        /* Mobile: Swipeable cards with visible arrows */
        .stats-container {
            margin-bottom: 20px;
            padding: 0 10px;
        }

        .stat-card-wrapper {
            min-width: 140px;
        }

        .stat-card {
            padding: 14px 16px;
        }
        
        .stat-label {
            font-size: 11px;
        }
        
        .stat-number {
            font-size: 24px;
        }
        
        .stat-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }

        /* Show arrows on mobile */
        .scroll-arrow {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .scroll-arrow.left {
            left: -5px;
        }

        .scroll-arrow.right {
            right: -5px;
        }

        /* Table Card */
        .table-card {
            border-radius: 10px;
        }
        
        .table-header-section {
            padding: 16px 12px;
        }
        
        .table-content-section {
            padding: 12px;
        }
        
        .table-title {
            font-size: 16px;
        }
        
        .table-title i {
            font-size: 18px;
        }
        
        /* Filters stack vertically and match table style, but smaller */
        .filter-input,
        .filter-select {
            font-size: 12px;
            padding: 7px 8px;
            width: 100%;
            border-radius: 6px;
            height: 30px;
            max-width: 160px;
            margin-left: auto;
            margin-right: auto;
        }
        .filter-btn {
            width: 100%;
            justify-content: center;
            padding: 7px 8px;
            font-size: 12px;
            border-radius: 6px;
            height: 30px;
            max-width: 90px;
            margin-left: auto;
            margin-right: auto;
        }
        /* Make filter section stack vertically */
        .table-content-section > div[style*="display: flex"] {
            flex-direction: column !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        /* Table: horizontal scroll on mobile, bigger text */
        .data-table {
            font-size: 16px;
            min-width: 600px;
        }
        .table-card {
            overflow-x: auto;
        }
        .data-table thead th {
            padding: 16px 12px;
            font-size: 14px;
        }
        .data-table tbody td {
            padding: 16px 12px;
            font-size: 16px;
        }
        .badge-status,
        .badge-priority {
            font-size: 13px;
            padding: 6px 12px;
        }
        .action-btn {
            padding: 8px 10px;
            min-width: 34px;
            height: 34px;
            font-size: 15px;
        }
        .nomor-laporan {
            font-size: 15px;
        }
    }

    @media (max-width: 480px) {
        /* Header responsive */
        h3 {
            font-size: 18px !important;
        }
        p {
            font-size: 13px !important;
        }
        /* Buttons di header */
        .btn {
            padding: 10px 18px !important;
            font-size: 15px !important;
        }
        /* Stats - swipeable */
        .stats-container {
            padding: 0 8px;
        }
        .stat-card-wrapper {
            min-width: 180px;
        }
        .stat-number {
            font-size: 26px;
        }
        .stat-label {
            font-size: 12px;
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
        /* Smaller arrows on very small screens */
        .scroll-arrow {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
        .scroll-arrow.left {
            left: -3px;
        }
        .scroll-arrow.right {
            right: -3px;
        }
        /* Table header */
        .table-header-section {
            padding: 12px;
        }
        .table-title {
            font-size: 16px;
        }
        .table-title i {
            font-size: 18px;
        }
        /* Table: horizontal scroll on very small screens, bigger text */
        .data-table {
            min-width: 400px;
            font-size: 15px;
        }
        .table-card {
            overflow-x: auto;
        }
        .data-table thead th {
            padding: 12px 8px;
            font-size: 13px;
        }
        .data-table tbody td {
            padding: 12px 8px;
            font-size: 15px;
        }
        .action-buttons {
            gap: 6px;
        }
        .action-btn {
            padding: 7px 9px;
            min-width: 30px;
            height: 30px;
            font-size: 13px;
        }
        .nomor-laporan {
            font-size: 14px;
        }
    }

    /* ========== TABLE SCROLLBAR ========== */
    .table-card::-webkit-scrollbar {
        height: 8px;
    }

    .table-card::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .table-card::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .table-card::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* ========== STATS SCROLLBAR (untuk desktop dengan banyak cards) ========== */
    .stats-scroll-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .stats-scroll-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .stats-scroll-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .stats-scroll-wrapper::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<!-- Header -->
<div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
    <div>
        <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Data Pengaduan</h3>
        <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola pengaduan bullying</p>
    </div>
    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    @if(auth()->user()->role == 'siswa')
        <a href="{{ route('draf-pengaduan') }}" class="btn" style="background: white; border: 2px solid #4B7EC4; color: #4B7EC4; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;">
            <i class="fas fa-file"></i>Draf Pengaduan
        </a>
        <a href="{{ route('buat-pengaduan.create') }}" class="btn" style="background: linear-gradient(135deg, #4B7EC4 0%, #2C5AA0 100%); border: none; color: white; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s;">
            <i class="fas fa-plus"></i>Buat Pengaduan
        </a>
    @endif
    </div>
</div>

<!-- Statistics Cards - Swipeable on Mobile -->
<div class="stats-container">
    <!-- Left Arrow -->
    <button class="scroll-arrow left" onclick="scrollStats('left')" id="leftArrow">
        <i class="fas fa-chevron-left"></i>
    </button>

    <div class="stats-scroll-wrapper" id="statsScroll">
        <div class="stats-grid">
            <!-- Card 1: Total -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-total" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Total</p>
                        <p class="stat-number" style="color: #5B8BC5;">{{ $totalLaporan ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #5B8BC5;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>

            <!-- Card 2: Menunggu -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-menunggu" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Menunggu</p>
                        <p class="stat-number" style="color: #f59e0b;">{{ $menunggu ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            <!-- Card 3: Ditolak -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-ditolak" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Ditolak</p>
                        <p class="stat-number" style="color: #dc2626;">{{ $ditolak ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Card 4: Disetujui -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-disetujui" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Disetujui</p>
                        <p class="stat-number" style="color: #059669;">{{ $disetujui ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>

            <!-- Card 5: Selesai -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-selesai" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Selesai</p>
                        <p class="stat-number" style="color: #16a34a;">{{ $selesai ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Arrow -->
    <button class="scroll-arrow right" onclick="scrollStats('right')" id="rightArrow">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<!-- Table Data Pengaduan -->
<div class="table-card">
    <!-- Blue Header Section -->
    <div class="table-header-section">
        <h5 class="table-title">
            Tabel Data Pengaduan
        </h5>
    </div>

    <!-- Content Section -->
    <div class="table-content-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 16px;">
            <!-- Filter Section -->
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div style="position: relative; max-width: 320px;">
                    <i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 14px;"></i>
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="filter-input" 
                        placeholder="Cari nomor/pelapor/korban..."
                        onkeyup="filterTable()"
                        style="width: 320px; padding-left: 42px;"
                    >
                </div>
                
                <select id="statusFilter" class="filter-select" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="diproses">Diproses</option>
                    <option value="direncanakan">Direncanakan</option>
                    <option value="sedang_berjalan">Sedang Berjalan</option>
                    <option value="selesai">Selesai</option>
                </select>

                <select id="prioritasFilter" class="filter-select" onchange="filterTable()">
                    <option value="">Semua Prioritas</option>
                    <option value="tinggi">Tinggi</option>
                    <option value="sedang">Sedang</option>
                    <option value="rendah">Rendah</option>
                </select>

                <button class="filter-btn filter-btn-secondary" onclick="resetFilter()">
                    <i class="fas fa-redo"></i>
                    Reset
                </button>
            </div>
        </div>

    @if ($laporan->count() > 0)
    <div style="overflow-x: auto;">
        <table class="data-table" id="pengaduanTable">
            <thead>
                <tr>
                    <th>Nomor Laporan</th>
                    <th>Pelapor</th>
                    <th>Korban</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $item)
                <tr>
                    <td>
                        <span class="nomor-laporan">{{ $item['nomor_laporan'] }}</span>
                    </td>
                    <td class="pelapor-name">{{ $item['pelapor'] }}</td>
                    <td class="korban-name">{{ $item['korban'] }}</td>
                    <td class="jenis-pengaduan">{{ $item['jenis'] }}</td>
                    <td class="tanggal-pengaduan">{{ $item['tanggal'] }}</td>
                    <td>
                        @php
                            $finalStatus = $item['final_status'];
                            $statusClass = match ($finalStatus) {
                                'menunggu' => 'badge-menunggu',
                                'disetujui' => 'badge-disetujui',
                                'diproses' => 'badge-diproses',
                                'direncanakan' => 'badge-direncanakan',
                                'sedang_berjalan' => 'badge-sedang-berjalan',
                                'selesai' => 'badge-selesai',
                                'ditolak' => 'badge-ditolak',
                                'direkomendasi_bk' => 'badge-direkomendasi_bk',
                                default => 'badge-menunggu',
                            };
                        @endphp

                        <span class="badge-status {{ $statusClass }} status-pengaduan" data-status="{{ $finalStatus }}">
                            {{ ucfirst(str_replace('_', ' ', $finalStatus)) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-priority badge-{{ $item['prioritas'] }} prioritas-pengaduan" data-prioritas="{{ $item['prioritas'] }}">
                            {{ ucfirst($item['prioritas']) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            {{-- TOMBOL LIHAT DETAIL (SEMUA ROLE) --}}
                            @if(auth()->user()->role == 'siswa')
                                <a href="{{ route('buat-pengaduan.show', $item['id']) }}" 
                                   class="action-btn" style="color: #3b82f6;" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @else
                                <a href="{{ route('pengaduan.show', $item['id']) }}" 
                                   class="action-btn" style="color: #3b82f6;" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endif

                            {{-- TOMBOL EDIT & HAPUS (KHUSUS SISWA) --}}
                            @if(auth()->user()->role == 'siswa')
                                <a href="{{ route('buat-pengaduan.edit', $item['id']) }}" 
                                   class="action-btn" style="color: #10b981;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="action-btn" style="color: #ef4444;" title="Hapus"
                                    onclick="if(confirm('Yakin ingin menghapus pengaduan ini?')) { document.getElementById('delete-form-{{ $item['id'] }}').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $item['id'] }}" 
                                      action="{{ route('buat-pengaduan.destroy', $item['id']) }}" 
                                      method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif

                            {{-- TOMBOL AKSI BERDASARKAN STATUS (GURU BK & WALI KELAS) --}}
                            @if(in_array(auth()->user()->role, ['guru_bk', 'wali_kelas']) && $item['status'] !== 'ditolak')

                                {{-- Wali Kelas: Tombol Tindak Lanjut Awal --}}
                                @if(auth()->user()->role === 'wali_kelas' && $item['status'] === 'disetujui')
                                    @if(!isset($item['has_tindak_lanjut_awal']) || !$item['has_tindak_lanjut_awal'])
                                        {{-- Belum ada tindak lanjut awal - Buat baru --}}
                                        <a href="{{ route('tindak-lanjut-awal.create', ['pengaduan_id' => $item['id']]) }}"
                                            class="action-btn"
                                            style="color: #8b5cf6;"
                                            title="Buat Tindak Lanjut Awal">
                                            <i class="fas fa-clipboard-check"></i>
                                        </a>
                                    @elseif($item['tindak_lanjut_awal_status'] === 'diproses')
                                        {{-- Status diproses - Lihat Detail --}}
                                        <a href="{{ route('tindak-lanjut-awal.show', $item['tindak_lanjut_awal_id']) }}"
                                            class="action-btn"
                                            style="color: #f59e0b;"
                                            title="Lihat Detail Tindak Lanjut Awal">
                                            <i class="fas fa-hourglass-half"></i>
                                        </a>
                                    @elseif($item['tindak_lanjut_awal_status'] === 'selesai')
                                        {{-- Status selesai - Lihat detail --}}
                                        <a href="{{ route('tindak-lanjut-awal.show', $item['tindak_lanjut_awal_id']) }}"
                                            class="action-btn"
                                            style="color: #16a34a;"
                                            title="Lihat Tindak Lanjut Awal">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                    @elseif($item['tindak_lanjut_awal_status'] === 'direkomendasi_bk')
                                        {{-- Status direkomendasi BK --}}
                                        <a href="{{ route('tindak-lanjut-awal.show', $item['tindak_lanjut_awal_id']) }}"
                                            class="action-btn"
                                            style="color: #6366f1;"
                                            title="Direkomendasi ke BK">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                @endif

                                {{-- MENUNGGU - Belum ada tindak lanjut (HANYA GURU BK) --}}
                                @if(auth()->user()->role === 'guru_bk' && (!isset($item['tindak_lanjut_id']) || $item['tindak_lanjut_id'] == null))
                                    <a href="{{ route('tindak-lanjut.create', ['pengaduan_id' => $item['id']]) }}"
                                        class="action-btn"
                                        style="color: #6b7280;"
                                        title="Buat Tindak Lanjut">
                                        <i class="fas fa-calendar-plus"></i>
                                    </a>

                                {{-- DIRENCANAKAN - Tombol Proses (mulai proses) - HANYA GURU BK --}}
                                @elseif($item['tindak_lanjut_status'] === 'direncanakan' && auth()->user()->role === 'guru_bk')
                                    <a href="{{ route('tindak-lanjut.edit', $item['tindak_lanjut_id']) }}"
                                       class="action-btn"
                                       style="color: #3b82f6;"
                                       title="Direncanakan">
                                       <i class="fas fa-calendar-check"></i>
                                    </a>

                                {{-- DIPROSES - Tombol Edit Proses - HANYA GURU BK --}}
                                @elseif($item['tindak_lanjut_status'] === 'diproses' && auth()->user()->role === 'guru_bk')
                                    <a href="{{ route('tindak-lanjut.edit-proses', $item['tindak_lanjut_id']) }}"
                                       class="action-btn"
                                       style="color: #f59e0b;"
                                       title="Diproses">
                                        <i class="fas fa-hourglass-half"></i>
                                    </a>

                                {{-- SELESAI - Tombol Lihat Detail Selesai --}}
                                @elseif($item['tindak_lanjut_status'] === 'selesai')
                                    <a href="{{ route('tindak-lanjut.show-selesai', $item['tindak_lanjut_id']) }}"
                                       class="action-btn"
                                       style="color: #16a34a;"
                                       title="Selesai">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                @endif

                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- No Results Message -->
    <div id="noResults" style="display: none; text-align: center; padding: 40px 20px;">
        <i class="fas fa-search" style="font-size: 48px; color: #d1d5db; margin-bottom: 12px; display: block;"></i>
        <p style="color: #6b7280; font-size: 14px; margin: 0;">Tidak ada data yang sesuai dengan filter.</p>
    </div>
    @else
    <div style="text-align: center; padding: 40px 20px;">
        <i class="fas fa-inbox" style="font-size: 48px; color: #d1d5db; margin-bottom: 12px; display: block;"></i>
        <p style="color: #6b7280; font-size: 14px; margin: 0;">Belum ada laporan. Buat laporan baru untuk memulai.</p>
    </div>
    @endif
</div>
</div>

@if (session('success'))
<div style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; display: flex; align-items: center; gap: 10px;">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<script>
// Filter Table Function
function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const prioritasFilter = document.getElementById('prioritasFilter').value.toLowerCase();
    const table = document.getElementById('pengaduanTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');
    const noResults = document.getElementById('noResults');
    
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const nomorLaporan = row.querySelector('.nomor-laporan').textContent.toLowerCase();
        const pelapor = row.querySelector('.pelapor-name').textContent.toLowerCase();
        const korban = row.querySelector('.korban-name').textContent.toLowerCase();
        const status = row.querySelector('.status-pengaduan').getAttribute('data-status').toLowerCase();
        const prioritas = row.querySelector('.prioritas-pengaduan').getAttribute('data-prioritas').toLowerCase();

        const matchesSearch = nomorLaporan.includes(searchInput) || 
                            pelapor.includes(searchInput) || 
                            korban.includes(searchInput);
        const matchesStatus = statusFilter === '' || status === statusFilter;
        const matchesPrioritas = prioritasFilter === '' || prioritas === prioritasFilter;

        if (matchesSearch && matchesStatus && matchesPrioritas) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    }

    // Show/hide no results message
    if (visibleCount === 0) {
        table.style.display = 'none';
        noResults.style.display = 'block';
    } else {
        table.style.display = 'table';
        noResults.style.display = 'none';
    }
}

// Reset Filter Function
function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('prioritasFilter').value = '';
    filterTable();
}

// Scroll Stats Cards Function
function scrollStats(direction) {
    const container = document.getElementById('statsScroll');
    const scrollAmount = 200;
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
    
    // Update arrow visibility after scroll
    setTimeout(updateArrows, 300);
}

// Update Arrows Visibility
function updateArrows() {
    const container = document.getElementById('statsScroll');
    const leftArrow = document.getElementById('leftArrow');
    const rightArrow = document.getElementById('rightArrow');
    
    if (!container || !leftArrow || !rightArrow) return;
    
    // Check if at start
    if (container.scrollLeft <= 5) {
        leftArrow.classList.add('hidden');
    } else {
        leftArrow.classList.remove('hidden');
    }
    
    // Check if at end
    const isAtEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 5;
    if (isAtEnd) {
        rightArrow.classList.add('hidden');
    } else {
        rightArrow.classList.remove('hidden');
    }
}

// Check if scrolling is needed
function checkScrollNeeded() {
    const container = document.getElementById('statsScroll');
    const leftArrow = document.getElementById('leftArrow');
    const rightArrow = document.getElementById('rightArrow');
    
    if (!container || !leftArrow || !rightArrow) return;
    
    // If content width is less than or equal to container, hide arrows
    if (container.scrollWidth <= container.clientWidth) {
        leftArrow.style.display = 'none';
        rightArrow.style.display = 'none';
    } else {
        leftArrow.style.display = 'flex';
        rightArrow.style.display = 'flex';
        updateArrows();
    }
}

// Auto-hide success message after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.querySelector('[style*="position: fixed"]');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.transition = 'opacity 0.5s';
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 500);
        }, 5000);
    }
    
    // Initialize arrow visibility
    checkScrollNeeded();
    
    // Update arrows on scroll
    const container = document.getElementById('statsScroll');
    if (container) {
        container.addEventListener('scroll', updateArrows);
    }
    
    // Update arrows on window resize
    window.addEventListener('resize', function() {
        checkScrollNeeded();
    });
});
</script>
@endsection