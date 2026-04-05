@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Selesaikan Kasus</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Tambahkan catatan penyelesaian untuk kasus ini</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Step Wizard -->
                    <div class="mb-4">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 30px;">
                            <!-- Step 1 -->
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: #d1fae5; color: #065f46; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 12px; color: #6b7280; font-weight: 500;">Step 1</div>
                                    <div style="font-size: 14px; color: #1a1a1a; font-weight: 600;">Edit Data</div>
                                </div>
                            </div>
                            
                            <!-- Connector -->
                            <div style="width: 60px; height: 2px; background: #10b981;"></div>
                            
                            <!-- Step 2 -->
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                    2
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 12px; color: #6b7280; font-weight: 500;">Step 2</div>
                                    <div style="font-size: 14px; color: #1a1a1a; font-weight: 600;">Selesaikan</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="mb-4" style="background: #fef2f2; padding: 16px; border-radius: 8px; border-left: 4px solid #ef4444;">
                        <h6 style="margin-bottom: 8px; color: #dc2626; font-weight: 600; font-size: 14px;">
                            <i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan
                        </h6>
                        <ul style="margin: 0; padding-left: 20px; color: #b91c1c; font-size: 13px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Info Pengaduan -->
                    <div class="mb-4" style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-info-circle" style="color: #4B7EC4;"></i> Informasi Pengaduan
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->nomor_laporan }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Laporan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->incident_date ? \Carbon\Carbon::parse($pengaduan->incident_date)->format('d F Y') : '-' }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelapor</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->reporter_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->victim_name }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->perpetrator_name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Sebelumnya -->
                    @if($tindakLanjutAwal->catatan)
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #6b7280;">
                        <h6 style="margin-bottom: 12px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-clipboard-list" style="color: #6b7280;"></i> Catatan Tindak Lanjut Sebelumnya
                        </h6>
                        <p style="margin: 0; font-size: 14px; color: #4b5563; line-height: 1.6; white-space: pre-wrap;">{{ $tindakLanjutAwal->catatan }}</p>
                    </div>
                    @endif

                    <!-- Pihak yang Dipanggil -->
                    <div class="mb-4" style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-users" style="color: #4B7EC4;"></i> Pihak yang Dipanggil
                        </h6>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban yang Dipanggil</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    {{ $tindakLanjutAwal->korban ? $tindakLanjutAwal->korban->name : '-' }}
                                    @if($tindakLanjutAwal->korban)
                                    <span style="color: #6b7280; font-weight: 400; font-size: 13px;">({{ $tindakLanjutAwal->korban->kelas ?? '-' }})</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku yang Dipanggil</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                    {{ $tindakLanjutAwal->pelaku ? $tindakLanjutAwal->pelaku->name : '-' }}
                                    @if($tindakLanjutAwal->pelaku)
                                    <span style="color: #6b7280; font-weight: 400; font-size: 13px;">({{ $tindakLanjutAwal->pelaku->kelas ?? '-' }})</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Selesaikan -->
                    <form method="POST" action="{{ route('tindak-lanjut-awal.selesaikan', $tindakLanjutAwal->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Catatan Penyelesaian -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">
                                <i class="fas fa-pen" style="color: #10b981; margin-right: 4px;"></i> Catatan Penyelesaian <span style="color: #ef4444;">*</span>
                            </label>
                            <textarea name="catatan_penyelesaian" class="form-control" rows="6" required placeholder="Jelaskan bagaimana kasus ini diselesaikan. Misalnya: Kedua belah pihak telah berdamai, pelaku meminta maaf, dan berjanji tidak mengulangi perbuatannya..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('catatan_penyelesaian') }}</textarea>
                            <small style="color: #6b7280; font-size: 12px; margin-top: 6px; display: block;">
                                <i class="fas fa-info-circle"></i> Minimal 10 karakter. Jelaskan secara rinci bagaimana kasus diselesaikan.
                            </small>
                        </div>

                        <!-- Informasi Penting -->
                        <div class="mb-4" style="background: #fef3c7; padding: 16px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                            <div style="display: flex; gap: 12px; align-items: start;">
                                <i class="fas fa-exclamation-triangle" style="color: #f59e0b; font-size: 20px; margin-top: 2px;"></i>
                                <div>
                                    <h6 style="margin: 0 0 6px 0; color: #92400e; font-weight: 600; font-size: 14px;">Perhatian</h6>
                                    <p style="margin: 0; color: #78350f; font-size: 13px; line-height: 1.5;">
                                        Setelah menyelesaikan kasus ini, status akan berubah menjadi <strong>"Selesai"</strong> dan data tidak dapat diubah lagi. Pastikan semua informasi sudah benar.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('tindak-lanjut-awal.edit', $tindakLanjutAwal->id) }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px; display: inline-block; text-align: center;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 12px;">
                                    <i class="fas fa-check-circle"></i> Selesaikan Kasus
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
