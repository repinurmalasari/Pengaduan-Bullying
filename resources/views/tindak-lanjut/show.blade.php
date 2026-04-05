@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
        <!-- Progress Steps -->
<div class="mb-4">
    @php
    $status = $tindakLanjut->status;
    
    // Garis hijau SELALU hanya sampai 16.67% karena ini halaman Detail Direncanakan
    $progressWidth = '16.67%';
    @endphp

    <div class="d-flex justify-content-between align-items-center" style="position: relative;">
        <!-- Line Background -->
        <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background: #e0e0e0; z-index: 1;"></div>
        
        <!-- Active Line Progress - Garis Hijau TETAP sampai step 1 (Direncanakan) -->
        <div style="position: absolute; top: 20px; left: 0; width: {{ $progressWidth }}; height: 3px; background: #10b981; z-index: 1;"></div>
        
        <!-- Step 1 - Direncanakan (Selalu Hijau dengan Centang) -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                <i class="fas fa-check"></i>
            </div>
            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
        </div>
        
        <!-- Step 2 - Proses (Dinamis berdasarkan STATUS DATA) -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            @if($status == 'diproses' || $status == 'selesai')
                <!-- Jika status sudah diproses/selesai - Hijau dengan centang -->
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                    <i class="fas fa-check"></i>
                </div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
            @else
                <!-- Jika status masih direncanakan - Orange dengan nomor 2 -->
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">2</div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #f59e0b;">Proses</p>
            @endif
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
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tasks" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div style="flex-grow: 1;">
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Detail Direncanakan</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">{{ $tindakLanjut->nomor_tindakan }}</p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'direncanakan' => 'rgba(74, 122, 181, 0.2)',
                                    'diproses' => 'rgba(251, 191, 36, 0.2)',
                                    'selesai' => 'rgba(16, 185, 129, 0.2)'
                                ];
                                $statusBg = $statusColors[$tindakLanjut->status] ?? 'rgba(255,255,255,0.2)';
                            @endphp
                            <span style="background: {{ $statusBg }}; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 14px; white-space: nowrap;">
                                {{ ucfirst(str_replace('_', ' ', $tindakLanjut->status)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Info Pengaduan -->
                    <div class="mb-4" style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-info-circle" style="color: #4B7EC4;"></i> Informasi Pengaduan
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->nomor_laporan }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Kejadian</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->incident_date->format('d-m-Y') }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelapor</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->reporter_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->victim_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->perpetrator_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Bullying</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->bullying_type }}</p>
                            </div>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Lokasi</p>
                            <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->location }}</p>
                        </div>

                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->pengaduan->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Tindakan -->
                    <div class="mb-4" style="background: #fef3c7; padding: 20px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-clipboard-check" style="color: #f59e0b;"></i> Informasi Tindakan
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Tindakan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->jenis_tindakan_label }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Rencana</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_tindakan->format('d-m-Y') }}</p>
                            </div>

                            @if($tindakLanjut->tanggal_selesai)
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Selesai</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_selesai->format('d-m-Y') }}</p>
                            </div>
                            @endif

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Status</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    @if($tindakLanjut->status == 'direncanakan')
                                        <span style="color: #4A7AB5;">● Direncanakan</span>
                                    @elseif($tindakLanjut->status == 'diproses')
                                        <span style="color: #f59e0b;">● Diproses</span>
                                    @else
                                        <span style="color: #10b981;">● Selesai</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Rencana -->
                    <div class="mb-4">
                        <h6 style="font-weight: 600; color: #1a1a1a; margin-bottom: 12px; font-size: 16px; padding-bottom: 8px; border-bottom: 2px solid #f0f0f0;">
                            <i class="fas fa-file-alt" style="color: #4A7AB5;"></i> Deskripsi Rencana Tindakan
                        </h6>
                        <div style="background: #f9fafb; padding: 16px; border-radius: 8px; border: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6; white-space: pre-wrap;">{{ $tindakLanjut->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Hasil (if completed) -->
                    @if($tindakLanjut->hasil_tindakan)
                    <div class="mb-4">
                        <h6 style="font-weight: 600; color: #1a1a1a; margin-bottom: 12px; font-size: 16px; padding-bottom: 8px; border-bottom: 2px solid #f0f0f0;">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Hasil Tindakan
                        </h6>
                        <div style="background: #f0fdf4; padding: 16px; border-radius: 8px; border: 1px solid #86efac;">
                            <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6; white-space: pre-wrap;">{{ $tindakLanjut->hasil_tindakan }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
<div class="row g-3">
    <div class="col-md-4">
        <a href="{{ route('tindak-lanjut.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="col-md-4">
        @if($tindakLanjut->status == 'selesai' || auth()->user()->hasRole('admin'))
            {{-- Button disabled ketika status selesai atau user adalah admin --}}
            <button type="button" 
                    class="btn btn-lg w-100" 
                    disabled
                    style="background: #e5e7eb; color: #9ca3af; border: 1px solid #d1d5db; border-radius: 10px; font-weight: 500; padding: 12px; cursor: not-allowed; opacity: 0.6;">
                <i class="fas fa-eye"></i> {{ auth()->user()->hasRole('admin') ? 'Mode Lihat' : 'Edit' }}
            </button>
        @else
            {{-- Button aktif ketika status belum selesai dan bukan admin --}}
            <a href="{{ route('tindak-lanjut.edit', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; text-decoration: none; padding: 12px;">
                <i class="fas fa-edit"></i> Edit
            </a>
        @endif
    </div>
    <div class="col-md-4">
        @if($tindakLanjut->tanggal_mulai_proses)
            {{-- Jika sudah ada data proses, tombol aktif dengan warna --}}
            <a href="{{ route('tindak-lanjut.show-proses', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; text-decoration: none; padding: 12px;">
                <i class="fas fa-eye"></i> Detail Proses
            </a>
        @else
            {{-- Jika belum ada data proses, tombol disabled abu-abu --}}
            <button type="button" class="btn btn-lg w-100" disabled style="background: #e5e7eb; color: #9ca3af; border: none; border-radius: 10px; font-weight: 500; padding: 12px; cursor: not-allowed;">
                <i class="fas fa-eye-slash"></i> Detail Proses
            </button>
        @endif
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection