@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
        <!-- Progress Steps -->
<div class="mb-4">
    @php
    $status = $tindakLanjut->status;
    
    // Garis hijau SELALU hanya sampai 50% karena ini halaman Detail Proses
    $progressWidth = '50%';
    @endphp

    <div class="d-flex justify-content-between align-items-center" style="position: relative;">
        <!-- Line Background -->
        <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background: #e0e0e0; z-index: 1;"></div>
        
        <!-- Active Line Progress - Garis Hijau TETAP sampai step 2 (Proses) -->
        <div style="position: absolute; top: 20px; left: 0; width: {{ $progressWidth }}; height: 3px; background: #10b981; z-index: 1;"></div>

        <!-- Step 1 - Direncanakan (Selalu Hijau dengan Centang) -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                <i class="fas fa-check"></i>
            </div>
            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
        </div>
        
        <!-- Step 2 - Proses (Selalu Hijau dengan Centang karena sudah masuk halaman Proses) -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                <i class="fas fa-check"></i>
            </div>
            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
        </div>
        
        <!-- Step 3 - Selesai (Dinamis berdasarkan STATUS DATA) -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            @if($status == 'selesai')
                <!-- Jika status sudah selesai - Hijau dengan centang -->
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                    <i class="fas fa-check"></i>
                </div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Selesai</p>
            @else
                <!-- Jika status belum selesai - Abu-abu dengan nomor 3 -->
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">3</div>
                <p style="margin-top: 8px; font-size: 12px; color: #999;">Selesai</p>
            @endif
        </div>
    </div>
</div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section (Orange Gradient) -->
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 32px 24px;">
                    <div class="d-flex align-items-center justify-content-between" style="gap: 16px;">
                        <div class="d-flex align-items-center" style="gap: 16px;">
                            <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clipboard-check" style="font-size: 40px; color: white;"></i>
                            </div>
                            <div>
                                <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Detail Proses</h2>
                                <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Informasi lengkap tindakan yang sedang berjalan</p>
                            </div>
                        </div>
                        <!-- Status Badge - DINAMIS -->
                        <div>
                            @php
                                $statusConfig = [
                                    'direncanakan' => [
                                        'bg' => 'rgba(74, 122, 181, 0.2)',
                                        'text' => 'Direncanakan',
                                        'icon' => 'fa-clock'
                                    ],
                                    'diproses' => [
                                        'bg' => 'rgba(251, 191, 36, 0.2)',
                                        'text' => 'Sedang Diproses',
                                        'icon' => 'fa-circle'
                                    ],
                                    'selesai' => [
                                        'bg' => 'rgba(16, 185, 129, 0.2)',
                                        'text' => 'Selesai',
                                        'icon' => 'fa-check-circle'
                                    ]
                                ];
                                
                                $currentStatus = $statusConfig[$tindakLanjut->status] ?? $statusConfig['diproses'];
                            @endphp
                            
                            <div style="background: {{ $currentStatus['bg'] }}; padding: 10px 20px; border-radius: 8px; backdrop-filter: blur(10px);">
                                <p style="margin: 0; color: white; font-weight: 600; font-size: 14px;">
                                    <i class="fas {{ $currentStatus['icon'] }}" style="font-size: 8px; margin-right: 6px;"></i>
                                    {{ $currentStatus['text'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    
                    <!-- Informasi Pengaduan -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-file-alt" style="color: #4A7AB5;"></i> Informasi Pengaduan
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Nomor Laporan</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->nomor_laporan }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Nama Korban</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->victim_name }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Kronologi</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ Str::limit($tindakLanjut->pengaduan->kronologi, 200) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rencana Tindakan -->
                    <div class="mb-4" style="background: #fff7ed; padding: 20px; border-radius: 12px; border-left: 4px solid #f59e0b;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-clipboard-list" style="color: #f59e0b;"></i> Rencana Tindakan
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #fed7aa;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Jenis Tindakan</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ ucfirst($tindakLanjut->jenis_tindakan) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #fed7aa;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Tanggal Rencana</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_tindakan->format('d-m-Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #fed7aa;">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">Nomor Tindakan</p>
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->nomor_tindakan }}</p>
                                </div>
                            </div>
                        </div>

                        <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #fed7aa;">
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi Rencana</p>
                            <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Detail Proses yang Sedang Berjalan -->
                    <div class="mb-4" style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 24px; border-radius: 12px; border: 2px solid #f59e0b;">
                        <h6 style="margin-bottom: 20px; color: #1a1a1a; font-weight: 600; font-size: 18px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-tasks" style="color: #f59e0b; font-size: 20px;"></i> Detail Proses Berjalan
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">
                                        <i class="fas fa-calendar-check" style="color: #f59e0b; margin-right: 6px;"></i>
                                        Tanggal Mulai Proses
                                    </p>
                                    <p style="margin: 0; font-size: 16px; color: #1a1a1a; font-weight: 600;">
                                        {{ $tindakLanjut->tanggal_mulai_proses ? $tindakLanjut->tanggal_mulai_proses->format('d-m-Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);">
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500; margin-bottom: 6px;">
                                        <i class="fas fa-hourglass-half" style="color: #f59e0b; margin-right: 6px;"></i>
                                        Durasi Proses
                                    </p>
                                    <p style="margin: 0; font-size: 16px; color: #1a1a1a; font-weight: 600;">
                                        @if($tindakLanjut->tanggal_mulai_proses)
                                            {{ $tindakLanjut->tanggal_mulai_proses->diffInDays(now()) }} Hari
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($tindakLanjut->pihak_terlibat)
                        <div class="mb-3" style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);">
                            <p style="margin: 0 0 10px 0; font-size: 12px; color: #666; font-weight: 500;">
                                <i class="fas fa-users" style="color: #f59e0b; margin-right: 6px;"></i>
                                Pihak yang Terlibat
                            </p>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach(explode(',', $tindakLanjut->pihak_terlibat) as $pihak)
                                    <span style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 500; border: 1px solid #fbbf24;">
                                        <i class="fas fa-user" style="font-size: 10px; margin-right: 4px;"></i>
                                        {{ trim($pihak) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div style="background: white; padding: 16px; border-radius: 10px; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);">
                            <p style="margin: 0 0 10px 0; font-size: 12px; color: #666; font-weight: 500;">
                                <i class="fas fa-comment-dots" style="color: #f59e0b; margin-right: 6px;"></i>
                                Catatan Proses
                            </p>
                            <div style="background: #fef3c7; padding: 14px; border-radius: 8px; border-left: 3px solid #f59e0b;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.7;">
                                    {{ $tindakLanjut->catatan_proses ?? 'Belum ada catatan proses' }}
                                </p>
                            </div>
                        </div>

                        @if($tindakLanjut->kendala)
                        <div class="mt-3" style="background: #fee2e2; padding: 16px; border-radius: 10px; border-left: 3px solid #ef4444;">
                            <p style="margin: 0 0 10px 0; font-size: 12px; color: #991b1b; font-weight: 600;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 6px;"></i>
                                Kendala yang Dihadapi
                            </p>
                            <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.7;">
                                {{ $tindakLanjut->kendala }}
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Timeline / History -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-history" style="color: #4A7AB5;"></i> Timeline Tindakan
                        </h6>

                        <div style="position: relative; padding-left: 30px;">
                            <!-- Timeline Line -->
                            <div style="position: absolute; left: 8px; top: 10px; bottom: 10px; width: 2px; background: #e2e8f0;"></div>

                            <!-- Item 1: Direncanakan -->
                            <div style="position: relative; margin-bottom: 20px;">
                                <div style="position: absolute; left: -30px; width: 18px; height: 18px; border-radius: 50%; background: #4A7AB5; border: 3px solid white; box-shadow: 0 0 0 2px #4A7AB5;"></div>
                                <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #4A7AB5;">
                                    <p style="margin: 0 0 4px 0; font-weight: 600; color: #4A7AB5; font-size: 14px;">Direncanakan</p>
                                    <p style="margin: 0; font-size: 13px; color: #666;">{{ $tindakLanjut->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Item 2: Proses Dimulai -->
                            <div style="position: relative; margin-bottom: 20px;">
                                <div style="position: absolute; left: -30px; width: 18px; height: 18px; border-radius: 50%; background: #f59e0b; border: 3px solid white; box-shadow: 0 0 0 2px #f59e0b;"></div>
                                <div style="background: white; padding: 14px; border-radius: 8px; border: 1px solid #fed7aa;">
                                    <p style="margin: 0 0 4px 0; font-weight: 600; color: #f59e0b; font-size: 14px;">Proses Dimulai</p>
                                    <p style="margin: 0; font-size: 13px; color: #666;">
                                        {{ $tindakLanjut->tanggal_mulai_proses ? $tindakLanjut->tanggal_mulai_proses->format('d M Y, H:i') : 'Sedang berjalan' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Item 3: Menunggu Penyelesaian -->
                            <div style="position: relative;">
@if($status == 'selesai')
    <div style="position:absolute;left:-30px;width:18px;height:18px;border-radius:50%;background:#10b981;border:3px solid white;box-shadow:0 0 0 2px #10b981;"></div>
    <div style="background:white;padding:14px;border-radius:8px;border:1px solid #d1fae5;">
        <p style="margin:0 0 4px;font-weight:600;color:#10b981;">Selesai</p>
        <p style="margin:0;font-size:13px;color:#666;">
            {{ now()->format('d M Y, H:i') }}
        </p>
    </div>
@else
    <div style="position:absolute;left:-30px;width:18px;height:18px;border-radius:50%;background:#e2e8f0;border:3px solid white;box-shadow:0 0 0 2px #e2e8f0;"></div>
    <div style="background:white;padding:14px;border-radius:8px;border:1px solid #e2e8f0;">
        <p style="margin:0 0 4px;font-weight:600;color:#94a3b8;">Menunggu Penyelesaian</p>
        <p style="margin:0;font-size:13px;color:#999;">Belum selesai</p>
    </div>
@endif
</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
<div class="row g-3">
    <div class="col-md-4">
        <a href="{{ route('tindak-lanjut.detail', $tindakLanjut->id) }}" 
           class="btn btn-lg w-100" 
           style="border: 1px solid #6b7280; color: #6b7280; background: white; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="col-md-4">
        @if($tindakLanjut->status == 'selesai' || auth()->user()->role === 'admin')
            {{-- Button disabled ketika status selesai atau user adalah admin --}}
            <button type="button" 
                    class="btn btn-lg w-100" 
                    disabled
                    style="background: #e5e7eb; color: #9ca3af; border: 1px solid #d1d5db; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center; cursor: not-allowed; opacity: 0.6;">
                <i class="fas fa-eye me-2"></i> {{ auth()->user()->role === 'admin' ? 'Mode Lihat' : 'Edit Proses' }}
            </button>
        @else
            <a href="{{ route('tindak-lanjut.edit-proses', $tindakLanjut->id) }}" 
               class="btn btn-lg w-100" 
               style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-edit me-2"></i> Edit Proses
            </a>
        @endif
    </div>

    <div class="col-md-4">
        @if($tindakLanjut->status == 'selesai')
            <a href="{{ route('tindak-lanjut.show-selesai', $tindakLanjut->id) }}" 
               class="btn btn-lg w-100" 
               style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-eye me-2"></i> Detail Selesai
            </a>
        @elseif(auth()->user()->role === 'admin')
            {{-- Admin tidak bisa menyelesaikan --}}
            <button type="button" 
                    class="btn btn-lg w-100" 
                    disabled
                    style="background: #e5e7eb; color: #9ca3af; border: 1px solid #d1d5db; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center; cursor: not-allowed; opacity: 0.6;">
                <i class="fas fa-eye me-2"></i> Mode Lihat
            </button>
        @else
            <a href="{{ route('tindak-lanjut.selesai', $tindakLanjut->id) }}" 
               class="btn btn-lg w-100" 
               style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-check-circle me-2"></i> Selesaikan
            </a>
        @endif
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection