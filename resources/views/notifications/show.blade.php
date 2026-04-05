@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Back Button & Header Card -->
            <div class="card mb-4" style="border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);">
                <div style="padding: 20px 28px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <a href="{{ route('notifications.index') }}" 
                           style="background: #f3f4f6; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; color: #1a1a1a; transition: all 0.3s;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3 style="margin: 0; font-weight: 600; color: #1a1a1a; font-size: 20px;">Detail Notifikasi</h3>
                    </div>
                </div>
            </div>

            <!-- Main Notification Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 28px;">
                    <div class="d-flex align-items-start" style="gap: 20px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="far fa-bell" style="font-size: 36px; color: white;"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 style="margin: 0 0 12px 0; font-weight: 600; color: white; font-size: 24px; line-height: 1.4;">
                                {{ $notification->data['judul'] ?? 'Notifikasi' }}
                            </h4>
                            <div style="color: rgba(255,255,255,0.9); font-size: 14px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <i class="far fa-clock"></i>
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                                <span>•</span>
                                <span>{{ $notification->created_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 40px 28px;">
                    <!-- Details Section -->
                    <div class="mb-5">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-info-circle" style="color: #4A7AB5; margin-right: 8px;"></i>Informasi Detail
                        </h5>
                        
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <!-- Nama Siswa -->
                                <div style="margin-bottom: 24px;">
                                    <div class="d-flex align-items-start" style="gap: 16px;">
                                        <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-user" style="font-size: 20px; color: #4A7AB5;"></i>
                                        </div>
                                        <div>
                                            <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 6px;">Nama Siswa</label>
                                            <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0; text-transform: capitalize;">
                                                {{ $notification->data['nama_siswa'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kode Pengaduan -->
                                <div style="margin-bottom: 24px;">
                                    <div class="d-flex align-items-start" style="gap: 16px;">
                                        <div style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-file-alt" style="font-size: 20px; color: #4338ca;"></i>
                                        </div>
                                        <div>
                                            <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 6px;">Kode Pengaduan</label>
                                            <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0; font-family: monospace;">
                                                {{ $notification->data['nomor_laporan'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <!-- Korban -->
                                <div style="margin-bottom: 24px;">
                                    <div class="d-flex align-items-start" style="gap: 16px;">
                                        <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-user-injured" style="font-size: 20px; color: #991b1b;"></i>
                                        </div>
                                        <div>
                                            <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 6px;">Korban</label>
                                            <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0; text-transform: capitalize;">
                                                {{ $notification->data['nama_korban'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div style="margin-bottom: 24px;">
                                    <div class="d-flex align-items-start" style="gap: 16px;">
                                        <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-calendar" style="font-size: 20px; color: #92400e;"></i>
                                        </div>
                                        <div>
                                            <label style="color: #6b7280; font-size: 14px; font-weight: 600; display: block; margin-bottom: 6px;">Kategori</label>
                                            <p style="color: #1a1a1a; font-size: 16px; font-weight: 500; margin: 0;">Pengaduan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Box -->
                    <div class="mb-4" style="background: linear-gradient(135deg, #e7f3ff, #cfe9ff); border-left: 4px solid #4A7AB5; padding: 24px; border-radius: 12px;">
                        <div class="d-flex align-items-start" style="gap: 12px;">
                            <i class="fas fa-info-circle" style="font-size: 24px; color: #4A7AB5; margin-top: 2px;"></i>
                            <div>
                                <strong style="display: block; margin-bottom: 8px; color: #1a1a1a; font-size: 15px;">Pesan:</strong>
                                <p style="margin: 0; color: #1a1a1a; font-size: 15px; line-height: 1.7;">
                                    {{ $notification->data['pesan'] ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Section -->
                    <div class="mb-4">
                        <h5 style="font-weight: 700; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 2px solid #e5e7eb; font-size: 18px;">
                            <i class="fas fa-tasks" style="color: #4A7AB5; margin-right: 8px;"></i>Tindakan
                        </h5>

                        @if($pengaduan && $pengaduan->status === 'menunggu')
                            <!-- ✅ Tombol HANYA muncul jika status MENUNGGU -->
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <form action="{{ route('notifications.approve', $notification->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pengaduan ini?')">
                                        @csrf
                                        <button type="submit" class="btn w-100" 
                                                style="background: linear-gradient(135deg, #22c55e, #16a34a); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px; transition: all 0.3s;">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Setujui Pengaduan
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <button type="button" 
                                            class="btn w-100" 
                                            data-toggle="modal" 
                                            data-target="#rejectModal"
                                            style="background: linear-gradient(135deg, #ef4444, #b91c1c); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px; transition: all 0.3s;">
                                        <i class="fas fa-times-circle mr-2"></i>
                                        Tolak Pengaduan
                                    </button>
                                </div>
                            </div>

                        @elseif($pengaduan && $pengaduan->status === 'ditolak')
                            <!-- ❌ Pesan jika SUDAH DITOLAK -->
                            <div class="alert" style="background: linear-gradient(135deg, #fee2e2, #fecaca); border-left: 4px solid #ef4444; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <i class="fas fa-times-circle" style="font-size: 32px; color: #ef4444;"></i>
                                    <div>
                                        <strong style="color: #991b1b; font-size: 17px; display: block; margin-bottom: 6px;">Pengaduan Sudah Ditolak</strong>
                                        <p style="color: #7f1d1d; margin: 0; font-size: 15px;">
                                            Pengaduan ini telah ditolak sebelumnya. 
                                            @if($pengaduan->rejected_at)
                                                <br><small>Ditolak pada: {{ $pengaduan->rejected_at->format('d F Y, H:i') }} WIB</small>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                        @elseif($pengaduan && $pengaduan->status === 'disetujui')
                            <!-- ✅ Pesan jika SUDAH DISETUJUI -->
                            <div class="alert" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-left: 4px solid #10b981; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <i class="fas fa-check-circle" style="font-size: 32px; color: #059669;"></i>
                                    <div>
                                        <strong style="color: #065f46; font-size: 17px; display: block; margin-bottom: 6px;">Pengaduan Sudah Disetujui</strong>
                                        <p style="color: #047857; margin: 0; font-size: 15px;">Pengaduan ini telah disetujui dan sedang diproses oleh pihak sekolah.</p>
                                    </div>
                                </div>
                            </div>

                        @else
                            <!--  Pesan berdasarkan status pengaduan terkini -->
                            @if($pengaduan && $pengaduan->tindakLanjut && $pengaduan->tindakLanjut->status === 'selesai')
                                <div class="alert" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-left: 4px solid #10b981; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                                    <div class="d-flex align-items-center" style="gap: 12px;">
                                        <i class="fas fa-check-circle" style="font-size: 32px; color: #059669;"></i>
                                        <div>
                                            <strong style="color: #065f46; font-size: 17px; display: block; margin-bottom: 6px;">Pengaduan Sudah Selesai</strong>
                                            <p style="color: #047857; margin: 0; font-size: 15px;">Pengaduan ini telah selesai ditangani oleh pihak sekolah.</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert" style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-left: 4px solid #f59e0b; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                                    <div class="d-flex align-items-center" style="gap: 12px;">
                                        <i class="fas fa-info-circle" style="font-size: 32px; color: #d97706;"></i>
                                        <div>
                                            <strong style="color: #92400e; font-size: 17px; display: block; margin-bottom: 6px;">Status Pengaduan: {{ ucfirst($pengaduan->status ?? 'Tidak Diketahui') }}</strong>
                                            <p style="color: #78350f; margin: 0; font-size: 15px;">Pengaduan ini sedang dalam proses.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Tombol Lihat Detail & Tandai Dibaca (SELALU MUNCUL) -->
                        <div class="row">
                            <div class="col-md-6 mb-2">
                        @php
                            $user = Auth::user();
                            $pengaduanId = $notification->data['pengaduan_id'] ?? null;
                            $pengaduan = $pengaduanId ? \App\Models\Pengaduan::find($pengaduanId) : null;

                            $isAdmin = in_array($user->role, ['admin', 'guru_bk', 'wali_kelas']);
                            $isPembuat = $pengaduan && $pengaduan->user_id == $user->id;

                            $bolehLihatDetail = $pengaduan && ($isAdmin || $isPembuat);
                        @endphp

                        @if($bolehLihatDetail)
                            <a href="{{ $isAdmin
                                ? route('pengaduan.show', $pengaduanId)
                                : route('pengaduan.siswa.show', $pengaduanId) }}"
                                class="btn w-100"
                                style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px; text-decoration: none; display: block; text-align: center; transition: all 0.3s;">
                            <i class="fas fa-eye mr-2"></i>
                                Lihat Detail Pengaduan
                            </a>
                        @else
                            <button class="btn w-100" disabled
                                style="background: #e5e7eb; color: #9ca3af; border: none; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px; cursor: not-allowed;">
                            <i class="fas fa-lock mr-2"></i>
                                Detail Tidak Dapat Diakses
                            </button>
                            @endif  
                            </div>

                            <div class="col-md-6 mb-2">
                                @if(!$notification->read_at)
                                    <form action="{{ route('notifications.read', $notification->id) }}" 
                                          method="POST">
                                        @csrf
                                        <button type="submit" class="btn w-100" 
                                                style="border: 2px solid #d1d5db; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; padding: 14px; font-size: 16px; transition: all 0.3s;">
                                            <i class="far fa-check-circle mr-2"></i>
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @else
                                    <button class="btn w-100" disabled
                                            style="background: #e5e7eb; color: #9ca3af; border: none; border-radius: 10px; font-weight: 600; padding: 16px; font-size: 16px; cursor: not-allowed;">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Sudah Dibaca
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <form action="{{ route('notifications.reject', $notification->id) }}" method="POST">
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
                        <label for="reason" style="color: #1a1a1a; font-weight: 600; margin-bottom: 12px;">
                            Alasan Penolakan <span style="color: #ef4444;">*</span>
                        </label>
                        <textarea name="reason" 
                                  id="reason"
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

<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
</style>
@endsection