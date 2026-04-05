<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <style>
        /* Override AdminLTE sidebar colors */
        .main-sidebar.sidebar-dark-primary {
            background: linear-gradient(180deg, #4A7AB5 0%, #3A6AA5 100%) !important;
        }

        .sidebar-dark-primary .brand-link {
            background: linear-gradient(180deg, #4A7AB5 0%, #3A6AA5 100%) !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1) !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            padding: 16px 12px !important;
        }

        .sidebar-dark-primary .sidebar {
            background: linear-gradient(180deg, #4A7AB5 0%, #3A6AA5 100%) !important;
        }

        /* Nav items styling */
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 11px 18px !important;
            margin: 6px 14px !important;
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
            transform: translateX(4px);
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: #ffffff !important;
            color: #4A7AB5 !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            transform: translateX(4px);
        }

        .sidebar-dark-primary .nav-sidebar .nav-icon {
            color: inherit !important;
            margin-right: 12px !important;
            font-size: 18px !important;
            min-width: 22px !important;
            text-align: center !important;
        }

        .sidebar-dark-primary .nav-link > p {
            margin: 0 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
        }

        /* Header styling */
        .sidebar-dark-primary .nav-header {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 18px 18px 10px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
        }

        /* Logo styling */
        .navbar-logo {
            width: 45px !important;
            height: 45px !important;
            object-fit: contain !important;
        }

        .brand-link-text {
            display: flex !important;
            flex-direction: column !important;
            gap: 2px !important;
        }

        .brand-title {
            font-weight: 700 !important;
            font-size: 14px !important;
            color: white !important;
            line-height: 1.2 !important;
        }

        .brand-subtitle {
            font-weight: 500 !important;
            font-size: 10px !important;
            color: rgba(255,255,255,0.8) !important;
            line-height: 1.2 !important;
        }

        /* Sidebar collapsed state - icon only */
        .sidebar-collapse .main-sidebar .brand-link-text {
            display: none !important;
        }

        .sidebar-collapse .main-sidebar .brand-link {
            justify-content: center !important;
        }

        .sidebar-collapse .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            text-align: center !important;
            padding: 11px 8px !important;
        }

        .sidebar-collapse .sidebar-dark-primary .nav-sidebar .nav-icon {
            margin-right: 0 !important;
            font-size: 20px !important;
        }

        .sidebar-collapse .sidebar-dark-primary .nav-link > p {
            display: none !important;
        }

        .sidebar-collapse .sidebar-dark-primary .nav-header {
            text-align: center !important;
            padding: 18px 8px 10px !important;
            font-size: 0 !important;
        }

        .sidebar-collapse .sidebar-dark-primary .nav-header::before {
            content: "•••";
            font-size: 12px !important;
            color: rgba(255, 255, 255, 0.4) !important;
        }

        /* Tooltip untuk collapsed sidebar */
        .sidebar-collapse .nav-sidebar > .nav-item > .nav-link {
            position: relative;
        }

        .sidebar-collapse .nav-sidebar > .nav-item > .nav-link:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #2d3748;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            white-space: nowrap;
            margin-left: 10px;
            font-size: 13px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
    </style>
    
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/logo_SMKN1Padaherang.png') }}" alt="Logo" class="navbar-logo">
        <div class="brand-link-text">
            <span class="brand-title">SMKN 1 Padaherang</span>
            <span class="brand-subtitle">Sistem Pengaduan Bullying</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu Header -->
                <li class="nav-header">MENU</li>
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-title="Dashboard">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Pengaduan -->
@if(auth()->user()->role === 'siswa')
    {{-- SISWA --}}
    <li class="nav-item">
        <a href="{{ route('buat-pengaduan.index') }}"
           class="nav-link {{ request()->routeIs('buat-pengaduan.*') ? 'active' : '' }}"
           data-title="Data Pengaduan">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Data Pengaduan</p>
        </a>
    </li>

@elseif(in_array(auth()->user()->role, ['admin', 'guru_bk', 'wali_kelas']))
    {{-- ADMIN, GURU BK, WALI KELAS --}}
    <li class="nav-item">
        <a href="{{ route('pengaduan.index') }}"
           class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}"
           data-title="Data Pengaduan">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Data Pengaduan</p>
        </a>
    </li>
@endif

                <!-- Riwayat Laporan (Siswa) -->
                @if(auth()->user()->role == 'siswa')
                <li class="nav-item">
                    <a href="{{ route('riwayat-pengaduan') }}" class="nav-link {{ request()->routeIs('riwayat-pengaduan') ? 'active' : '' }}" data-title="Riwayat Pengaduan">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Pengaduan</p>
                    </a>
                </li>
                @endif

                <!-- Tindak Lanjut Awal (Wali Kelas) -->
                @if (auth()->user()->role == 'wali_kelas')
                    <li class="nav-item">
                        <a href="{{ route('tindak-lanjut-awal.index') }}" class="nav-link {{ request()->routeIs('tindak-lanjut-awal.*') ? 'active' : '' }}" data-title="Data Tindak Lanjut Awal">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Data Tindak Lanjut Awal</p>
                        </a>
                    </li>
                @endif

                {{-- MENU DATA TINDAK LANJUT DIHAPUS --}}

                <!-- Data Siswa (Admin, Guru BK, Wali Kelas) -->
                @if (in_array(auth()->user()->role, ['admin', 'guru_bk', 'wali_kelas']))
                    <li class="nav-item">
                        <a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}" data-title="Data Siswa">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                @endif

                <!-- Data Guru & Data Wali Kelas (Admin) -->
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('guru.index') }}" class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}" data-title="Data Guru BK">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Data Guru BK</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('wali-kelas.index') }}" class="nav-link {{ request()->routeIs('wali-kelas.*') ? 'active' : '' }}" data-title="Data Wali Kelas">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Data Wali Kelas</p>
                        </a>
                    </li>
                @endif

                {{-- MENU DATA GURU BK DIHAPUS --}}

                {{-- MENU DATA GURU BK DIHAPUS --}}

                {{-- MENU DATA WALI KELAS DIHAPUS --}}

                <!-- Data Tindak Lanjut (Guru BK, Admin) -->
                @if(in_array(auth()->user()->role, ['guru_bk', 'admin']))
                    <li class="nav-item">
                        <a href="{{ route('tindak-lanjut.index') }}" class="nav-link {{ request()->routeIs('tindak-lanjut.*') ? 'active' : '' }}" data-title="Data Tindak Lanjut">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Data Tindak Lanjut</p>
                        </a>
                    </li>
                @endif

                <!-- Laporan (Kepala Sekolah, Admin) -->
                @if (auth()->user()->hasAnyRole(['admin', 'kepala_sekolah']))
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" data-title="Laporan">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif

                <!-- Manajemen User (Admin) -->
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" data-title="Manajemen User">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                @endif

                {{-- MENU DOKUMENTASI DIHAPUS --}}

                <!-- Bantuan -->
                <li class="nav-item">
                    <a href="{{ route('bantuan.index') }}" class="nav-link {{ request()->routeIs('bantuan.*') ? 'active' : '' }}" data-title="Bantuan">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>Bantuan</p>
                    </a>
                </li>

                <!-- Account Header -->
                <li class="nav-header">AKUN</li>
                
                <!-- Profile -->
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" data-title="Profile">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <!-- Keluar -->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-title="Keluar">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>