@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Header Card -->
            <div class="card mb-4" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center" style="gap: 16px;">
                            <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="far fa-bell" style="font-size: 40px; color: white;"></i>
                            </div>
                            <div>
                                <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Daftar Notifikasi</h2>
                                <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 15px;">Kelola semua notifikasi pengaduan Anda</p>
                            </div>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <span style="background: rgba(255,255,255,0.25); color: white; padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 16px; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="far fa-envelope"></i>
                                <span>{{ auth()->user()->unreadNotifications->count() }} Belum Dibaca</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            @forelse($notifications as $notification)
                <div class="notification-card card mb-3" style="border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06); overflow: hidden; border-left: 5px solid {{ $notification->read_at ? '#d1d5db' : '#4A7AB5' }};">
                    <a href="{{ route('notifications.show', $notification->id) }}" 
                       style="text-decoration: none; color: inherit; display: block;">
                        <div style="padding: 24px 28px;">
                            <div class="d-flex align-items-start" style="gap: 20px;">
                                <!-- Icon -->
                                <div style="background: {{ $notification->read_at ? '#e5e7eb' : 'linear-gradient(135deg, #4A7AB5, #5B8BC5)' }}; width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="far fa-bell" style="font-size: 24px; color: {{ $notification->read_at ? '#6b7280' : 'white' }};"></i>
                                </div>

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap">
                                        <h5 style="margin: 0 0 8px 0; font-weight: 600; color: #1a1a1a; font-size: 18px;">
                                            {{ $notification->data['judul'] ?? 'Notifikasi Baru' }}
                                        </h5>
                                        @if(!$notification->read_at)
                                            <span style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; white-space: nowrap; margin-left: 12px;">
                                                Baru
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p style="color: #6b7280; margin: 0 0 12px 0; font-size: 15px; line-height: 1.6;">
                                        {{ $notification->data['pesan'] ?? '' }}
                                    </p>
                                    
                                    <div class="d-flex align-items-center flex-wrap" style="gap: 12px; font-size: 13px; color: #9ca3af;">
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <i class="far fa-clock"></i>
                                            <span>{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                        <span>•</span>
                                        <span>{{ $notification->created_at->format('d F Y, H:i') }}</span>
                                    </div>
                                </div>

                                <!-- Arrow Icon -->
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-chevron-right" style="color: #9ca3af; font-size: 18px;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <!-- Empty State -->
                <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);">
                    <div style="padding: 80px 40px; text-align: center;">
                        <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                            <i class="far fa-bell" style="font-size: 56px; color: #4A7AB5;"></i>
                        </div>
                        <h5 style="color: #1a1a1a; margin-bottom: 12px; font-weight: 600; font-size: 20px;">Tidak Ada Notifikasi</h5>
                        <p style="color: #6b7280; margin: 0; font-size: 15px;">
                            Belum ada notifikasi untuk saat ini
                        </p>
                    </div>
                </div>
            @endforelse

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="card mt-4" style="border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);">
                    <div style="padding: 20px;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="text-muted mb-2 mb-md-0" style="font-size: 14px;">
                                Menampilkan {{ $notifications->firstItem() }} - {{ $notifications->lastItem() }} dari {{ $notifications->total() }} notifikasi
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0" style="gap: 4px;">
                                    {{-- Previous Page Link --}}
                                    @if ($notifications->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" style="border-radius: 8px; border: 1px solid #e5e7eb; color: #9ca3af; padding: 8px 14px;">
                                                <i class="fas fa-chevron-left"></i> Sebelumnya
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $notifications->previousPageUrl() }}" style="border-radius: 8px; border: 1px solid #e5e7eb; color: #4A7AB5; padding: 8px 14px;">
                                                <i class="fas fa-chevron-left"></i> Sebelumnya
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                                        @if ($page == $notifications->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link" style="border-radius: 8px; background: linear-gradient(135deg, #4A7AB5, #5B8BC5); border: none; color: white; padding: 8px 14px; font-weight: 600;">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}" style="border-radius: 8px; border: 1px solid #e5e7eb; color: #374151; padding: 8px 14px;">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($notifications->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $notifications->nextPageUrl() }}" style="border-radius: 8px; border: 1px solid #e5e7eb; color: #4A7AB5; padding: 8px 14px;">
                                                Selanjutnya <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" style="border-radius: 8px; border: 1px solid #e5e7eb; color: #9ca3af; padding: 8px 14px;">
                                                Selanjutnya <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .notification-card {
        transition: all 0.3s ease;
    }
    
    .notification-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
        transform: translateY(-2px);
    }
</style>
@endsection