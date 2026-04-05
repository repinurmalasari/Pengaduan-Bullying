@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clipboard-list" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Detail Tindak Lanjut Awal</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Informasi lengkap tindak lanjut awal</p>
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

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjutAwal->pengaduan->nomor_laporan }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    {{ $tindakLanjutAwal->pengaduan->incident_date ? \Carbon\Carbon::parse($tindakLanjutAwal->pengaduan->incident_date)->format('d F Y') : '-' }}
                                </p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Tindak Lanjut Awal</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    {{ $tindakLanjutAwal->tanggal_tindak_lanjut_awal ? \Carbon\Carbon::parse($tindakLanjutAwal->tanggal_tindak_lanjut_awal)->format('d F Y') : '-' }}
                                </p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelapor</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjutAwal->pengaduan->reporter_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjutAwal->pengaduan->victim_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Status</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    @if($tindakLanjutAwal->status == 'diproses')
                                        <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Diproses</span>
                                    @elseif($tindakLanjutAwal->status == 'selesai')
                                        <span style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Selesai (Kasus Ringan)</span>
                                    @elseif($tindakLanjutAwal->status == 'direkomendasi_bk')
                                        <span style="background: #e0e7ff; color: #3730a3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Direkomendasi ke BK</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Rencana Tindak Lanjut -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                        <h6 style="margin-bottom: 12px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-edit" style="color: #4B7EC4;"></i> Catatan
                        </h6>
                        <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                            <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjutAwal->catatan ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Aksi Awal -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                        <h6 style="margin-bottom: 12px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-user-friends" style="color: #4B7EC4;"></i> Aksi Awal
                        </h6>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <div style="padding: 12px 16px; background: {{ $tindakLanjutAwal->korban ? '#eff6ff' : 'white' }}; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-{{ $tindakLanjutAwal->korban ? 'check-circle' : 'times-circle' }}" 
                                       style="color: {{ $tindakLanjutAwal->korban ? '#10b981' : '#9ca3af' }}; margin-right: 12px; font-size: 16px;"></i>
                                    <span style="font-size: 14px; font-weight: 500; color: #334155;">Panggil Korban</span>
                                </div>
                                @if($tindakLanjutAwal->korban)
                                <div style="margin-top: 8px; margin-left: 28px; padding: 8px 12px; background: white; border-radius: 6px; border: 1px solid #e5e7eb;">
                                    <span style="font-size: 13px; color: #4b5563;"><i class="fas fa-user" style="color: #10b981; margin-right: 8px;"></i>{{ $tindakLanjutAwal->korban->name }}</span>
                                </div>
                                @endif
                            </div>
                            <div style="padding: 12px 16px; background: {{ $tindakLanjutAwal->pelaku ? '#eff6ff' : 'white' }}; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-{{ $tindakLanjutAwal->pelaku ? 'check-circle' : 'times-circle' }}" 
                                       style="color: {{ $tindakLanjutAwal->pelaku ? '#3b82f6' : '#9ca3af' }}; margin-right: 12px; font-size: 16px;"></i>
                                    <span style="font-size: 14px; font-weight: 500; color: #334155;">Panggil Pelaku</span>
                                </div>
                                @if($tindakLanjutAwal->pelaku)
                                <div style="margin-top: 8px; margin-left: 28px; padding: 8px 12px; background: white; border-radius: 6px; border: 1px solid #e5e7eb;">
                                    <span style="font-size: 13px; color: #4b5563;"><i class="fas fa-user" style="color: #3b82f6; margin-right: 8px;"></i>{{ $tindakLanjutAwal->pelaku->name }}</span>
                                </div>
                                @endif
                            </div>
                            <div style="padding: 12px 16px; background: {{ $tindakLanjutAwal->rekomendasi_bk ? '#eff6ff' : 'white' }}; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-{{ $tindakLanjutAwal->rekomendasi_bk ? 'check-circle' : 'times-circle' }}" 
                                       style="color: {{ $tindakLanjutAwal->rekomendasi_bk ? '#6366f1' : '#9ca3af' }}; margin-right: 12px; font-size: 16px;"></i>
                                    <span style="font-size: 14px; font-weight: 500; color: #334155;">Rekomendasi ke BK</span>
                                </div>
                                @if($tindakLanjutAwal->rekomendasi_bk)
                                <div style="margin-top: 12px; margin-left: 28px;">
                                    <div style="padding: 8px 12px; background: white; border-radius: 6px; border: 1px solid #e5e7eb; margin-bottom: 8px;">
                                        <span style="font-size: 13px; color: #4b5563;">
                                            <i class="fas fa-user-injured" style="color: #10b981; margin-right: 8px;"></i>
                                            <strong>Korban:</strong> {{ $tindakLanjutAwal->pengaduan->victim_name }} ({{ $tindakLanjutAwal->pengaduan->victim_class }})
                                        </span>
                                    </div>
                                    <div style="padding: 8px 12px; background: white; border-radius: 6px; border: 1px solid #e5e7eb;">
                                        <span style="font-size: 13px; color: #4b5563;">
                                            <i class="fas fa-user-shield" style="color: #ef4444; margin-right: 8px;"></i>
                                            <strong>Pelaku:</strong> {{ $tindakLanjutAwal->pengaduan->perpetrator_name }} ({{ $tindakLanjutAwal->pengaduan->perpetrator_class }})
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4" style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="{{ route('tindak-lanjut-awal.index') }}" class="btn btn-lg" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px 24px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('tindak-lanjut-awal.edit', $tindakLanjutAwal->id) }}" class="btn btn-lg" style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); color: white; border: none; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px 24px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        @if($tindakLanjutAwal->status == 'diproses')
                        <a href="{{ route('tindak-lanjut-awal.selesai', $tindakLanjutAwal->id) }}" class="btn btn-lg" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px 24px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-check-circle"></i> Lanjut Selesai
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection