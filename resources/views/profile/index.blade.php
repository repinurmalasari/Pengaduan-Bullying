@extends('layouts.app')

@section('content')
<style>
    .profile-wrapper {
        padding: 36px 16px;
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        overflow: hidden;
        animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 40px 32px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .profile-header {
        background: linear-gradient(135deg, #5b8db8 0%, #4a7ba7 100%);
        height: 120px;
        position: relative;
        overflow: hidden;
        border-top-left-radius: 32px;
        border-top-right-radius: 32px;
        border-bottom-left-radius: 50% 30px;
        border-bottom-right-radius: 50% 30px;
        box-shadow: 0 4px 24px rgba(74,123,167,0.08);
    }

    .profile-avatar-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        position: relative;
        z-index: 11;
        margin-top: -40px;
        margin-bottom: 10px;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 15s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-30px, -30px); }
    }

    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4285f4, #3367d6);
        border: 7px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        font-weight: bold;
        box-shadow: 0 12px 36px rgba(0,0,0,0.18);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        overflow: hidden;
        position: relative;
        z-index: 10;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .avatar:hover {
        transform: scale(1.08);
        box-shadow: 0 16px 40px rgba(66, 133, 244, 0.4);
    }
    
    .avatar:hover img {
        transform: scale(1.1);
    }
    
    /* Avatar upload overlay */
    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .avatar:hover .avatar-overlay {
        opacity: 1;
    }
    
    .avatar-overlay i {
        color: white;
        font-size: 24px;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }
    
    .avatar:hover .avatar-overlay i {
        transform: translateY(0);
    }

    .avatar-upload-controls {
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 12;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .profile-avatar-wrapper:hover .avatar-upload-controls {
        opacity: 1;
        visibility: visible;
        bottom: -8px;
    }

    .avatar-btn {
        background: white;
        border: 2px solid #e5e7eb;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        color: #6b7280;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .avatar-btn:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        transform: scale(1.2) rotate(10deg);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .avatar-btn.delete-btn:hover {
        background: #ef4444;
        border-color: #ef4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .profile-content {
        padding: 70px 24px 24px;
    }

    .profile-info {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-info h3 {
        font-size: 24px;
        margin-bottom: 6px;
        color: #1a1a1a;
        font-weight: 700;
    }

    .profile-info p {
        font-size: 14px;
        color: #5b8db8;
        margin-bottom: 10px;
        font-weight: 500;
        text-transform: capitalize;
    }

    .badge {
        display: inline-block;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-bottom: 16px;
    }

    .stat {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 8px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: default;
    }

    .stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }

    .stat-number {
        font-size: 20px;
        font-weight: bold;
        color: #1a1a1a;
        margin-bottom: 2px;
    }

    .stat-label {
        font-size: 10px;
        color: #6b7280;
    }

    .tabs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 8px;
        margin-bottom: 20px;
    }

    .tab {
        background: white;
        border: 2px solid #e5e7eb;
        color: #6b7280;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .tab::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(74, 123, 167, 0.1), transparent);
        transition: left 0.5s;
    }

    .tab:hover::before {
        left: 100%;
    }

    .tab:hover {
        background: #f9fafb;
        border-color: #4a7ba7;
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .tab.active {
        background: linear-gradient(135deg, #4a7ba7, #3a6b97);
        border-color: #4a7ba7;
        color: white;
        transform: translateY(0);
        box-shadow: 0 6px 20px rgba(74, 123, 167, 0.4);
    }

    .tab:active {
        transform: translateY(0) scale(0.97);
    }

    .tab-content {
        display: none;
        animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .content-box {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .content-box:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 12px;
        border-bottom: 2px solid #e5e7eb;
    }

    .btn-edit {
        background: linear-gradient(135deg, #4a7ba7, #3a6b97);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(74, 123, 167, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #3a6b97, #2a5b87);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 123, 167, 0.4);
    }

    .btn-edit:active {
        transform: translateY(0) scale(0.98);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-input {
        padding: 12px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    .form-input:read-only {
        background: #f3f4f6;
        color: #6b7280;
    }

    .notif-item, .security-item {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 14px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        color: inherit;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .notif-item:hover, .security-item:hover {
        border-color: #4a7ba7;
        transform: translateX(6px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #ffffff, #f9fafb);
    }

    .notif-item:active, .security-item:active {
        transform: translateX(3px) scale(0.99);
    }

    .item-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .notif-item:hover .item-icon,
    .security-item:hover .item-icon {
        transform: scale(1.15) rotate(8deg);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .item-body {
        flex: 1;
    }

    .item-title {
        font-size: 14px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .item-desc {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 48px;
        color: #d1d5db;
        margin-bottom: 16px;
    }

    .empty-state p {
        font-size: 14px;
        margin: 0;
    }

    .badge-new {
        background: #4a7ba7;
        color: white;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 9px;
        font-weight: 600;
        margin-left: 8px;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #4a7ba7, #3a6b97);
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 20px 24px;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 28px;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 2px solid #e5e7eb;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background: linear-gradient(135deg, #f9fafb, #f3f4f6);
        color: #374151;
        font-weight: 700;
        font-size: 13px;
        border: none;
        padding: 14px 12px;
    }

    .table tbody td {
        padding: 12px;
        font-size: 13px;
        border-color: #f3f4f6;
        vertical-align: middle;
    }

    .table tbody td code {
        background: #f3f4f6;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        color: #4a7ba7;
    }

    .table tbody td small {
        display: block;
        margin-top: 2px;
    }

    .table-hover tbody tr:hover {
        background: #f9fafb;
        transform: scale(1.01);
        transition: all 0.2s;
    }

    .badge {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .profile-card {
            padding: 38px 18px;
            border-radius: 32px;
        }
        .profile-wrapper {
            padding: 10vw 0;
        }
        .tabs {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-wrapper">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px; border-radius: 12px; border-left: 4px solid #10b981;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 20px; border-radius: 12px; border-left: 4px solid #ef4444;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin-bottom: 20px; border-radius: 12px; border-left: 4px solid #4a7ba7;">
            <i class="fas fa-info-circle"></i> {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-header"></div>
        <div class="profile-avatar-wrapper">
            @if(in_array(auth()->user()->role, ['admin', 'kepala_sekolah']))
                {{-- Avatar tanpa fitur upload untuk admin dan kepala sekolah --}}
                <div class="avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" id="avatarPreview">
                    @else
                        <span id="avatarInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                </div>
            @else
                {{-- Avatar dengan fitur upload untuk role lain --}}
                <div class="avatar" onclick="document.getElementById('avatarInput').click()" style="cursor: pointer;">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" id="avatarPreview">
                    @else
                        <span id="avatarInitial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                    <div class="avatar-overlay">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="avatar-upload-controls">
                    <button type="button" class="avatar-btn" onclick="event.stopPropagation(); document.getElementById('avatarInput').click()" title="Ubah Foto">
                        <i class="fas fa-camera"></i>
                    </button>
                    @if(Auth::user()->avatar)
                    <form action="{{ route('profile.avatar.delete') }}" method="POST" style="display: inline;" id="deleteAvatarForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="avatar-btn delete-btn" onclick="event.stopPropagation(); if(confirm('Hapus foto profil?')) document.getElementById('deleteAvatarForm').submit();" title="Hapus Foto">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            @endif
        </div>

        <div class="profile-content">
            <div class="profile-info">
                <h3>{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->role ?? 'guru_bk' }}</p>
                <span class="badge"><i class="fas fa-check-circle"></i> Verified Account</span>
            </div>

            @if(in_array(auth()->user()->role, ['admin', 'kepala_sekolah']))
            <div class="tabs">
                <button class="tab active" onclick="showTab(0)"><i class="fas fa-user-cog"></i> Pengaturan</button>
                <button class="tab" onclick="showTab(1)"><i class="fas fa-shield-alt"></i> Keamanan</button>
            </div>
            @else
            <div class="tabs">
                <button class="tab active" onclick="showTab(0)"><i class="fas fa-user-cog"></i> Pengaturan</button>
                <button class="tab" onclick="showTab(1)">
                    <i class="fas fa-bell"></i> Notifikasi
                    @if($notifications->where('read_at', null)->count() > 0)
                        <span class="badge-new">{{ $notifications->where('read_at', null)->count() }}</span>
                    @endif
                </button>
                <button class="tab" onclick="showTab(2)"><i class="fas fa-shield-alt"></i> Keamanan</button>
            </div>
            @endif
            </div>

            <!-- Tab 1: Pengaturan -->
            <div class="tab-content active">
                <div class="content-box">
                    <div class="section-title">
                        <span>Data Pribadi</span>
                        <button class="btn-edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</button>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input class="form-input" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input class="form-input" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>

                    @if(in_array(auth()->user()->role, ['siswa', 'guru_bk', 'wali_kelas']))
                    <div class="form-row">
                        @if(auth()->user()->role == 'siswa')
                        <div class="form-group">
                            <label class="form-label">NIS</label>
                            <input class="form-input" value="{{ Auth::user()->nip ?? '-' }}" readonly>
                        </div>
                        @elseif(in_array(auth()->user()->role, ['guru_bk', 'wali_kelas']))
                        <div class="form-group">
                            <label class="form-label">NIP</label>
                            <input class="form-input" value="{{ Auth::user()->nip ?? '-' }}" readonly>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input class="form-input" value="{{ Auth::user()->phone ?? '-' }}" readonly>
                        </div>
                    </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Peran</label>
                            <input class="form-input" value="{{ auth()->user()->role }}" readonly>
                        </div>
                        @if(in_array(auth()->user()->role, ['siswa', 'wali_kelas']))
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <input class="form-input" value="{{ Auth::user()->kelas ?? '-' }}" readonly>
                        </div>
                        @else
                        <div class="form-group">
                            <label class="form-label">Terdaftar Sejak</label>
                            <input class="form-input" value="{{ Auth::user()->created_at->format('d F Y') }}" readonly>
                        </div>
                        @endif
                    </div>

                    @if(in_array(auth()->user()->role, ['siswa', 'guru_bk', 'wali_kelas']))
                    <div class="form-group full">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-input" rows="2" readonly>{{ Auth::user()->address ?? '-' }}</textarea>
                    </div>
                    @endif
                </div>
            </div>

            @if(!in_array(auth()->user()->role, ['admin', 'kepala_sekolah']))
            <!-- Tab 2: Notifikasi -->
            <div class="tab-content">
                <div class="content-box">
                    <div class="section-title">
                        <span>Aktivitas Terkini</span>
                        @if($notifications->count() > 0)
                            <a href="{{ route('notifications.index') }}" class="btn-edit" style="text-decoration: none;">
                                <i class="fas fa-list"></i> Lihat Semua
                            </a>
                        @endif
                    </div>

                    @if($notifications->count() > 0)
                        @foreach($notifications->take(5) as $notification)
                            <a href="{{ route('notifications.show', $notification->id) }}" class="notif-item">
                                <div class="item-icon" style="background: {{ $notification->read_at ? '#f3f4f6' : '#dbeafe' }}; color: {{ $notification->read_at ? '#9ca3af' : '#3b82f6' }};">
                                    <i class="fas {{ $notification->read_at ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                </div>
                                <div class="item-body">
                                    <div class="item-title">
                                        {{ $notification->data['judul'] ?? 'Notifikasi Baru' }}
                                        @if(!$notification->read_at)
                                            <span class="badge-new">BARU</span>
                                        @endif
                                    </div>
                                    <div class="item-desc">
                                        {{ Str::limit($notification->data['pesan'] ?? '', 60) }} • 
                                        {{ $notification->created_at->format('d-m-Y H:i') }}
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right" style="color: #9ca3af; font-size: 12px;"></i>
                            </a>
                        @endforeach

                        @if($notifications->count() > 5)
                            <div style="text-align: center; margin-top: 16px;">
                                <a href="{{ route('notifications.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-arrow-right"></i> Lihat {{ $notifications->count() - 5 }} notifikasi lainnya
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <i class="far fa-bell"></i>
                            <p>Belum ada notifikasi</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Tab 2/3: Keamanan -->
            <div class="tab-content">
                <div class="content-box">
                    <div class="section-title">Keamanan & Privasi</div>

                    <div class="security-item" data-toggle="modal" data-target="#passwordModal" style="cursor: pointer;">
                        <div class="item-icon" style="background: #3b82f6; color: white;"><i class="fas fa-key"></i></div>
                        <div class="item-body">
                            <div class="item-title">Ubah Password</div>
                            <div class="item-desc">Perbarui kata sandi akun</div>
                        </div>
                        <span><i class="fas fa-chevron-right"></i></span>
                    </div>

                    <a href="{{ route('two-factor.setup') }}" class="security-item" style="cursor: pointer; text-decoration: none; color: inherit;">
                        <div class="item-icon" style="background: {{ $user->two_factor_enabled ? '#10b981' : '#6b7280' }}; color: white;">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="item-body">
                            <div class="item-title">
                                Two-Factor Auth
                                @if($user->two_factor_enabled)
                                    <span class="badge badge-success ml-2" style="font-size: 10px;">Aktif</span>
                                @endif
                            </div>
                            <div class="item-desc">
                                {{ $user->two_factor_enabled ? 'Kelola autentikasi 2FA' : 'Aktifkan autentikasi 2FA' }}
                            </div>
                        </div>
                        <span><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <div class="security-item" data-toggle="modal" data-target="#loginHistoryModal" style="cursor: pointer;">
                        <div class="item-icon" style="background: #a855f7; color: white;"><i class="fas fa-history"></i></div>
                        <div class="item-body">
                            <div class="item-title">Riwayat Login</div>
                            <div class="item-desc">Lihat aktivitas login</div>
                        </div>
                        <span><i class="fas fa-chevron-right"></i></span>
                    </div>

                    <div class="security-item" data-toggle="modal" data-target="#logoutAllModal" style="cursor: pointer;">
                        <div class="item-icon" style="background: #ef4444; color: white;"><i class="fas fa-sign-out-alt"></i></div>
                        <div class="item-body">
                            <div class="item-title">Keluar Semua Device</div>
                            <div class="item-desc">Logout semua perangkat</div>
                        </div>
                        <span><i class="fas fa-chevron-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input name="name" class="form-input" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input name="email" type="email" class="form-input" value="{{ $user->email }}" required>
                        </div>
                        
                        @if(in_array($user->role, ['siswa', 'guru_bk', 'wali_kelas']))
                        <div class="form-group">
                            <label class="form-label">{{ in_array($user->role, ['guru_bk', 'wali_kelas']) ? 'NIP' : 'NIS' }}</label>
                            <input name="nip" class="form-input" value="{{ $user->nip }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input name="phone" class="form-input" value="{{ $user->phone }}">
                        </div>
                        @endif
                        
                        @if(in_array($user->role, ['siswa', 'wali_kelas']))
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <input name="kelas" class="form-input" value="{{ $user->kelas }}">
                        </div>
                        @endif
                        
                        @if(in_array($user->role, ['siswa', 'guru_bk', 'wali_kelas']))
                        <div class="form-group full">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-input" rows="2">{{ $user->address }}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-edit"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hidden Avatar Upload Form -->
<form id="avatarForm" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
    @csrf
    @method('POST')
    <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="uploadAvatar()">
</form>

<!-- Modal Change Password -->
<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-key"></i> Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Password Lama *</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru *</label>
                        <input type="password" name="password" class="form-control" required minlength="8">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru *</label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Logout All Devices -->
<div class="modal fade" id="logoutAllModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-sign-out-alt"></i> Keluar Semua Device</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('profile.logout-all') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Anda akan keluar dari semua perangkat yang sedang login, kecuali perangkat ini.</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Anda harus login ulang di perangkat lain.
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required placeholder="Masukkan password untuk konfirmasi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Ya, Keluar Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Two-Factor Authentication -->
<div class="modal fade" id="twoFactorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-mobile-alt"></i> Two-Factor Authentication</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center" style="padding: 30px 20px;">
                    <i class="fas fa-shield-alt" style="font-size: 64px; color: #10b981; margin-bottom: 20px;"></i>
                    <h5 style="color: #1f2937; margin-bottom: 12px; font-weight: 700;">Tingkatkan Keamanan Akun</h5>
                    <p style="color: #6b7280; margin-bottom: 24px; line-height: 1.6;">Two-Factor Authentication (2FA) menambahkan lapisan keamanan ekstra ke akun Anda dengan meminta kode verifikasi tambahan saat login.</p>
                    
                    <div class="row text-left" style="margin-bottom: 24px;">
                        <div class="col-md-6 mb-3">
                            <div style="padding: 16px; background: #f0fdf4; border-radius: 8px; border-left: 4px solid #10b981;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i>
                                <strong>Lebih Aman</strong>
                                <p style="margin: 8px 0 0 0; font-size: 12px; color: #6b7280;">Lindungi akun dari akses tidak sah</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div style="padding: 16px; background: #eff6ff; border-radius: 8px; border-left: 4px solid #4a7ba7;">
                                <i class="fas fa-mobile-alt" style="color: #4a7ba7; margin-right: 8px;"></i>
                                <strong>Mudah Digunakan</strong>
                                <p style="margin: 8px 0 0 0; font-size: 12px; color: #6b7280;">Verifikasi melalui SMS atau aplikasi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info" style="background: #e0f2fe; border: none; color: #0c4a6e;">
                        <i class="fas fa-info-circle"></i> <strong>Segera Hadir!</strong> Fitur 2FA sedang dalam pengembangan dan akan tersedia dalam update mendatang.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Login History -->
<div class="modal fade" id="loginHistoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-history"></i> Riwayat Login</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar"></i> Waktu</th>
                                <th><i class="fas fa-map-marker-alt"></i> IP Address</th>
                                <th><i class="fas fa-laptop"></i> Device</th>
                                <th><i class="fas fa-globe"></i> Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loginHistory as $history)
                            <tr>
                                <td>
                                    <strong>{{ $history->login_at->format('d M Y') }}</strong><br>
                                    <small class="text-muted">{{ $history->login_at->format('H:i') }} WIB</small>
                                </td>
                                <td>
                                    <code>{{ $history->ip_address }}</code><br>
                                    <small class="text-muted">{{ $history->platform ?? 'Unknown' }}</small>
                                </td>
                                <td>
                                    <i class="fas fa-{{ $history->device == 'Desktop' ? 'desktop' : 'mobile' }}"></i> 
                                    {{ $history->device ?? 'Unknown' }}
                                </td>
                                <td>
                                    {{ $history->browser ?? 'Unknown' }}
                                    @if($loop->first)
                                        <br><span class="badge badge-success mt-1">Aktif Sekarang</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle"></i> Belum ada riwayat login
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(index) {
    // Remove active dari semua
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    
    // Add active ke yang dipilih
    document.querySelectorAll('.tab')[index].classList.add('active');
    document.querySelectorAll('.tab-content')[index].classList.add('active');
}

function uploadAvatar() {
    const form = document.getElementById('avatarForm');
    const input = document.getElementById('avatarInput');
    const avatar = document.querySelector('.avatar');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarInitial = document.getElementById('avatarInitial');
    
    if (input.files && input.files[0]) {
        // Validate file size (2MB max)
        if (input.files[0].size > 2048000) {
            Swal.fire({
                icon: 'error',
                title: 'File Terlalu Besar',
                text: 'Ukuran file maksimal 2MB',
                confirmButtonColor: '#4A7AB5'
            });
            input.value = '';
            return;
        }
        
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(input.files[0].type)) {
            Swal.fire({
                icon: 'error',
                title: 'Format Tidak Didukung',
                text: 'Format file harus jpeg, jpg, png, atau gif',
                confirmButtonColor: '#4A7AB5'
            });
            input.value = '';
            return;
        }
        
        // Preview animation
        const reader = new FileReader();
        reader.onload = function(e) {
            // Add loading animation
            avatar.style.transition = 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
            avatar.style.transform = 'scale(0.9)';
            avatar.style.opacity = '0.7';
            
            setTimeout(() => {
                // Update preview
                if (avatarPreview) {
                    avatarPreview.src = e.target.result;
                } else if (avatarInitial) {
                    avatarInitial.style.display = 'none';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Avatar';
                    img.id = 'avatarPreview';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '50%';
                    avatar.insertBefore(img, avatar.firstChild);
                }
                
                // Restore animation
                avatar.style.transform = 'scale(1.05)';
                avatar.style.opacity = '1';
                
                setTimeout(() => {
                    avatar.style.transform = 'scale(1)';
                    
                    // Submit form after preview animation
                    setTimeout(() => {
                        // Show uploading indicator
                        Swal.fire({
                            title: 'Mengunggah foto...',
                            html: '<div class="spinner-border text-primary" role="status"></div>',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        form.submit();
                    }, 300);
                }, 200);
            }, 300);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Add pulse animation when hovering avatar
document.addEventListener('DOMContentLoaded', function() {
    const avatar = document.querySelector('.avatar');
    if (avatar) {
        avatar.addEventListener('mouseenter', function() {
            this.style.animation = 'avatarPulse 1s ease-in-out infinite';
        });
        avatar.addEventListener('mouseleave', function() {
            this.style.animation = 'none';
        });
    }
});
</script>

<style>
@keyframes avatarPulse {
    0%, 100% { 
        box-shadow: 0 12px 36px rgba(0,0,0,0.18); 
    }
    50% { 
        box-shadow: 0 12px 36px rgba(66, 133, 244, 0.5); 
    }
}
</style>
@endsection