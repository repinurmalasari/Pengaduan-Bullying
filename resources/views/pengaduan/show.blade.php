@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="gap: 16px;">
                            <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-file-alt" style="font-size: 40px; color: white;"></i>
                            </div>
                            <div>
                                <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Detail Pengaduan</h2>
                                <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 15px;">{{ $pengaduan->nomor_laporan }}</p>
                            </div>
                        </div>
                        <div>
                            @php
                                $statusTampil = $pengaduan->getStatusTampil(); // or $pengaduan->statusTampil if using accessor
                                $statusColor = match(strtolower($statusTampil)) {
                                    'menunggu verifikasi' => 'background: rgba(255,193,7,.25); color:#92400e;',
                                    'menunggu tindak lanjut' => 'background: rgba(255,193,7,.25); color:#92400e;',
                                    'disetujui' => 'background: rgba(34,197,94,.25); color:#166534;',
                                    'ditolak' => 'background: rgba(239,68,68,.25); color:#991b1b;',
                                    'diproses' => 'background: rgba(147, 181, 235, 0.25); color:#1e40af;',
                                    'direncanakan' => 'background: #dbeafe; color:#1e40af;',
                                    'selesai' => 'background: rgba(34,197,94,.25); color:#166534;',
                                    'draf' => 'background: rgba(236,72,153,.25); color:#be185d;',
                                    default => 'background: rgba(255,255,255,.2); color:white;',
                                };
                            @endphp

                            <span style="{{ $statusColor }} padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 15px;">
                                {{ $statusTampil }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 40px;">

                <!-- SECTION ALASAN PENOLAKAN - BARU DITAMBAHKAN -->
                    @if($pengaduan->status === 'ditolak' && $pengaduan->alasan_penolakan)
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-times-circle" style="color: #ef4444; margin-right: 8px;"></i>Alasan Penolakan
                        </h5>
                        
                        <div style="background: linear-gradient(135deg, #fef2f2, #fee2e2); border-left: 4px solid #ef4444; padding: 28px; border-radius: 12px;">
                            <div class="d-flex align-items-start" style="gap: 16px;">
                                <!-- Icon -->
                                <div style="background: rgba(239, 68, 68, 0.15); width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 28px; color: #ef4444;"></i>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <!-- Alasan -->
                                    <div style="margin-bottom: 16px;">
                                        <div style="background: rgba(255, 255, 255, 0.6); border-radius: 10px; padding: 18px; margin-bottom: 12px;">
                                            <strong style="color: #991b1b; font-size: 15px; display: block; margin-bottom: 10px;">
                                                <i class="fas fa-info-circle" style="margin-right: 6px;"></i>Pengaduan ini ditolak dengan alasan:
                                            </strong>
                                            <p style="color: #1a1a1a; font-size: 16px; line-height: 1.8; margin: 0; white-space: pre-wrap; font-weight: 500;">{{ $pengaduan->alasan_penolakan }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Info Penolak dan Waktu -->
                                    <div style="margin-top: 18px; padding-top: 18px; border-top: 2px dashed rgba(239, 68, 68, 0.3);">
                                        <div class="d-flex flex-wrap align-items-center" style="gap: 24px; font-size: 14px;">
                                            @if($pengaduan->rejectedBy)
                                            <div class="d-flex align-items-center" style="gap: 10px; background: rgba(255, 255, 255, 0.5); padding: 8px 16px; border-radius: 8px;">
                                                <i class="fas fa-user-shield" style="color: #991b1b;"></i>
                                                <span style="color: #1a1a1a;">
                                                    Ditolak oleh: <strong style="color: #991b1b;">{{ $pengaduan->rejectedBy->name }}</strong>
                                                </span>
                                            </div>
                                            @endif
                                            
                                            @if($pengaduan->rejected_at)
                                            <div class="d-flex align-items-center" style="gap: 10px; background: rgba(255, 255, 255, 0.5); padding: 8px 16px; border-radius: 8px;">
                                                <i class="far fa-clock" style="color: #991b1b;"></i>
                                                <span style="color: #1a1a1a;">
                                                    <strong>{{ $pengaduan->rejected_at->format('d F Y') }}</strong> pukul
                                                    <strong>{{ $pengaduan->rejected_at->format('H:i') }}</strong> WIB
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pesan untuk Siswa -->
                        @if(auth()->user()->role === 'siswa' && $pengaduan->user_id === auth()->id())
                        <div style="background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 2px solid #fbbf24; border-radius: 12px; padding: 20px; margin-top: 16px;">
                            <div class="d-flex align-items-start" style="gap: 14px;">
                                <i class="fas fa-lightbulb" style="font-size: 24px; color: #d97706; margin-top: 2px;"></i>
                                <div style="color: #92400e; font-size: 14px; line-height: 1.7;">
                                    <strong style="display: block; margin-bottom: 8px; font-size: 15px; color: #78350f;"> Catatan Penting:</strong>
                                    <ul style="margin: 0; padding-left: 20px;">
                                        <li style="margin-bottom: 6px;">Anda dapat memperbaiki pengaduan ini berdasarkan alasan penolakan di atas</li>
                                        <li style="margin-bottom: 6px;">Pastikan data yang Anda berikan lengkap dan valid</li>
                                        <li style="margin-bottom: 6px;">Klik tombol <strong>"Edit"</strong> di bawah untuk mengubah pengaduan Anda</li>
                                        <li>Setelah diperbaiki, pengaduan akan diproses kembali oleh pihak sekolah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                    <!-- END SECTION ALASAN PENOLAKAN -->
                     
                    <!-- Data Pelapor Section -->
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-user-edit" style="color: #4A7AB5; margin-right: 8px;"></i>Data Pelapor
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Jenis Pelapor</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ ucfirst(str_replace('_', ' ', $pengaduan->report_type ?? '-')) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Nama Lengkap</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->reporter_name ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Kelas</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->reporter_class ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Korban Section -->
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-user-injured" style="color: #ef4444; margin-right: 8px;"></i>Data Korban
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Nama Korban</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->victim_name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Kelas Korban</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->victim_class ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pelaku Section -->
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-user-times" style="color: #f59e0b; margin-right: 8px;"></i>Data Pelaku
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Nama Pelaku</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->perpetrator_name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Kelas Pelaku</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->perpetrator_class ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Kejadian Section -->
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 8px;"></i>Detail Kejadian
                        </h5>
                        
                        <!-- Row 1: 3 kolom kiri -->
                        <div class="row">
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Tanggal Kejadian</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">
                                        {{ $pengaduan->incident_date ? \Carbon\Carbon::parse($pengaduan->incident_date)->format('d-m-Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Waktu Kejadian</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->incident_time ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Lokasi Kejadian</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->location ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: 3 kolom kanan -->
                        <div class="row">
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Jenis Bullying</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->jenis_bullying ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Tingkat Urgensi</label>
                                    @if($pengaduan->urgency)
                                        <span style="background-color: @if($pengaduan->urgency == 'tinggi') #fee2e2 @elseif($pengaduan->urgency == 'sedang') #fef3c7 @else #dcfce7 @endif; color: @if($pengaduan->urgency == 'tinggi') #991b1b @elseif($pengaduan->urgency == 'sedang') #92400e @else #166534 @endif; padding: 8px 16px; border-radius: 8px; font-size: 15px; font-weight: 600; display: inline-block;">
                                            {{ ucfirst($pengaduan->urgency) }}
                                        </span>
                                    @else
                                        <p style="color: #9ca3af; font-size: 16px; margin: 0;">-</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Saksi Mata</label>
                                    <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">{{ $pengaduan->witnesses ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Kejadian (Full Width) -->
                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-bottom: 24px;">
                                    <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 10px;">Deskripsi Kejadian</label>
                                    <div style="background: #f9fafb; border-left: 4px solid #4A7AB5; padding: 20px; border-radius: 8px;">
                                        <p style="color: #1a1a1a; font-size: 16px; line-height: 1.8; margin: 0; white-space: pre-wrap;">{{ $pengaduan->description ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lampiran Section -->
                    @if($pengaduan->attachment)
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-paperclip" style="color: #8e9291; margin-right: 8px;"></i>Lampiran
                        </h5>
                        <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border: 2px dashed #4A7AB5; border-radius: 12px; padding: 28px; text-align: center;">
                            <div style="margin-bottom: 16px;">
                                <i class="fas fa-file-download" style="font-size: 52px; color: #4A7AB5;"></i>
                            </div>
                            <p style="color: #1e40af; font-size: 16px; margin-bottom: 20px; font-weight: 500;">File lampiran tersedia untuk diunduh</p>
                            <a href="{{ $pengaduan->attachment_url }}" class="btn" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; padding: 14px 36px; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 12px; box-shadow: 0 4px 12px rgba(74, 122, 181, 0.3); transition: all 0.3s ease; font-size: 16px;" download>
                                <i class="fas fa-download"></i> 
                                <span>Unduh Lampiran</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Tombol Setujui/Tolak - HANYA untuk Admin/Guru BK/Wali Kelas -->
                    @if($pengaduan->status === 'menunggu' && in_array(auth()->user()->role, ['admin', 'guru_bk', 'wali_kelas']))
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('pengaduan.approve', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pengaduan ini?')">
                                @csrf
                                <button type="submit"
                                    class="btn btn-lg w-100"
                                    style="background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px;">
                                    <i class="fas fa-check-circle"></i> Setujui Pengaduan
                                </button>
                            </form>
                        </div>

                        <div class="col-md-6">
    <button type="button"
        data-toggle="modal"
        data-target="#modalTolak"
        class="btn btn-lg w-100"
        style="background: linear-gradient(135deg, #ef4444, #b91c1c); color: white; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px;">
        <i class="fas fa-times-circle"></i> Tolak Pengaduan
    </button>
</div>

                    </div>
                    @endif

                    <!-- Action Buttons - Kembali & Edit -->
                    <div class="row g-3 mt-4">
                        <!-- Tombol Kembali -->
                        <div class="col-md-6">
                            @if(auth()->user()->role == 'siswa')
                                <!-- Siswa kembali ke halaman mereka -->
                                <a href="{{ route('buat-pengaduan.index') }}" 
                                   class="btn btn-lg w-100" 
                                   style="border: 2px solid #d1d5db; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 16px; font-size: 16px; transition: all 0.3s;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            @else
                                <!-- Admin/Guru BK/Wali Kelas kembali ke data pengaduan -->
                                <a href="{{ route('pengaduan.index') }}" 
                                   class="btn btn-lg w-100" 
                                   style="border: 2px solid #d1d5db; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 16px; font-size: 16px; transition: all 0.3s;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            @endif
                        </div>

                        <!-- Tombol Edit - HANYA SISWA PEMILIK -->
                        <div class="col-md-6">
                            @if(auth()->user()->role == 'siswa' && $pengaduan->user_id == auth()->id())
                                <!-- Siswa pemilik bisa edit -->
                                <a href="{{ route('buat-pengaduan.edit', $pengaduan->id) }}" 
                                   class="btn btn-lg w-100" 
                                   style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 16px; font-size: 16px; transition: all 0.3s;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @elseif(auth()->user()->role == 'siswa' && $pengaduan->user_id != auth()->id())
                                <!-- Siswa lain tidak bisa edit -->
                                <button disabled 
                                        class="btn btn-lg w-100" 
                                        style="background: #e5e7eb; color: #9ca3af; border: none; border-radius: 10px; font-weight: 600; cursor: not-allowed; padding: 16px; font-size: 16px;">
                                    <i class="fas fa-lock"></i> Bukan Pengaduan Anda
                                </button>
                            @else
                                <!-- Admin/Guru BK/Wali Kelas hanya bisa lihat -->
                                <button disabled 
                                        class="btn btn-lg w-100" 
                                        style="background: #e5e7eb; color: #9ca3af; border: none; border-radius: 10px; font-weight: 600; cursor: not-allowed; padding: 16px; font-size: 16px;">
                                    <i class="fas fa-eye"></i> Mode Lihat
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    confirmButtonText: 'OK',
    confirmButtonColor: '#4A7AB5'
});
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Ditolak',
    text: '{{ session('error') }}',
    confirmButtonText: 'OK',
    confirmButtonColor: '#ef4444'

});
</script>
@endif

<!-- Modal Tolak Pengaduan -->
<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">

            <form action="{{ route('pengaduan.reject', $pengaduan->id) }}" method="POST">
                @csrf

                <div class="modal-header" style="background: linear-gradient(135deg, #ef4444, #b91c1c); border: none; padding: 24px;">
                    <h5 class="modal-title" style="color: white; font-weight: 600; font-size: 18px;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Tolak Pengaduan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 28px;">
                    <div class="form-group">
                        <label style="color: #1a1a1a; font-weight: 600; margin-bottom: 12px;">
                            Alasan Penolakan <span style="color: #ef4444;">*</span>
                        </label>

                        <textarea name="reason"
                                  class="form-control"
                                  rows="5"
                                  required
                                  placeholder="Contoh: Data tidak lengkap, bukti tidak valid, pengaduan tidak sesuai prosedur, dll"
                                  style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px; font-size: 15px;"></textarea>

                        <small class="form-text" style="color: #6b7280; margin-top: 8px;">
                            <i class="fas fa-info-circle mr-1"></i>
                            Berikan alasan yang jelas mengapa pengaduan ini ditolak
                        </small>
                    </div>
                </div>

                <div class="modal-footer" style="border: none; padding: 20px 28px;">
                    <button type="button" class="btn" data-dismiss="modal"
                            style="border: 2px solid #d1d5db; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; padding: 10px 24px;">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>

                    <button type="submit" class="btn"
                            style="background: linear-gradient(135deg, #ef4444, #b91c1c); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 10px 24px;">
                        <i class="fas fa-ban mr-2"></i>Tolak Pengaduan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection