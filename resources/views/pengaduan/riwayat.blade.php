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
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-left: 4px solid;
        position: relative;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .stat-card.card-total {
        border-left-color: #5B8BC5;
    }

    .stat-card.card-diproses {
        border-left-color: #f59e0b;
    }

    .stat-card.card-selesai {
        border-left-color: #16a34a;
    }

    .stat-card.card-draf {
        border-left-color: #ec4899;
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
        font-size: 24px;
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
        gap: 12px;
        min-width: min-content;
    }

    .stat-card-wrapper {
        flex: 0 0 auto;
        min-width: 160px;
    }

    /* Draf card clickable */
    .stat-card-wrapper a {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .stat-card-wrapper a .stat-card:hover {
        box-shadow: 0 4px 12px rgba(236, 72, 153, 0.25);
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

    .badge-draf {
        background-color: #fce7f3;
        color: #be185d;
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
        .stats-scroll-wrapper {
            overflow-x: visible;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .stat-card-wrapper {
            min-width: auto;
        }
    }

    @media (max-width: 768px) {
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
        
        .filter-input,
        .filter-select {
            font-size: 13px;
            padding: 8px 12px;
            width: 100%;
        }
        
        .filter-input {
            min-width: 100% !important;
        }
        
        .filter-select {
            min-width: 100% !important;
        }
        
        .filter-btn {
            width: 100%;
            justify-content: center;
            padding: 8px 12px;
            font-size: 13px;
        }
        
        .table-content-section > div[style*="display: flex"] {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 10px !important;
        }
        
        .data-table {
            font-size: 12px;
            min-width: 600px;
        }
        
        .table-card {
            overflow-x: auto;
        }
        
        .data-table thead th {
            padding: 10px 8px;
            font-size: 10px;
        }
        
        .data-table tbody td {
            padding: 10px 8px;
            font-size: 12px;
        }
        
        .badge-status,
        .badge-priority {
            font-size: 10px;
            padding: 3px 8px;
        }
        
        .action-btn {
            padding: 4px 6px;
            min-width: 28px;
            height: 28px;
            font-size: 12px;
        }
        
        .nomor-laporan {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        h3 {
            font-size: 18px !important;
        }
        
        p {
            font-size: 12px !important;
        }
        
        .stats-container {
            padding: 0 8px;
        }

        .stat-card-wrapper {
            min-width: 130px;
        }

        .stat-number {
            font-size: 22px;
        }
        
        .stat-icon {
            width: 38px;
            height: 38px;
            font-size: 16px;
        }

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
        
        .table-header-section {
            padding: 12px;
        }
        
        .table-title {
            font-size: 14px;
        }
        
        .table-title i {
            font-size: 16px;
        }
        
        .data-table {
            min-width: 500px;
        }
        
        .table-card {
            overflow-x: auto;
        }
        
        .data-table thead th {
            padding: 8px 6px;
            font-size: 9px;
        }
        
        .data-table tbody td {
            padding: 8px 6px;
            font-size: 11px;
        }
        
        .action-buttons {
            gap: 4px;
        }
        
        .action-btn {
            padding: 3px 5px;
            min-width: 26px;
            height: 26px;
            font-size: 11px;
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

    /* ========== STATS SCROLLBAR ========== */
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
        <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Riwayat Pengaduan</h3>
        <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola semua pengaduan yang telah dikirim</p>
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

            <!-- Card 2: Diproses -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-diproses" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Diproses</p>
                        <p class="stat-number" style="color: #f59e0b;">{{ $diproses ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            <!-- Card 3: Selesai -->
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

            <!-- Card 4: Draf (clickable) -->
            <div class="stat-card-wrapper">
                <a href="{{ route('draf-pengaduan') }}">
                    <div class="stat-card card-draf" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p class="stat-label">Draf</p>
                            <p class="stat-number" style="color: #ec4899;">{{ $draf ?? 0 }}</p>
                        </div>
                        <div class="stat-icon" style="background: #fce7f3; color: #ec4899;">
                            <i class="fas fa-file-import"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Right Arrow -->
    <button class="scroll-arrow right" onclick="scrollStats('right')" id="rightArrow">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<!-- Table Riwayat Pengaduan -->
<div class="table-card">
    <!-- Blue Header Section -->
    <div class="table-header-section">
        <h5 class="table-title">
            <i class="fas fa-history"></i>
            Daftar Riwayat Pengaduan
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
                    <option value="draf">Draf</option>
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
        <table class="data-table" id="riwayatTable">
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
                            $statusClass = match ($item['final_status']) {
                                'menunggu' => 'badge-menunggu',
                                'disetujui' => 'badge-disetujui',
                                'diproses' => 'badge-diproses',
                                'direncanakan' => 'badge-direncanakan',
                                'sedang_berjalan' => 'badge-sedang-berjalan',
                                'selesai' => 'badge-selesai',
                                'ditolak' => 'badge-ditolak',
                                'direkomendasi_bk' => 'badge-direkomendasi_bk',
                                'draf' => 'badge-draf',
                                default => 'badge-menunggu',
                            };
                        @endphp

                        <span class="badge-status {{ $statusClass }} status-pengaduan" data-status="{{ $item['final_status'] }}">
                            {{ ucfirst(str_replace('_', ' ', $item['final_status'])) }}
                        </span>
                    </td>
                    <td>
                        @if($item['prioritas'])
                            <span class="badge-priority badge-{{ $item['prioritas'] }} prioritas-pengaduan" data-prioritas="{{ $item['prioritas'] }}">
                                {{ ucfirst($item['prioritas']) }}
                            </span>
                        @else
                            <span class="prioritas-pengaduan" data-prioritas="" style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('buat-pengaduan.show', $item['id']) }}" 
                               class="action-btn" style="color: #3b82f6;" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
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
        <p style="color: #6b7280; font-size: 14px; margin: 0;">Belum ada riwayat pengaduan.</p>
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
    const table = document.getElementById('riwayatTable');
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
    
    setTimeout(updateArrows, 300);
}

// Update Arrows Visibility
function updateArrows() {
    const container = document.getElementById('statsScroll');
    const leftArrow = document.getElementById('leftArrow');
    const rightArrow = document.getElementById('rightArrow');
    
    if (!container || !leftArrow || !rightArrow) return;
    
    if (container.scrollLeft <= 5) {
        leftArrow.classList.add('hidden');
    } else {
        leftArrow.classList.remove('hidden');
    }
    
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