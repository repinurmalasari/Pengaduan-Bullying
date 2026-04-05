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

    .stat-card.card-direncanakan {
        border-left-color: #3b82f6;
    }

    .stat-card.card-diproses {
        border-left-color: #f59e0b;
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

    .badge-direncanakan {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-sedang_berjalan {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-diproses {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-selesai {
        background-color: #dcfce7;
        color: #166534;
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
        min-width: 160px;
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
    <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Data Tindak Lanjut</h3>
    <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola data tindak lanjut pengaduan bullying</p>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stats-scroll-wrapper">
        <div class="stats-grid">
            <!-- Total -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-total" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Total</p>
                        <p class="stat-number" style="color: #5B8BC5;">{{ $total ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #5B8BC5;">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>

            <!-- Direncanakan -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-direncanakan" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Direncanakan</p>
                        <p class="stat-number" style="color: #3b82f6;">{{ $direncanakan ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #3b82f6;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>

            <!-- Diproses -->
            <div class="stat-card-wrapper">
                <div class="stat-card card-diproses" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="stat-label">Diproses</p>
                        <p class="stat-number" style="color: #f59e0b;">{{ $sedangBerjalan ?? 0 }}</p>
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
                        <p class="stat-number" style="color: #16a34a;">{{ $selesai ?? 0 }}</p>
                    </div>
                    <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-header-section">
        <h5 class="table-title"> Tabel Data Tindak Lanjut</h5>
    </div>
    
    <div class="table-content-section">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="filter-input" placeholder="Cari nomor/jenis tindakan..." onkeyup="filterTable()">
            </div>
            
            <select id="statusFilter" class="filter-select" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="direncanakan">Direncanakan</option>
                <option value="sedang_berjalan">Sedang Berjalan</option>
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai</option>
            </select>

            <button class="filter-btn" onclick="resetFilter()">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>

    @if ($tindakLanjut->count() > 0)
    <div style="overflow-x: auto;">
        <table class="data-table" id="tindakLanjutTable">
            <thead>
                <tr>
                    <th>Nomor Tindakan</th>
                    <th>Nomor Laporan</th>
                    <th>Jenis Tindakan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Tindakan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tindakLanjut as $item)
                <tr>
                    <td>
                        <span class="nomor-tindakan" style="font-weight: 600; color: #4B7EC4;">{{ $item['nomor_tindakan'] }}</span>
                    </td>
                    <td class="nomor-laporan">{{ $item['nomor_laporan'] }}</td>
                    <td class="jenis-tindakan">{{ $item['jenis_tindakan'] }}</td>
                    <td class="deskripsi-tindakan">{{ Str::limit($item['deskripsi'], 40) }}</td>
                    <td class="tanggal-tindakan">{{ $item['tanggal_tindakan'] }}</td>
                    <td>
                        <span class="badge-status badge-{{ $item['status'] }} status-tindakan" data-status="{{ $item['status'] }}">
                            {{ ucfirst(str_replace('_', ' ', $item['status'])) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('tindak-lanjut.show', $item['id']) }}" class="action-btn" style="color: #3b82f6;" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(auth()->user()->role === 'guru_bk')
                            <a href="{{ route('tindak-lanjut.edit', $item['id']) }}" class="action-btn" style="color: #10b981;" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="action-btn" style="color: #ef4444;" title="Hapus" onclick="if(confirm('Hapus tindak lanjut ini?')) { document.getElementById('delete-form-{{ $item['id'] }}').submit(); }">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $item['id'] }}" action="{{ route('tindak-lanjut.destroy', $item['id']) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
        <p style="color: #6b7280; font-size: 14px;">Belum ada tindak lanjut yang dibuat.</p>
    </div>
    @endif
    </div>
</div>

@if (session('success'))
<div style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999;">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<script>
function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const table = document.getElementById('tindakLanjutTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');
    const noResults = document.getElementById('noResults');
    
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const nomorTindakan = row.querySelector('.nomor-tindakan').textContent.toLowerCase();
        const nomorLaporan = row.querySelector('.nomor-laporan').textContent.toLowerCase();
        const jenisTindakan = row.querySelector('.jenis-tindakan').textContent.toLowerCase();
        const status = row.querySelector('.status-tindakan').getAttribute('data-status').toLowerCase();

        const matchesSearch = nomorTindakan.includes(searchInput) || 
                            nomorLaporan.includes(searchInput) || 
                            jenisTindakan.includes(searchInput);
        const matchesStatus = statusFilter === '' || status === statusFilter;

        if (matchesSearch && matchesStatus) {
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

function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterTable();
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
});
</script>
@endsection