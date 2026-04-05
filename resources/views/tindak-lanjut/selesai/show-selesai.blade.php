@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Progress Steps -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center" style="position: relative;">
                    <!-- Line Background -->
                    <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background: #e0e0e0; z-index: 1;"></div>
                    
                    <!-- Active Line Progress - Hijau penuh sampai step 3 -->
                    <div style="position: absolute; top: 20px; left: 0; width: 100%; height: 3px; background: #10b981; z-index: 1;"></div>
                    
                    <!-- Step 1 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
                    </div>
                    
                    <!-- Step 2 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
                    </div>
                    
                    <!-- Step 3 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section (Green Gradient) -->
                <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Detail Tindak Lanjut Selesai</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Informasi lengkap tindakan yang telah diselesaikan</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    
                    <!-- Informasi Pengaduan -->
                    <div class="mb-4" style="background: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 4px solid #6b7280;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-file-alt" style="color: #6b7280;"></i> Informasi Pengaduan
                        </h6>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->nomor_laporan ?? '-' }}</p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Tindakan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->nomor_tindakan }}</p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nama Pelapor</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->reporter_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nama Korban</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->victim_name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rencana Tindakan -->
                    <div class="mb-4" style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #4A7AB5;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a  ; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-clipboard-list" style="color: #4A7AB5;"></i> Rencana Tindakan
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Tindakan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ ucfirst($tindakLanjut->jenis_tindakan) }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Rencana</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_tindakan->format('d-m-Y') }}</p>
                            </div>
                        </div>

                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi Rencana</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Proses -->
                    <div class="mb-4" style="background: #fef3c7; padding: 20px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-tasks" style="color: #f59e0b;"></i> Data Proses
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Mulai Proses</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_mulai_proses ? $tindakLanjut->tanggal_mulai_proses->format('d-m-Y') : '-' }}</p>
                            </div>

                            @if($tindakLanjut->pihak_terlibat)
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pihak yang Terlibat</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pihak_terlibat }}</p>
                            </div>
                            @endif
                        </div>

                        <div style="margin-bottom: {{ $tindakLanjut->kendala ? '16px' : '0' }};">
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Catatan Proses</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->catatan_proses ?? '-' }}</p>
                            </div>
                        </div>

                        @if($tindakLanjut->kendala)
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Kendala yang Dihadapi</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->kendala }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Data Selesai -->
                    <div class="mb-4" style="background: #d1fae5; padding: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-check-double" style="color: #10b981;"></i> Data Penyelesaian
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Selesai</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_selesai ? $tindakLanjut->tanggal_selesai->format('d-m-Y') : '-' }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Status Hasil</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    @if($tindakLanjut->status_hasil == 'berhasil')
                                        <span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px;">✓ Berhasil</span>
                                    @elseif($tindakLanjut->status_hasil == 'cukup_berhasil')
                                        <span style="background: #f59e0b; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px;">✓ Cukup Berhasil</span>
                                    @elseif($tindakLanjut->status_hasil  == 'perlu_tindak_lanjut')
                                        <span style="background: #ef4444; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px;">⟳ Perlu Tindak Lanjut</span>
                                    @else
                                        <span style="background: #6b7280; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px;">-</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div style="margin-bottom: {{ $tindakLanjut->evaluasi ? '16px' : '0' }};">
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Hasil Tindakan</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->hasil ?? '-' }}</p>
                            </div>
                        </div>

                        @if($tindakLanjut->evaluasi)
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Evaluasi</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->evaluasi }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Timeline Summary -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-clock" style="color: #64748b;"></i> Timeline Penyelesaian
                        </h6>

                        <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 200px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #4A7AB5;"></div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Rencana</p>
                                </div>
                                <p style="margin: 0 0 0 16px; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_tindakan->format('d M Y') }}</p>
                            </div>

                            @if($tindakLanjut->tanggal_mulai_proses)
                            <div style="flex: 1; min-width: 200px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Mulai Proses</p>
                                </div>
                                <p style="margin: 0 0 0 16px; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_mulai_proses->format('d M Y') }}</p>
                            </div>
                            @endif

                            @if($tindakLanjut->tanggal_selesai)
                            <div style="flex: 1; min-width: 200px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Selesai</p>
                                </div>
                                <p style="margin: 0 0 0 16px; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-3">
                        <!-- Button Kembali -->
                        <div class="col-md-6">
                            <a href="{{ route('tindak-lanjut.show-proses', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="border: 1px solid #6b7280; color: #6b7280; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <!-- Button Edit -->
                        <div class="col-md-6">
                            @if(auth()->user()->role === 'admin')
                                {{-- Admin hanya mode lihat --}}
                                <button type="button" 
                                        class="btn btn-lg w-100" 
                                        disabled
                                        style="background: #e5e7eb; color: #9ca3af; border: 1px solid #d1d5db; border-radius: 10px; font-weight: 600; padding: 12px; cursor: not-allowed; opacity: 0.6;">
                                    <i class="fas fa-eye"></i> Mode Lihat
                                </button>
                            @else
                                <a href="{{ route('tindak-lanjut.edit-selesai', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                    <i class="fas fa-edit"></i> Edit Data Selesai
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