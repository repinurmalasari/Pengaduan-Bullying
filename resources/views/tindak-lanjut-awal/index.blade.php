@extends('layouts.app')

@section('content')
<style>
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

    .stat-card.card-direkomendasi {
        border-left-color: #6366f1;
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
        min-width: 180px;
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

    .badge-diproses {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-selesai {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-direkomendasi_bk {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    /* ========== FILTER STYLES ========== */
    .filter-section {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-wrapper {
        position: relative;
        flex: 1;
        min-width: 250px;
    }

    .search-wrapper i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }

    .filter-input {
        width: 100%;
        padding: 10px 12px 10px 38px;
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
        padding: 10px 32px 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 8px center;
        background-size: 20px;
        cursor: pointer;
        min-width: 200px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        transition: all 0.2s;
    }

    .filter-select:focus {
        outline: none;
        border-color: #4B7EC4;
        box-shadow: 0 0 0 3px rgba(75, 126, 196, 0.1);
    }

    .filter-btn {
        padding: 10px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #6b7280;
    }

    .filter-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    /* ========== ACTION BUTTONS ========== */
    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        background: white;
        border: 1px solid #e5e7eb;
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
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
        }

        .search-wrapper {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }
    }
</style>

<!-- Header -->
<div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Data Tindak Lanjut Awal</h3>
    <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola tindak lanjut awal untuk kasus bullying</p>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stats-scroll-wrapper">
        <div class="stats-grid">
            <!-- Total -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-total" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Total Tindak Lanjut</p>
                        <p class="stat-number" style="color: #5B8BC5;">{{ $total }}</p>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #5B8BC5;">
                        <i class="fas fa-list"></i>
                    </div>
                </div>
            </div>

            <!-- Diproses -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-diproses" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Diproses</p>
                        <p class="stat-number" style="color: #f59e0b;">{{ $diproses }}</p>
                    </div>
                    <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>

            <!-- Selesai -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-selesai" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Selesai</p>
                        <p class="stat-number" style="color: #10b981;">{{ $selesai }}</p>
                    </div>
                    <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Direkomendasi ke BK -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-direkomendasi" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Direkomendasi ke BK</p>
                        <p class="stat-number" style="color: #6366f1;">{{ $direkomendasi }}</p>
                    </div>
                    <div class="stat-icon" style="background: #e0e7ff; color: #6366f1;">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-header-section">
        <h5 class="table-title"> Tabel Data Tindak Lanjut Awal</h5>
    </div>
    
    <div class="table-content-section">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px; border-radius: 8px;">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="filter-input" placeholder="Cari nomor/pelapor/korban..." onkeyup="filterTable()">
            </div>
            
            <select id="statusFilter" class="filter-select" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai (Kasus Ringan)</option>
                <option value="direkomendasi_bk">Direkomendasi ke BK</option>
            </select>

            <button class="filter-btn" onclick="resetFilter()">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>
    
    @if($tindakLanjutAwal->count() > 0)
        <div class="table-responsive">
            <table class="data-table" id="tindakLanjutAwalTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Laporan</th>
                        <th>Tanggal</th>
                        <th>Pelapor</th>
                        <th>Korban</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tindakLanjutAwal as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $item['nomor_laporan'] }}</strong></td>
                            <td>{{ $item['tanggal_tindak_lanjut'] }}</td>
                            <td>{{ $item['pelapor'] }}</td>
                            <td>{{ $item['korban'] }}</td>
                            <td>
                                @if($item['status'] == 'diproses')
                                    <span class="badge-status badge-diproses">Diproses</span>
                                @elseif($item['status'] == 'selesai')
                                    <span class="badge-status badge-selesai">Selesai (Kasus Ringan)</span>
                                @elseif($item['status'] == 'direkomendasi_bk')
                                    <span class="badge-status badge-direkomendasi_bk">Direkomendasi ke BK</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    <a href="{{ route('tindak-lanjut-awal.show', $item['id']) }}" 
                                       class="action-btn"
                                       style="color: #3b82f6;"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role === 'wali_kelas')
                                        @if($item['status'] == 'diproses')
                                            <a href="{{ route('tindak-lanjut-awal.edit', $item['id']) }}" 
                                               class="action-btn"
                                               style="color: #10b981;"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @elseif($item['status'] == 'selesai')
                                            <a href="{{ route('tindak-lanjut-awal.selesai', $item['id']) }}" 
                                               class="action-btn"
                                               style="color: #10b981;"
                                               title="Lihat Penyelesaian">
                                                <i class="fas fa-edit"></i>
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
            <p style="color: #6b7280; font-size: 14px;">Tidak ada data yang sesuai dengan filter.</p>
        </div>
    @else
        <div style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-inbox" style="font-size: 48px; color: #d1d5db; margin-bottom: 12px; display: block;"></i>
            <p style="color: #6b7280; font-size: 14px;">Belum ada data tindak lanjut awal.</p>
        </div>
    @endif
    </div>
</div>

<script>
function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const table = document.getElementById('tindakLanjutAwalTable');
    
    if (!table) return;
    
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');
    const noResults = document.getElementById('noResults');
    
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        
        if (cells.length === 0) continue;

        const nomorLaporan = cells[1].textContent.toLowerCase();
        const pelapor = cells[3].textContent.toLowerCase();
        const korban = cells[4].textContent.toLowerCase();
        const statusText = cells[5].textContent.toLowerCase();

        const matchesSearch = searchInput === '' || 
                            nomorLaporan.includes(searchInput) ||
                            pelapor.includes(searchInput) ||
                            korban.includes(searchInput);

        let matchesStatus = true;
        if (statusFilter !== '') {
            if (statusFilter === 'diproses') {
                matchesStatus = statusText.includes('diproses');
            } else if (statusFilter === 'selesai') {
                matchesStatus = statusText.includes('selesai');
            } else if (statusFilter === 'direkomendasi_bk') {
                matchesStatus = statusText.includes('direkomendasi');
            }
        }

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    }

    // Show/hide no results message
    if (noResults) {
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
    if (table) {
        table.style.display = visibleCount === 0 ? 'none' : 'table';
    }
}

function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterTable();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    filterTable();
});
</script>

@endsection
