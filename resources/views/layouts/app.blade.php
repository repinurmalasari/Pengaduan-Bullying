    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->

        
        <style>
            .content-wrapper {
                padding: 15px;
            }

            .content {
                padding: 20px 0;
            }

            /* ===== TAMBAHAN KHUSUS NOTIFIKASI ===== */
            .notif-card {
                display: flex;
                gap: 10px;
                padding: 10px 12px;
                margin: 6px 8px;
                border: 1px solid #e3ebff;
                border-radius: 10px;
                background: #ffffff;
                text-decoration: none !important;
                transition: all 0.2s ease;
            }

            .notif-card:hover {
                background: #f6f9ff;
                transform: translateX(3px);
            }

            .notif-icon {
                width: 32px;
                height: 32px;
                min-width: 32px;
                background: linear-gradient(135deg, #4A7AB5, #5B8BC5);
                color: #fff;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                flex-shrink: 0;
            }

            .notif-content {
                flex: 1;
                min-width: 0;
                overflow: hidden;
            }

            .notif-title {
                font-weight: 600;
                color: #111827;
                font-size: 13px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .notif-text {
                font-size: 12px;
                color: #6b7280;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.4;
            }

            .notif-time {
                font-size: 11px;
                color: #9ca3af;
                margin-top: 2px;
            }

            .dropdown-menu-lg {
                min-width: 280px !important;
                max-width: 320px !important;
            }

            .dropdown-header {
                padding: 8px 12px !important;
                font-size: 13px !important;
            }

            .dropdown-footer {
                padding: 8px 12px !important;
                font-size: 12px !important;
            }
            /* ===== AKHIR TAMBAHAN KHUSUS NOTIFIKASI ===== */

            /* ===== IMPROVED SEARCH STYLING - SIMPLIFIED FIX ===== */
            /* Make search block container relative */
            .navbar-search-block {
                position: relative !important;
            }

            /* Position search results directly below form */
            #searchResults {
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                border: 1px solid #e5e7eb;
                max-height: 400px;
                overflow-y: auto;
                padding: 8px;
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                margin-top: 5px !important;
                z-index: 9999 !important;
            }
            
            #searchResults::-webkit-scrollbar {
                width: 6px;
            }
            
            #searchResults::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 10px;
            }
            
            #searchResults::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
            
            #searchResults::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            
            #searchResults .list-group-item {
                border: none;
                padding: 12px 14px;
                font-size: 13px;
                transition: all 0.2s ease;
                border-radius: 8px;
                margin-bottom: 4px;
                background: transparent;
                text-decoration: none !important;
            }
            
            #searchResults .list-group-item:hover {
                background: linear-gradient(135deg, #f0f7ff 0%, #e6f2ff 100%);
                transform: translateX(4px);
                box-shadow: 0 2px 8px rgba(74, 122, 181, 0.1);
            }
            
            #searchResults .search-category {
                font-size: 10px;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                padding: 12px 14px 6px;
                background: transparent;
                font-weight: 700;
                margin-top: 8px;
                border-bottom: 1px solid #f1f5f9;
            }
            
            #searchResults .search-category:first-child {
                margin-top: 0;
            }
            
            .search-item-content {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            
            .search-item-icon {
                width: 36px;
                height: 36px;
                min-width: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #4A7AB5, #5B8BC5);
                color: white;
                border-radius: 8px;
                font-size: 14px;
                flex-shrink: 0;
            }
            
            .search-item-details {
                flex: 1;
                min-width: 0;
            }
            
            .search-item-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 13px;
                margin-bottom: 2px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.4;
            }
            
            .search-item-subtitle {
                font-size: 11px;
                color: #64748b;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.3;
            }
            
            /* Loading State with Animation */
            .search-loading {
                text-align: center;
                padding: 40px 20px;
            }
            
            .search-loading-spinner {
                width: 48px;
                height: 48px;
                margin: 0 auto 16px;
                position: relative;
            }
            
            .search-loading-spinner::before,
            .search-loading-spinner::after {
                content: '';
                position: absolute;
                border-radius: 50%;
            }
            
            .search-loading-spinner::before {
                width: 100%;
                height: 100%;
                border: 4px solid #e5e7eb;
                border-top-color: #4A7AB5;
                animation: spin 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
            }
            
            .search-loading-spinner::after {
                width: 70%;
                height: 70%;
                top: 15%;
                left: 15%;
                border: 4px solid transparent;
                border-top-color: #5B8BC5;
                animation: spin 0.7s linear infinite reverse;
            }
            
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .search-loading-dots {
                display: flex;
                justify-content: center;
                gap: 6px;
                margin-top: 12px;
            }
            
            .search-loading-dots span {
                width: 8px;
                height: 8px;
                background: #4A7AB5;
                border-radius: 50%;
                animation: bounce 1.4s ease-in-out infinite both;
            }
            
            .search-loading-dots span:nth-child(1) {
                animation-delay: -0.32s;
            }
            
            .search-loading-dots span:nth-child(2) {
                animation-delay: -0.16s;
            }
            
            @keyframes bounce {
                0%, 80%, 100% {
                    transform: scale(0);
                    opacity: 0.5;
                }
                40% {
                    transform: scale(1);
                    opacity: 1;
                }
            }
            
            .search-loading-text {
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                margin: 0;
            }
            
            .search-loading-subtext {
                color: #94a3b8;
                font-size: 11px;
                margin-top: 6px;
            }
            
            /* Empty State */
            .search-empty {
                text-align: center;
                padding: 40px 20px;
            }
            
            .search-empty-icon {
                width: 64px;
                height: 64px;
                margin: 0 auto 16px;
                background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                animation: fadeIn 0.3s ease;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.8);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
            
            .search-empty-icon i {
                font-size: 28px;
                color: #94a3b8;
            }
            
            .search-empty-text {
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                margin: 0 0 6px 0;
            }
            
            .search-empty-subtext {
                color: #94a3b8;
                font-size: 12px;
                margin: 0;
            }
            
            /* Error State */
            .search-error {
                text-align: center;
                padding: 40px 20px;
            }
            
            .search-error-icon {
                width: 64px;
                height: 64px;
                margin: 0 auto 16px;
                background: linear-gradient(135deg, #fee2e2, #fecaca);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                animation: shake 0.5s ease;
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }
            
            .search-error-icon i {
                font-size: 28px;
                color: #dc2626;
            }
            
            .search-error-text {
                color: #dc2626;
                font-size: 14px;
                font-weight: 600;
                margin: 0 0 6px 0;
            }
            
            .search-error-subtext {
                color: #f87171;
                font-size: 12px;
                margin: 0;
            }
            /* ===== END SEARCH STYLING ===== */

            /* ===== RESPONSIVE GLOBAL CSS ===== */
            @media (max-width: 768px) {
                .content-wrapper {
                    padding: 10px !important;
                }
                
                .container-fluid {
                    padding-left: 10px !important;
                    padding-right: 10px !important;
                }
                
                .card {
                    border-radius: 12px !important;
                    margin-bottom: 15px !important;
                }
                
                .card-header {
                    padding: 12px 15px !important;
                }
                
                .card-body {
                    padding: 15px !important;
                }
                
                .table-responsive {
                    font-size: 13px;
                }
                
                .btn {
                    padding: 6px 12px !important;
                    font-size: 12px !important;
                }
                
                .btn-sm {
                    padding: 4px 8px !important;
                    font-size: 11px !important;
                }
                
                h1, h2, h3 {
                    font-size: 1.5rem !important;
                }
                
                .form-control {
                    font-size: 14px !important;
                }
                
                .navbar-badge {
                    font-size: 9px !important;
                    padding: 2px 4px !important;
                }
                
                .nav-link span {
                    display: none;
                }
                
                .dropdown-menu {
                    min-width: 260px !important;
                }
                
                .search-item-icon {
                    width: 32px;
                    height: 32px;
                    min-width: 32px;
                    font-size: 12px;
                }
            }
            
            @media (max-width: 576px) {
                .content-wrapper {
                    padding: 8px !important;
                }
                
                .card-body {
                    padding: 12px !important;
                }
                
                .table td, .table th {
                    padding: 8px 6px !important;
                    font-size: 12px !important;
                }
                
                .pagination {
                    flex-wrap: wrap;
                    gap: 4px;
                }
                
                .page-link {
                    padding: 6px 10px !important;
                    font-size: 12px !important;
                }
                
                .form-row {
                    flex-direction: column;
                }
                
                .form-row > [class*="col-"] {
                    margin-bottom: 10px;
                    padding-left: 0;
                    padding-right: 0;
                }
                
                .btn-group-vertical-sm {
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                }
                
                #searchResults .list-group-item {
                    padding: 10px 12px;
                }
                
                .search-item-content {
                    gap: 10px;
                }
            }

            /* User Dropdown Styling */
            .nav-item.dropdown .dropdown-menu .dropdown-item:hover {
                background: #f3f4f6 !important;
                padding-left: 24px !important;
            }

            .nav-item.dropdown .dropdown-menu .dropdown-item i {
                transition: transform 0.2s ease;
            }

            .nav-item.dropdown .dropdown-menu .dropdown-item:hover i {
                transform: translateX(2px);
            }
            /* ===== END RESPONSIVE GLOBAL CSS ===== */
        </style>
        
        @stack('styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link"></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" id="globalSearchForm">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" id="globalSearch" placeholder="Cari menu, pengaduan, siswa..." aria-label="Search" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="searchResults" class="list-group" style="display: none;"></div>
                    </div>
                </li>

            <!-- Notifications -->
    @if(!in_array(auth()->user()->role, ['admin', 'kepala_sekolah']))
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>

            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="badge badge-warning navbar-badge">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0">

            <span class="dropdown-item dropdown-header">
                {{ auth()->user()->unreadNotifications->count() }} Notifikasi
            </span>

            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                <a href="{{ route('notifications.show',$notification->id) }}" class="notif-card">
                    <div class="notif-icon">
                        <i class="far fa-bell"></i>
                    </div>
                    <div class="notif-content">
                        <div class="notif-title">{{ $notification->data['judul'] }}</div>
                        <div class="notif-text">{{ Str::limit($notification->data['pesan'], 40) }}</div>
                        <div class="notif-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @empty
                <div style="padding: 20px; text-align: center;">
                    <i class="far fa-bell-slash" style="font-size: 24px; color: #d1d5db; margin-bottom: 8px;"></i>
                    <p style="margin: 0; color: #9ca3af; font-size: 12px;">Tidak ada notifikasi baru</p>
                </div>
            @endforelse

            <div class="dropdown-divider"></div>

            <a href="{{ route('notifications.index') }}"
            class="dropdown-item dropdown-footer text-center">
                Lihat Semua
            </a>

        </div>
    </li>
    @endif
                
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" style="gap: 8px;">
                        @if(Auth::user() && Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar_url }}" 
                                alt="Avatar" 
                                style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid #5B8BC5;">
                        @else
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #4285f4, #3367d6); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; border: 2px solid #5B8BC5;">
                                {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G' }}
                            </div>
                        @endif
                        <span style="color: #5B8BC5; font-size: 12px; font-weight: 500;">
                            @if(Auth::user())
                                {{ Auth::user()->name ?? 'User' }}
                            @else
                                Guest
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="min-width: 200px; padding: 8px 0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                        <a href="{{ route('profile.index') }}" class="dropdown-item" style="padding: 10px 20px; display: flex; align-items: center; gap: 12px; transition: all 0.2s;">
                            <i class="fas fa-user" style="width: 20px; color: #4a7ba7;"></i>
                            <span style="color: #333; font-weight: 500;">Profile</span>
                        </a>
                        <div class="dropdown-divider" style="margin: 8px 0;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item" 
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            style="padding: 10px 20px; display: flex; align-items: center; gap: 12px; transition: all 0.2s;">
                                <i class="fas fa-sign-out-alt" style="width: 20px; color: #dc3545;"></i>
                                <span style="color: #dc3545; font-weight: 500;">Log Out</span>
                            </a>
                        </form>
                    </div>
                </li>
            </ul>   
        </nav>
        <!-- /.navbar -->

        <!-- Sidebar Navigation -->
        @include('layouts.navigation')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @isset($header)
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $header }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            
                        </div>
                    </div>
                </div>
            </div>
            @endisset
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>.</strong>
            SMK Negeri 1 Padaherang.
            <div class="float-right d-none d-sm-inline-block">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    <!-- Custom Modal Script -->
    <script>
        (function() {
            var myModalEl = document.querySelector('[data-modal="1"]');
            if (!myModalEl) return;

            if (window.bootstrap && typeof window.bootstrap.Modal === 'function') {
                try {
                    var myModal = new bootstrap.Modal(myModalEl);
                    myModal.show();
                    return;
                } catch (e) {
                    console.error('Bootstrap 5 modal init failed:', e);
                }
            }

            if (window.jQuery && typeof jQuery.fn.modal === 'function') {
                try {
                    jQuery(myModalEl).modal('show');
                    return;
                } catch (e) {
                    console.error('jQuery modal show failed:', e);
                }
            }

            try {
                myModalEl.style.display = 'block';
                myModalEl.classList.add('show');
                myModalEl.setAttribute('aria-hidden', 'false');
            } catch (e) {
                console.error('Manual modal fallback failed:', e);
            }
        })();

        // ===== IMPROVED GLOBAL SEARCH WITH BETTER LOADING =====
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('globalSearch');
            const searchResults = document.getElementById('searchResults');
            let searchTimeout = null;
            
            if (!searchInput || !searchResults) return;

            // Handle search input
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }
                
                if (query.length < 2) {
                    searchResults.style.display = 'none';
                    return;
                }

                // Show enhanced loading state
                searchResults.innerHTML = `
                    <div class="search-loading">
                        <div class="search-loading-spinner"></div>
                        <p class="search-loading-text">Mencari data...</p>
                        <p class="search-loading-subtext">Mohon tunggu sebentar</p>
                        <div class="search-loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                `;
                searchResults.style.display = 'block';
                
                // Debounce search
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            });

            // Perform search function
            function performSearch(query) {
                fetch(`{{ route('search.global') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    displayResults(data, query);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchResults.innerHTML = `
                        <div class="search-error">
                            <div class="search-error-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <p class="search-error-text">Terjadi kesalahan</p>
                            <p class="search-error-subtext">Silakan coba lagi</p>
                        </div>
                    `;
                });
            }

            // Display search results
            function displayResults(data, query) {
                if (!data.results || Object.keys(data.results).length === 0) {
                    searchResults.innerHTML = `
                        <div class="search-empty">
                            <div class="search-empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <p class="search-empty-text">Tidak ada hasil</p>
                            <p class="search-empty-subtext">Untuk pencarian "${escapeHtml(query)}"</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                for (const [category, categoryData] of Object.entries(data.results)) {
                    html += `<div class="search-category">${escapeHtml(categoryData.label)}</div>`;
                    
                    categoryData.items.forEach(item => {
                        html += `
                            <a href="${escapeHtml(item.url)}" class="list-group-item list-group-item-action">
                                <div class="search-item-content">
                                    <div class="search-item-icon">
                                        <i class="fas fa-${escapeHtml(item.icon)}"></i>
                                    </div>
                                    <div class="search-item-details">
                                        <div class="search-item-name">${escapeHtml(item.name)}</div>
                                        ${item.subtitle ? `<div class="search-item-subtitle">${escapeHtml(item.subtitle)}</div>` : ''}
                                    </div>
                                </div>
                            </a>
                        `;
                    });
                }
                
                searchResults.innerHTML = html;
            }

            // Escape HTML to prevent XSS
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Handle Enter key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const firstResult = searchResults.querySelector('a.list-group-item');
                    if (firstResult) {
                        window.location.href = firstResult.href;
                    }
                }
                
                if (e.key === 'Escape') {
                    searchResults.style.display = 'none';
                    searchInput.value = '';
                    searchInput.blur();
                }
            });

            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.style.display = 'none';
                }
            });

            // Clear search when closing navbar search
            document.querySelectorAll('[data-widget="navbar-search"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    setTimeout(() => {
                        searchInput.value = '';
                        searchResults.style.display = 'none';
                    }, 100);
                });
            });

            // Focus search input when search icon is clicked
            const searchToggle = document.querySelector('[data-widget="navbar-search"]');
            if (searchToggle) {
                searchToggle.addEventListener('click', function() {
                    setTimeout(() => {
                        searchInput.focus();
                    }, 200);
                });
            }
        });
    </script>

    @stack('scripts')
    </body>
    </html>