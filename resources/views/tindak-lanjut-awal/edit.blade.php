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
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Edit Tindak Lanjut Awal</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Ubah data tindak lanjut awal pengaduan</p>
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
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #4A7AB5, #5B8BC5); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                    1
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 12px; color: #6b7280; font-weight: 500;">Step 1</div>
                                    <div style="font-size: 14px; color: #1a1a1a; font-weight: 600;">Edit Data</div>
                                </div>
                            </div>
                            
                            <!-- Connector -->
                            <div style="width: 60px; height: 2px; background: #e5e7eb;"></div>
                            
                            <!-- Step 2 -->
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e5e7eb; color: #9ca3af; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                    2
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 12px; color: #9ca3af; font-weight: 500;">Step 2</div>
                                    <div style="font-size: 14px; color: #9ca3af; font-weight: 600;">Selesaikan</div>
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

                    <!-- Form -->
                    <form method="POST" action="{{ route('tindak-lanjut-awal.update', $tindakLanjutAwal->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                        
                        <!-- Info Pengaduan (OTOMATIS TERISI) -->
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

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Status</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                        @if(isset($tindakLanjutAwal) && $tindakLanjutAwal->status == 'diproses')
                                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Diproses</span>
                                        @elseif(isset($tindakLanjutAwal) && $tindakLanjutAwal->status == 'selesai')
                                            <span style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Selesai</span>
                                        @elseif(isset($tindakLanjutAwal) && $tindakLanjutAwal->status == 'direkomendasi_bk')
                                            <span style="background: #e0e7ff; color: #3730a3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Direkomendasi ke BK</span>
                                        @else
                                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Diproses</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Tindak Lanjut Awal -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">
                                <i class="fas fa-calendar" style="color: #4B7EC4; margin-right: 4px;"></i> Tanggal Tindak Lanjut Awal <span style="color: #ef4444;">*</span>
                            </label>
                            @if($tindakLanjutAwal->status == 'diproses')
                            <input type="date" name="tanggal_tindak_lanjut_awal" class="form-control" required value="{{ old('tanggal_tindak_lanjut_awal', $tindakLanjutAwal->tanggal_tindak_lanjut_awal ?? date('Y-m-d')) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                            @else
                            <input type="date" name="tanggal_tindak_lanjut_awal" class="form-control" readonly value="{{ $tindakLanjutAwal->tanggal_tindak_lanjut_awal ?? date('Y-m-d') }}" style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; background: #f9fafb; color: #6b7280;">
                            @endif
                        </div>

                        <!-- Catatan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">
                                <i class="fas fa-edit" style="color: #4B7EC4; margin-right: 4px;"></i> Tambahkan Catatan
                            </label>
                            @if($tindakLanjutAwal->status == 'diproses')
                            <textarea name="catatan" class="form-control" rows="5" placeholder="Jelaskan tindakan medis. Korban dan pelaku sepakat untuk tidak mengulang lagi..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('catatan', $tindakLanjutAwal->catatan ?? '') }}</textarea>
                            @else
                            <textarea name="catatan" class="form-control" rows="5" readonly style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; background: #f9fafb; color: #6b7280;">{{ $tindakLanjutAwal->catatan ?? 'Tidak ada catatan' }}</textarea>
                            @endif
                        </div>

                        <!-- Aksi Awal -->
                        @if($tindakLanjutAwal->status == 'diproses')
                        <div class="mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 12px;">
                                <i class="fas fa-user-friends" style="color: #4B7EC4; margin-right: 4px;"></i> Aksi Awal
                            </label>
                            <div style="display: flex; flex-direction: column; gap: 16px;">
                                <!-- Panggil Korban -->
                                <div>
                                    <label style="color:#1a1a1a; font-size:14px; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                                        <i class="fas fa-user-check" style="color:#10b981;"></i> Panggil Korban
                                    </label>
                                    <input type="text" readonly class="form-control" placeholder="Klik untuk memilih korban..." data-toggle="modal" data-target="#modalKorban" style="cursor:pointer; border-radius:8px; border:1.5px solid #e2e8f0; background:white;">
                                    <input type="hidden" name="panggil_korban_id" id="panggil_korban_id" value="{{ old('panggil_korban_id', $tindakLanjutAwal->panggil_korban_id ?? '') }}">
                                    <div id="selectedKorbanBox" class="mt-2"></div>
                                </div>
                                
                                <!-- Panggil Pelaku -->
                                <div>
                                    <label style="color:#1a1a1a; font-size:14px; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                                        <i class="fas fa-user-shield" style="color:#3b82f6;"></i> Panggil Pelaku
                                    </label>
                                    <input type="text" readonly class="form-control" placeholder="Klik untuk memilih pelaku..." data-toggle="modal" data-target="#modalPelaku" style="cursor:pointer; border-radius:8px; border:1.5px solid #e2e8f0; background:white;">
                                    <input type="hidden" name="panggil_pelaku_id" id="panggil_pelaku_id" value="{{ old('panggil_pelaku_id', $tindakLanjutAwal->panggil_pelaku_id ?? '') }}">
                                    <div id="selectedPelakuBox" class="mt-2"></div>
                                    <div id="errorPelakuKorban" class="text-danger mt-1" style="font-size: 13px; display: none;">
                                        <i class="fas fa-exclamation-circle"></i> Pelaku dan korban tidak boleh sama.
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Informasi Pihak Terlibat (Read Only) -->
                        <div class="mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 12px;">
                                <i class="fas fa-user-friends" style="color: #4B7EC4; margin-right: 4px;"></i> Informasi Pihak Terlibat
                            </label>
                            <div style="background: #f0f9ff; padding: 16px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban yang Dipanggil</p>
                                        <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                            {{ $tindakLanjutAwal->korban?->name ?? '-' }}
                                            @if($tindakLanjutAwal->korban)
                                            <span style="color: #6b7280; font-weight: 400; font-size: 13px;">({{ $tindakLanjutAwal->korban->kelas ?? '-' }})</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku yang Dipanggil</p>
                                        <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">
                                            {{ $tindakLanjutAwal->pelaku?->name ?? '-' }}
                                            @if($tindakLanjutAwal->pelaku)
                                            <span style="color: #6b7280; font-weight: 400; font-size: 13px;">({{ $tindakLanjutAwal->pelaku->kelas ?? '-' }})</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($tindakLanjutAwal->status == 'diproses')
                        <!-- Ubah Status -->
                        <div class="mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 12px;">
                                <i class="fas fa-exchange-alt" style="color: #4B7EC4; margin-right: 4px;"></i> Ubah Status
                            </label>
                            <div style="display: flex; gap: 12px;">
                                {{-- Jika status diproses, tampilkan opsi Tetap Diproses dan Rekomendasikan ke BK --}}
                                <label id="statusProsesBtn" class="status-btn-proses" style="flex: 1; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 2px solid #f59e0b; background: #f59e0b; color: white; cursor: pointer; text-align: center; transition: all 0.2s;">
                                    <input type="radio" name="status" value="diproses" checked style="display: none;">
                                    <i class="fas fa-spinner"></i> Tetap Diproses
                                </label>
                                <label id="statusBKBtn" class="status-btn-bk" style="flex: 1; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 2px solid #6366f1; background: white; color: #6366f1; cursor: pointer; text-align: center; transition: all 0.2s;">
                                    <input type="radio" name="status" value="direkomendasi_bk" style="display: none;">
                                    <i class="fas fa-arrow-right"></i> Rekomendasikan ke BK
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('tindak-lanjut-awal.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px; display: inline-block; text-align: center;">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('tindak-lanjut-awal.selesai', $tindakLanjutAwal->id) }}" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 12px; text-decoration: none; display: inline-block; text-align: center;">
                                    <i class="fas fa-check-circle"></i> Lanjut Selesai
                                </a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="submitBtn" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </div>
                        @elseif($tindakLanjutAwal->status == 'selesai')
                        <!-- Status Selesai (Read Only) -->
                        <div class="mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 12px;">
                                <i class="fas fa-info-circle" style="color: #10b981; margin-right: 4px;"></i> Status Kasus
                            </label>
                            <div style="padding: 16px 20px; border-radius: 8px; background: #d1fae5; border: 2px solid #10b981;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <i class="fas fa-check-circle" style="font-size: 24px; color: #10b981;"></i>
                                    <div>
                                        <div style="font-weight: 600; color: #065f46; font-size: 15px;">Kasus Telah Selesai</div>
                                        <div style="font-size: 13px; color: #047857;">Data ini sudah selesai dan tidak dapat diubah statusnya.</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="selesai">
                        </div>

                        <!-- Action Buttons untuk Selesai -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('tindak-lanjut-awal.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px; display: inline-block; text-align: center;">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="submitBtn" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                    <i class="fas fa-save"></i> Update Catatan
                                </button>
                            </div>
                        </div>
                        @else
                        <!-- Status Direkomendasi BK (Read Only) -->
                        <div class="mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 12px;">
                                <i class="fas fa-info-circle" style="color: #6366f1; margin-right: 4px;"></i> Status Kasus
                            </label>
                            <div style="padding: 16px 20px; border-radius: 8px; background: #e0e7ff; border: 2px solid #6366f1;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <i class="fas fa-arrow-right" style="font-size: 24px; color: #6366f1;"></i>
                                    <div>
                                        <div style="font-weight: 600; color: #3730a3; font-size: 15px;">Direkomendasi ke BK</div>
                                        <div style="font-size: 13px; color: #4f46e5;">Kasus telah diteruskan ke Guru BK untuk tindak lanjut lebih lanjut.</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="direkomendasi_bk">
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <div class="col-md-12">
                                <a href="{{ route('tindak-lanjut-awal.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px; display: inline-block; text-align: center;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Korban -->
<div class="modal fade" id="modalKorban" tabindex="-1" aria-labelledby="modalKorbanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
        <div class="modal-content" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header" style="background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white;">
                <h5 class="modal-title" id="modalKorbanLabel" style="font-weight:600;">Pilih Siswa (Korban)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;font-size:2rem;opacity:0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background:#f8fafc; padding:20px;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background:white; border-right:0; border-radius:8px 0 0 8px; border:1.5px solid #b6c6e3; border-right:0;">
                            <i class="fas fa-search" style="color:#6b7280;"></i>
                        </span>
                    </div>
                    <input type="text" id="searchKorban" class="form-control" placeholder="Cari nama, email, NIS, kelas..." style="border-radius:0 8px 8px 0;box-shadow:none;border:1.5px solid #b6c6e3; border-left:0;">
                </div>
                <div id="listKorban" style="max-height:400px; overflow-y:auto;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Pelaku -->
<div class="modal fade" id="modalPelaku" tabindex="-1" aria-labelledby="modalPelakuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
        <div class="modal-content" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header" style="background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white;">
                <h5 class="modal-title" id="modalPelakuLabel" style="font-weight:600;">Pilih Siswa (Pelaku)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;font-size:2rem;opacity:0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background:#f8fafc; padding:20px;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background:white; border-right:0; border-radius:8px 0 0 8px; border:1.5px solid #b6c6e3; border-right:0;">
                            <i class="fas fa-search" style="color:#6b7280;"></i>
                        </span>
                    </div>
                    <input type="text" id="searchPelaku" class="form-control" placeholder="Cari nama, email, NIS, kelas..." style="border-radius:0 8px 8px 0;box-shadow:none;border:1.5px solid #b6c6e3; border-left:0;">
                </div>
                <div id="listPelaku" style="max-height:400px; overflow-y:auto;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Pre-fill korban dan pelaku yang sudah dipilih
    @if(isset($tindakLanjutAwal->korban))
        var korbanName = "{{ $tindakLanjutAwal->korban->name }}";
        var korbanKelas = "{{ $tindakLanjutAwal->korban->kelas ?? '-' }}";
        $('#selectedKorbanBox').html(`<span class='badge' style='background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white; font-size:14px; padding:8px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:8px; font-weight:500;'>${korbanName} (${korbanKelas}) <button type='button' onclick='clearKorban()' style='background:none; border:none; color:white; font-size:16px; cursor:pointer; padding:0; margin-left:4px;'>&times;</button></span>`);
    @endif
    
    @if(isset($tindakLanjutAwal->pelaku))
        var pelakuName = "{{ $tindakLanjutAwal->pelaku->name }}";
        var pelakuKelas = "{{ $tindakLanjutAwal->pelaku->kelas ?? '-' }}";
        $('#selectedPelakuBox').html(`<span class='badge' style='background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white; font-size:14px; padding:8px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:8px; font-weight:500;'>${pelakuName} (${pelakuKelas}) <button type='button' onclick='clearPelaku()' style='background:none; border:none; color:white; font-size:16px; cursor:pointer; padding:0; margin-left:4px;'>&times;</button></span>`);
    @endif

    // Status button logic - hanya untuk status diproses
    @if(isset($tindakLanjutAwal) && $tindakLanjutAwal->status == 'diproses')
    function setStatusBtn(selected) {
        if (selected === 'diproses') {
            $('#statusProsesBtn').css({background:'#f59e0b',color:'white'});
            $('#statusBKBtn').css({background:'white',color:'#6366f1'});
            $('#statusProsesBtn input').prop('checked',true);
            $('#statusBKBtn input').prop('checked',false);
        } else if (selected === 'direkomendasi_bk') {
            $('#statusBKBtn').css({background:'#6366f1',color:'white'});
            $('#statusProsesBtn').css({background:'white',color:'#f59e0b'});
            $('#statusBKBtn input').prop('checked',true);
            $('#statusProsesBtn input').prop('checked',false);
        }
    }
    // Initial state - default tetap diproses
    setStatusBtn('diproses');
    $('#statusProsesBtn').on('click',function(){setStatusBtn('diproses');});
    $('#statusBKBtn').on('click',function(){setStatusBtn('direkomendasi_bk');});
    @endif

    // Validasi pelaku != korban
    function validatePelakuKorban() {
        var korbanId = $('#panggil_korban_id').val();
        var pelakuId = $('#panggil_pelaku_id').val();
        
        if (korbanId && pelakuId && korbanId === pelakuId) {
            $('#errorPelakuKorban').show();
            $('#submitBtn').prop('disabled', true);
            return false;
        } else {
            $('#errorPelakuKorban').hide();
            $('#submitBtn').prop('disabled', false);
            return true;
        }
    }

    // Helper: Generate avatar color based on name
    function getAvatarColor(name) {
        const colors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#3b82f6', '#06b6d4', '#14b8a6', '#f97316'];
        const index = name.charCodeAt(0) % colors.length;
        return colors[index];
    }

    // Helper: Get initials from name
    function getInitials(name) {
        return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
    }

    // Helper: Render siswa list
    function renderSiswaList(target, data, selectCallback) {
        let html = '';
        if (data.length === 0) {
            html += '<div class="text-center text-muted py-4" style="background:#f3f6fa; border-radius:8px;">Tidak ada data siswa.</div>';
        } else {
            data.forEach(siswa => {
                const initials = getInitials(siswa.name);
                const bgColor = getAvatarColor(siswa.name);
                const safeId = siswa.id;
                const safeName = siswa.name.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                const safeKelas = (siswa.kelas || '-').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                
                html += `<div class="list-group-item list-group-item-action" style="border:none; border-bottom:1px solid #e5e7eb; padding:14px 10px; cursor:pointer; transition:0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='white'" onclick="${selectCallback}('${safeId}', '${safeName}', '${safeKelas}')">`
                    + `<div style="display:flex; align-items:center; gap:12px;">`
                    + `<div style="width:44px; height:44px; border-radius:50%; background:${bgColor}; color:white; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:16px; flex-shrink:0;">${initials}</div>`
                    + `<div style="flex:1;">`
                    + `<div style="font-weight:600; font-size:15px; color:#1f2937;">${siswa.name}</div>`
                    + `<div style="font-size:13px; color:#6b7280;">NIS: ${siswa.nip || siswa.nis || '-'} • Kelas: ${siswa.kelas || '-'} • ${siswa.email || ''}</div>`
                    + `</div></div></div>`;
            });
        }
        $('#' + target).html(html);
    }

    // Fetch siswa for modal
    async function fetchSiswaList(q, cb) {
        try {
            const res = await fetch(`/api/siswa?search=${encodeURIComponent(q)}`);
            const data = await res.json();
            cb(data);
        } catch (error) {
            console.error('Error fetching siswa:', error);
            cb([]);
        }
    }

    // Modal Korban
    window.selectKorban = function(id, name, kelas) {
        $('#panggil_korban_id').val(id);
        $('#selectedKorbanBox').html(`<span class='badge' style='background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white; font-size:14px; padding:8px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:8px; font-weight:500;'>${name} (${kelas}) <button type='button' onclick='clearKorban()' style='background:none; border:none; color:white; font-size:16px; cursor:pointer; padding:0; margin-left:4px;'>&times;</button></span>`);
        $('#modalKorban').modal('hide');
        validatePelakuKorban();
    }

    window.clearKorban = function() {
        $('#panggil_korban_id').val('');
        $('#selectedKorbanBox').html('');
        validatePelakuKorban();
    }

    $('#modalKorban').on('show.bs.modal', function() {
        fetchSiswaList('', data => renderSiswaList('listKorban', data, 'selectKorban'));
        $('#searchKorban').val('');
    });

    $('#searchKorban').on('input', function() {
        fetchSiswaList(this.value, data => renderSiswaList('listKorban', data, 'selectKorban'));
    });

    // Modal Pelaku
    window.selectPelaku = function(id, name, kelas) {
        $('#panggil_pelaku_id').val(id);
        $('#selectedPelakuBox').html(`<span class='badge' style='background:linear-gradient(135deg,#4A7AB5,#5B8BC5); color:white; font-size:14px; padding:8px 14px; border-radius:20px; display:inline-flex; align-items:center; gap:8px; font-weight:500;'>${name} (${kelas}) <button type='button' onclick='clearPelaku()' style='background:none; border:none; color:white; font-size:16px; cursor:pointer; padding:0; margin-left:4px;'>&times;</button></span>`);
        $('#modalPelaku').modal('hide');
        validatePelakuKorban();
    }

    window.clearPelaku = function() {
        $('#panggil_pelaku_id').val('');
        $('#selectedPelakuBox').html('');
        validatePelakuKorban();
    }

    $('#modalPelaku').on('show.bs.modal', function() {
        fetchSiswaList('', data => renderSiswaList('listPelaku', data, 'selectPelaku'));
        $('#searchPelaku').val('');
    });

    $('#searchPelaku').on('input', function() {
        fetchSiswaList(this.value, data => renderSiswaList('listPelaku', data, 'selectPelaku'));
    });

    // Form submit validation
    $('form').on('submit', function(e) {
        if (!validatePelakuKorban()) {
            e.preventDefault();
            alert('Pelaku dan korban tidak boleh sama!');
            return false;
        }
    });
});
</script>
@endpush