@extends('layouts.app')

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 26px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        border: none;
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-width: 0;
        min-width: 260px;
        max-width: 320px;
        transition: box-shadow 0.2s;
    }
    
    .stat-label {
        color: #6b7280;
        font-size: 15px;
        font-weight: 500;
        margin: 0;
        white-space: nowrap;
    }
    
    .stat-number {
        color: #1f2937;
        font-size: 34px;
        font-weight: bold;
        margin: 10px 0 0 0;
        word-break: break-word;
    }
    
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        min-width: 44px;
        min-height: 44px;
        box-shadow: 0 2px 8px rgba(75,126,196,0.07);
    }

    .table-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: none;
    }

    .table-title {
        color: #1f2937;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        background: #f3f4f6;
        color: #374151;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
        font-size: 13px;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 13px;
        color: #1f2937;
    }

    .data-table tbody tr:hover {
        background: #f9fafb;
    }

    .badge-role {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
    }

    .badge-siswa {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-admin {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-kepala_sekolah {
        background-color: #ffedd5;
        color: #9a3412; 
    }

    .badge-guru_bk {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-wali_kelas {
        background-color: #cffafe;
        color: #155e75;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        background: white;
        border: 1px solid #e5e7eb;
        padding: 5px 8px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .filter-input {
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 13px;
        background: white;
    }

    .filter-input:focus {
        outline: none;
        border-color: #4B7EC4;
        box-shadow: 0 0 0 3px rgba(75, 126, 196, 0.1);
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 13px;
        background: white;
        cursor: pointer;
        min-width: 150px;
    }

    .filter-select:focus {
        outline: none;
        border-color: #4B7EC4;
        box-shadow: 0 0 0 3px rgba(75, 126, 196, 0.1);
    }

    .filter-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .filter-btn-primary {
        background: linear-gradient(135deg, #4B7EC4 0%, #2C5AA0 100%);
        color: white;
    }

    .filter-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(75, 126, 196, 0.3);
    }

    .filter-btn-secondary {
        background: white;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }

    .filter-btn-secondary:hover {
        background: #f9fafb;
    }
    /* Responsive Card Grid & Scrollable */
    .stat-scroll-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: thin;
        scrollbar-color: #d1d5db #f3f4f6;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    .stat-scroll-container::-webkit-scrollbar {
        height: 6px;
    }
    .stat-scroll-container::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }
    .stat-scroll-container::-webkit-scrollbar-track {
        background: #f3f4f6;
    }
    @media (max-width: 767.98px) {
        .stat-scroll-wrapper {
            position: relative;
        }
        .stat-scroll-container {
            margin-left: -8px;
            margin-right: -8px;
            padding-left: 16px;
            padding-right: 16px;
        }
        .stat-card {
            min-width: 78vw;
            max-width: 90vw;
            flex: 0 0 auto;
            flex-direction: row;
            padding: 18px 10px;
        }
        .stat-number {
            font-size: 22px;
        }
        .stat-icon {
            width: 32px;
            height: 32px;
            font-size: 16px;
            min-width: 32px;
            min-height: 32px;
        }
        .stat-arrow-btn {
            display: flex;
        }
    }

    .stat-arrow-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        background: white;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        color: #4B7EC4;
        transition: background 0.2s, box-shadow 0.2s;
    }
    .stat-arrow-btn:active {
        background: #f3f4f6;
    }
    .stat-arrow-btn.left {
        left: 0;
    }
    .stat-arrow-btn.right {
        right: 0;
    }

    /* Responsive Filter Section */
    .filter-section {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    @media (max-width: 575.98px) {
        .filter-section {
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
        }
        .filter-section > * {
            width: 100% !important;
            min-width: 0 !important;
        }
        .table-card {
            padding: 10px;
        }
        .table-title {
            font-size: 15px;
        }
        .data-table thead th, .data-table tbody td {
            padding: 8px 6px;
            font-size: 12px;
        }
    }
</style>

<!-- Header -->
<div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Manajemen User</h3>
        <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola data pengguna sistem</p>
    </div>
    <div>
        <a href="{{ route('users.create') }}" class="btn" style="background: linear-gradient(135deg, #4B7EC4 0%, #2C5AA0 100%); border: none; color: white; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fas fa-plus"></i>Tambah User
        </a>
    </div>
</div>

<!-- Statistics Grid Scrollable with Arrows -->
<div class="stat-scroll-wrapper mb-4" style="position: relative;">
    <button type="button" class="stat-arrow-btn left" onclick="scrollStatCards(-1)" aria-label="Geser kiri">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="stat-scroll-container">
        <div class="stat-card">
            <div>
                <p class="stat-label">Total User</p>
                <p class="stat-number" style="color: #5B8BC5;">{{ $users->count() }}</p>
            </div>
            <div class="stat-icon" style="background: #dbeafe; color: #5B8BC5;">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Guru BK</p>
                <p class="stat-number" style="color: #1e40af;">{{ $users->where('role', 'guru_bk')->count() }}</p>
            </div>
            <div class="stat-icon" style="background: #dbeafe; color: #1e40af;">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Wali Kelas</p>
                <p class="stat-number" style="color: #0891b2;">{{ $users->where('role', 'wali_kelas')->count() }}</p>
            </div>
            <div class="stat-icon" style="background: #cffafe; color: #0891b2;">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Siswa</p>
                <p class="stat-number" style="color: #16a34a;">{{ $users->where('role', 'siswa')->count() }}</p>
            </div>
            <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>
    <button type="button" class="stat-arrow-btn right" onclick="scrollStatCards(1)" aria-label="Geser kanan">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>
<script>
// Scroll stat cards horizontally by card width
function scrollStatCards(direction) {
    const container = document.querySelector('.stat-scroll-container');
    const card = container.querySelector('.stat-card');
    if (!container || !card) return;
    const scrollAmount = card.offsetWidth + 24; // 24px gap
    container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}

// Show/hide arrow buttons only on mobile
function updateStatArrowVisibility() {
    const leftBtn = document.querySelector('.stat-arrow-btn.left');
    const rightBtn = document.querySelector('.stat-arrow-btn.right');
    if (window.innerWidth <= 767) {
        leftBtn.style.display = 'flex';
        rightBtn.style.display = 'flex';
    } else {
        leftBtn.style.display = 'none';
        rightBtn.style.display = 'none';
    }
}
window.addEventListener('resize', updateStatArrowVisibility);
document.addEventListener('DOMContentLoaded', updateStatArrowVisibility);
</script>

<!-- Table Data User -->
<div class="table-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h5 class="table-title" style="margin-bottom: 0;">Tabel Data User</h5>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <div style="position: relative; width: 250px; min-width: 0;">
                <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 13px;"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="filter-input" 
                    placeholder="Cari nama atau email..."
                    onkeyup="filterTable()"
                    style="width: 100%; padding: 8px 12px 8px 36px; font-size: 13px;"
                >
            </div>
            <select id="roleFilter" class="filter-select" onchange="filterTable()" style="min-width: 140px;">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="kepala_sekolah">Kepala Sekolah</option>
                <option value="guru_bk">Guru BK</option>
                <option value="wali_kelas">Wali Kelas</option>
                <option value="siswa">Siswa</option>
            </select>
            <button class="filter-btn filter-btn-secondary" onclick="resetFilter()" style="padding: 8px 12px;">
                <i class="fas fa-redo" style="font-size: 13px;"></i>
                Reset
            </button>
        </div>
    </div>

    @if ($users->count() > 0)
    <div style="overflow-x: auto;">
        <table class="data-table" id="userTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <span style="font-weight: 600; color: #4B7EC4;">{{ $loop->iteration }}</span>
                    </td>
                    <td class="user-name">{{ $user->name }}</td>
                    <td class="user-email">{{ $user->email }}</td>
                    <td>
                        <span class="badge-role badge-{{ $user->role }} user-role" data-role="{{ $user->role }}">
                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('users.edit', $user) }}" class="action-btn" style="color: #10b981;" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if (!in_array($user->role, ['admin', 'kepala_sekolah']))
                                <button class="action-btn" style="color: #ef4444;" title="Hapus"
                                    onclick="if(confirm('Yakin ingin menghapus user ini?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @else
                                <span class="badge-role badge-admin">Permanen</span>
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
        <i class="fas fa-users" style="font-size: 48px; color: #d1d5db; margin-bottom: 12px; display: block;"></i>
        <p style="color: #6b7280; font-size: 14px;">Belum ada user. Tambah user baru untuk memulai.</p>
    </div>
    @endif
</div>

@if (session('success'))
<div style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999;">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<script>
function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
    const table = document.getElementById('userTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');
    const noResults = document.getElementById('noResults');
    
    let visibleCount = 0;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const name = row.querySelector('.user-name').textContent.toLowerCase();
        const email = row.querySelector('.user-email').textContent.toLowerCase();
        const role = row.querySelector('.user-role').getAttribute('data-role').toLowerCase();

        const matchesSearch = name.includes(searchInput) || email.includes(searchInput);
        const matchesRole = roleFilter === '' || role === roleFilter;

        if (matchesSearch && matchesRole) {
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
    document.getElementById('roleFilter').value = '';
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