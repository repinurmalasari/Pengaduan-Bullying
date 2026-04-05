@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card mb-4" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-book" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Dokumentasi Sistem</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Dokumentasi teknis Sistem Pengaduan Bullying - SMK Negeri 1 Padaherang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-body p-0">
                    <ul class="nav nav-pills nav-fill" id="dokumentasiTab" role="tablist" style="padding: 12px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="alur-tab" data-toggle="pill" data-target="#alur" type="button" role="tab" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-route mr-2"></i>Alur Sistem
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="migrations-tab" data-toggle="pill" data-target="#migrations" type="button" role="tab" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-database mr-2"></i>Migrations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="models-tab" data-toggle="pill" data-target="#models" type="button" role="tab" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-cubes mr-2"></i>Models
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="controllers-tab" data-toggle="pill" data-target="#controllers" type="button" role="tab" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-cogs mr-2"></i>Controllers
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content" id="dokumentasiTabContent">

                <!-- ALUR SISTEM TAB -->
                <div class="tab-pane fade show active" id="alur" role="tabpanel">
                    
                    <!-- Overview Sistem -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: linear-gradient(135deg, #667eea, #764ba2); border-bottom: none;">
                            <h5 class="mb-0" style="color: white; font-weight: 600;">
                                <i class="fas fa-info-circle mr-2"></i>Overview Sistem Pengaduan Bullying
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Sistem Pengaduan Bullying adalah aplikasi yang dirancang untuk membantu SMK Negeri 1 Padaherang dalam menangani kasus bullying secara terstruktur dan transparan. Sistem ini melibatkan beberapa role dengan tanggung jawab berbeda:</p>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div style="background: #eff6ff; padding: 16px; border-radius: 10px; border-left: 4px solid #3b82f6;">
                                        <h6 style="color: #1e40af; font-weight: 600;"><i class="fas fa-user-graduate mr-2"></i>Siswa</h6>
                                        <p class="mb-0 small">Membuat dan memantau pengaduan bullying</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div style="background: #fef3c7; padding: 16px; border-radius: 10px; border-left: 4px solid #f59e0b;">
                                        <h6 style="color: #92400e; font-weight: 600;"><i class="fas fa-user-tie mr-2"></i>Wali Kelas</h6>
                                        <p class="mb-0 small">Tindak lanjut awal untuk siswa kelasnya</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div style="background: #dcfce7; padding: 16px; border-radius: 10px; border-left: 4px solid #22c55e;">
                                        <h6 style="color: #166534; font-weight: 600;"><i class="fas fa-user-md mr-2"></i>Guru BK</h6>
                                        <p class="mb-0 small">Penanganan kasus yang direkomendasi</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div style="background: #fee2e2; padding: 16px; border-radius: 10px; border-left: 4px solid #ef4444;">
                                        <h6 style="color: #991b1b; font-weight: 600;"><i class="fas fa-user-shield mr-2"></i>Admin</h6>
                                        <p class="mb-0 small">Verifikasi pengaduan & manajemen sistem</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div style="background: #f3e8ff; padding: 16px; border-radius: 10px; border-left: 4px solid #a855f7;">
                                        <h6 style="color: #6b21a8; font-weight: 600;"><i class="fas fa-user-cog mr-2"></i>Kepala Sekolah</h6>
                                        <p class="mb-0 small">Monitoring & laporan keseluruhan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alur Utama -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-sitemap mr-2"></i>Alur Utama Penanganan Pengaduan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div style="background: #f8fafc; padding: 24px; border-radius: 12px;">
                                <div class="row align-items-center text-center">
                                    <div class="col-md-2">
                                        <div style="background: #3b82f6; color: white; padding: 20px 10px; border-radius: 10px;">
                                            <i class="fas fa-edit fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">1. Siswa Buat Pengaduan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <i class="fas fa-arrow-right fa-2x text-muted"></i>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="background: #ef4444; color: white; padding: 20px 10px; border-radius: 10px;">
                                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">2. Admin Verifikasi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <i class="fas fa-arrow-right fa-2x text-muted"></i>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="background: #f59e0b; color: white; padding: 20px 10px; border-radius: 10px;">
                                            <i class="fas fa-user-tie fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">3. Wali Kelas Tindak Lanjut Awal</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <i class="fas fa-arrow-right fa-2x text-muted"></i>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="background: #22c55e; color: white; padding: 20px 10px; border-radius: 10px;">
                                            <i class="fas fa-user-md fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">4. Guru BK (Jika Direkomendasi)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role: SISWA -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-left: 5px solid #3b82f6;">
                        <div class="card-header" style="background: #eff6ff; border-bottom: 1px solid #bfdbfe;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-user-graduate mr-2"></i>Alur Role: SISWA
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-list-ol mr-2"></i>Langkah-langkah:</h6>
                                    <ol class="pl-3">
                                        <li class="mb-2"><strong>Login</strong> ke sistem dengan akun siswa</li>
                                        <li class="mb-2"><strong>Buat Pengaduan Baru</strong>
                                            <ul class="mt-1">
                                                <li>Pilih tipe pelapor (korban/teman korban/dll)</li>
                                                <li>Isi data korban dan pelaku</li>
                                                <li>Isi detail kejadian (tanggal, lokasi, deskripsi)</li>
                                                <li>Pilih jenis bullying dan tingkat urgensi</li>
                                                <li>Upload bukti (opsional)</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Simpan sebagai Draf</strong> atau <strong>Kirim Langsung</strong></li>
                                        <li class="mb-2"><strong>Pantau Status</strong> pengaduan di halaman Riwayat</li>
                                        <li class="mb-2"><strong>Terima Notifikasi</strong> saat ada update status</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-desktop mr-2"></i>Menu yang Tersedia:</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-home text-primary mr-3"></i>
                                            <div><strong>Dashboard</strong> - Statistik pengaduan pribadi</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-plus-circle text-success mr-3"></i>
                                            <div><strong>Buat Pengaduan</strong> - Form pengaduan baru</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-file-alt text-warning mr-3"></i>
                                            <div><strong>Draf Pengaduan</strong> - Pengaduan yang belum dikirim</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-history text-info mr-3"></i>
                                            <div><strong>Riwayat Pengaduan</strong> - Semua pengaduan yang sudah dikirim</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-bell text-danger mr-3"></i>
                                            <div><strong>Notifikasi</strong> - Update status pengaduan</div>
                                        </li>
                                    </ul>
                                    
                                    <h6 class="font-weight-bold text-info mt-4 mb-3"><i class="fas fa-tags mr-2"></i>Status Pengaduan Siswa:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge badge-secondary p-2 mb-1">Draf</span>
                                        <span class="badge badge-warning p-2 mb-1">Menunggu Verifikasi</span>
                                        <span class="badge badge-success p-2 mb-1">Disetujui</span>
                                        <span class="badge badge-danger p-2 mb-1">Ditolak</span>
                                        <span class="badge badge-info p-2 mb-1">Diproses</span>
                                        <span class="badge badge-primary p-2 mb-1">Selesai</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role: WALI KELAS -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-left: 5px solid #f59e0b;">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-user-tie mr-2"></i>Alur Role: WALI KELAS
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-list-ol mr-2"></i>Langkah-langkah:</h6>
                                    <ol class="pl-3">
                                        <li class="mb-2"><strong>Login</strong> ke sistem dengan akun wali kelas</li>
                                        <li class="mb-2"><strong>Lihat Data Pengaduan</strong> yang melibatkan siswa kelasnya (korban/pelaku)</li>
                                        <li class="mb-2"><strong>Buat Tindak Lanjut Awal</strong>:
                                            <ul class="mt-1">
                                                <li>Pilih siswa korban yang akan dipanggil</li>
                                                <li>Pilih siswa pelaku yang akan dipanggil</li>
                                                <li>Tulis catatan/rencana tindakan</li>
                                                <li>Status awal: <strong>Diproses</strong></li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Notifikasi Otomatis</strong> dikirim ke korban dan pelaku</li>
                                        <li class="mb-2"><strong>Selesaikan Kasus</strong> (kasus ringan) atau <strong>Rekomendasikan ke BK</strong> (kasus berat)</li>
                                    </ol>
                                    
                                    <div class="alert alert-warning mt-3">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <strong>Penting:</strong> Wali kelas hanya bisa melihat pengaduan dimana korban ATAU pelaku berasal dari kelasnya.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-desktop mr-2"></i>Menu yang Tersedia:</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-home text-primary mr-3"></i>
                                            <div><strong>Dashboard</strong> - Statistik pengaduan kelas</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-folder-open text-warning mr-3"></i>
                                            <div><strong>Data Pengaduan</strong> - Pengaduan siswa kelasnya</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-clipboard-check text-success mr-3"></i>
                                            <div><strong>Data Tindak Lanjut Awal</strong> - Kelola tindak lanjut awal</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-tasks text-info mr-3"></i>
                                            <div><strong>Data Tindak Lanjut</strong> - Lihat tindak lanjut BK (read-only)</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-users text-secondary mr-3"></i>
                                            <div><strong>Data Siswa</strong> - Data siswa kelasnya</div>
                                        </li>
                                    </ul>
                                    
                                    <h6 class="font-weight-bold text-info mt-4 mb-3"><i class="fas fa-tags mr-2"></i>Status Tindak Lanjut Awal:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge badge-warning p-2 mb-1">Diproses</span>
                                        <span class="badge badge-success p-2 mb-1">Selesai (Kasus Ringan)</span>
                                        <span class="badge badge-primary p-2 mb-1">Direkomendasi ke BK</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Flow Diagram Wali Kelas -->
                            <div class="mt-4 p-3" style="background: #fffbeb; border-radius: 10px;">
                                <h6 class="font-weight-bold mb-3"><i class="fas fa-project-diagram mr-2"></i>Diagram Alur Wali Kelas:</h6>
                                <div class="text-center">
                                    <div class="d-inline-flex align-items-center flex-wrap justify-content-center" style="gap: 10px;">
                                        <span class="badge badge-warning p-2">Pengaduan Masuk</span>
                                        <i class="fas fa-arrow-right"></i>
                                        <span class="badge badge-info p-2">Proses (Panggil Korban & Pelaku)</span>
                                        <i class="fas fa-arrow-right"></i>
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="badge badge-success p-2 mb-1">Selesai (Ringan)</span>
                                            <span class="text-muted">atau</span>
                                            <span class="badge badge-primary p-2 mt-1">Rekomendasi ke BK (Berat)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role: GURU BK -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-left: 5px solid #22c55e;">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-user-md mr-2"></i>Alur Role: GURU BK
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-list-ol mr-2"></i>Langkah-langkah:</h6>
                                    <ol class="pl-3">
                                        <li class="mb-2"><strong>Login</strong> ke sistem dengan akun guru BK</li>
                                        <li class="mb-2"><strong>Lihat Data Pengaduan</strong> yang direkomendasi oleh wali kelas</li>
                                        <li class="mb-2"><strong>Buat Tindak Lanjut</strong> (Step 1: Rencana):
                                            <ul class="mt-1">
                                                <li>Pilih jenis tindakan (pembinaan/konseling/skorsing/dll)</li>
                                                <li>Tulis deskripsi rencana</li>
                                                <li>Tentukan tanggal pelaksanaan</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Proses Tindakan</strong> (Step 2: Proses):
                                            <ul class="mt-1">
                                                <li>Catat pihak yang terlibat</li>
                                                <li>Dokumentasi kendala (jika ada)</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Selesaikan Kasus</strong> (Step 3: Selesai):
                                            <ul class="mt-1">
                                                <li>Tulis hasil penanganan</li>
                                                <li>Buat evaluasi dan rekomendasi</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Notifikasi</strong> dikirim ke pelapor</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-desktop mr-2"></i>Menu yang Tersedia:</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-home text-primary mr-3"></i>
                                            <div><strong>Dashboard</strong> - Statistik penanganan</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-folder-open text-warning mr-3"></i>
                                            <div><strong>Data Pengaduan</strong> - Pengaduan yang direkomendasi ke BK</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-tasks text-success mr-3"></i>
                                            <div><strong>Data Tindak Lanjut</strong> - Kelola tindak lanjut</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-users text-secondary mr-3"></i>
                                            <div><strong>Data Siswa</strong> - Lihat data siswa</div>
                                        </li>
                                    </ul>
                                    
                                    <h6 class="font-weight-bold text-info mt-4 mb-3"><i class="fas fa-tags mr-2"></i>Status Tindak Lanjut BK:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge badge-secondary p-2 mb-1">Direncanakan</span>
                                        <span class="badge badge-warning p-2 mb-1">Diproses</span>
                                        <span class="badge badge-success p-2 mb-1">Selesai</span>
                                    </div>
                                    
                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Catatan:</strong> Guru BK hanya melihat pengaduan yang sudah direkomendasi oleh wali kelas (status: direkomendasi_bk).
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Flow Diagram Guru BK -->
                            <div class="mt-4 p-3" style="background: #f0fdf4; border-radius: 10px;">
                                <h6 class="font-weight-bold mb-3"><i class="fas fa-project-diagram mr-2"></i>Diagram Alur Tindak Lanjut BK (3 Steps):</h6>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div style="background: white; padding: 15px; border-radius: 10px; border: 2px solid #86efac;">
                                            <div style="background: #3b82f6; color: white; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold;">1</div>
                                            <h6 class="mt-2 mb-1 font-weight-bold">RENCANA</h6>
                                            <small class="text-muted">Jenis tindakan, deskripsi, tanggal rencana</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div style="background: white; padding: 15px; border-radius: 10px; border: 2px solid #86efac;">
                                            <div style="background: #f59e0b; color: white; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold;">2</div>
                                            <h6 class="mt-2 mb-1 font-weight-bold">PROSES</h6>
                                            <small class="text-muted">Catatan proses, pihak terlibat, kendala</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div style="background: white; padding: 15px; border-radius: 10px; border: 2px solid #86efac;">
                                            <div style="background: #22c55e; color: white; width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold;">3</div>
                                            <h6 class="mt-2 mb-1 font-weight-bold">SELESAI</h6>
                                            <small class="text-muted">Hasil, evaluasi, rekomendasi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role: ADMIN -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-left: 5px solid #ef4444;">
                        <div class="card-header" style="background: #fee2e2; border-bottom: 1px solid #fca5a5;">
                            <h5 class="mb-0" style="color: #991b1b; font-weight: 600;">
                                <i class="fas fa-user-shield mr-2"></i>Alur Role: ADMIN
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-list-ol mr-2"></i>Tugas Utama:</h6>
                                    <ol class="pl-3">
                                        <li class="mb-2"><strong>Verifikasi Pengaduan Masuk</strong>
                                            <ul class="mt-1">
                                                <li><span class="badge badge-success">Setujui</span> - Pengaduan valid, lanjut ke wali kelas</li>
                                                <li><span class="badge badge-danger">Tolak</span> - Pengaduan tidak valid, isi alasan penolakan</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Manajemen Data Master</strong>
                                            <ul class="mt-1">
                                                <li>Kelola data Siswa</li>
                                                <li>Kelola data Guru</li>
                                                <li>Kelola data Wali Kelas</li>
                                                <li>Kelola data User</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Monitoring Keseluruhan</strong> - Lihat semua pengaduan & tindak lanjut</li>
                                        <li class="mb-2"><strong>Generate Laporan</strong> - Buat laporan PDF</li>
                                        <li class="mb-2"><strong>Akses Dokumentasi</strong> - Halaman ini</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-desktop mr-2"></i>Menu yang Tersedia:</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-home text-primary mr-3"></i>
                                            <div><strong>Dashboard</strong> - Statistik keseluruhan</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-folder-open text-warning mr-3"></i>
                                            <div><strong>Data Pengaduan</strong> - Semua pengaduan (verifikasi)</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-tasks text-success mr-3"></i>
                                            <div><strong>Data Tindak Lanjut</strong> - Semua tindak lanjut</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-user-graduate text-info mr-3"></i>
                                            <div><strong>Data Siswa</strong> - CRUD siswa</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher text-secondary mr-3"></i>
                                            <div><strong>Data Guru</strong> - CRUD guru</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-user-tie text-dark mr-3"></i>
                                            <div><strong>Data Wali Kelas</strong> - CRUD wali kelas</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-users text-muted mr-3"></i>
                                            <div><strong>Manajemen User</strong> - CRUD user</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-chart-bar text-danger mr-3"></i>
                                            <div><strong>Laporan</strong> - Generate laporan PDF</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-book text-primary mr-3"></i>
                                            <div><strong>Dokumentasi</strong> - Dokumentasi sistem</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role: KEPALA SEKOLAH -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border-left: 5px solid #a855f7;">
                        <div class="card-header" style="background: #f3e8ff; border-bottom: 1px solid #d8b4fe;">
                            <h5 class="mb-0" style="color: #6b21a8; font-weight: 600;">
                                <i class="fas fa-user-cog mr-2"></i>Alur Role: KEPALA SEKOLAH
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-list-ol mr-2"></i>Tugas Utama:</h6>
                                    <ol class="pl-3">
                                        <li class="mb-2"><strong>Monitoring Dashboard</strong> - Pantau statistik keseluruhan kasus bullying</li>
                                        <li class="mb-2"><strong>Review Laporan</strong> - Lihat dan download laporan:
                                            <ul class="mt-1">
                                                <li>Laporan Tahunan</li>
                                                <li>Laporan Bulanan</li>
                                                <li>Laporan Pengaduan</li>
                                                <li>Laporan Tindak Lanjut</li>
                                                <li>Laporan Data Siswa/Guru/Wali Kelas</li>
                                            </ul>
                                        </li>
                                        <li class="mb-2"><strong>Oversight</strong> - Memastikan penanganan kasus berjalan baik</li>
                                    </ol>
                                    
                                    <div class="alert alert-purple mt-3" style="background: #f3e8ff; border: 1px solid #d8b4fe; color: #6b21a8;">
                                        <i class="fas fa-crown mr-2"></i>
                                        <strong>Catatan:</strong> Kepala sekolah memiliki akses read-only untuk monitoring. Tidak dapat melakukan perubahan data.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-desktop mr-2"></i>Menu yang Tersedia:</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-home text-primary mr-3"></i>
                                            <div><strong>Dashboard</strong> - Statistik keseluruhan (read-only)</div>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-chart-bar text-danger mr-3"></i>
                                            <div><strong>Laporan</strong> - Akses semua laporan PDF</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifikasi System -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-bell mr-2"></i>Sistem Notifikasi
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>Sistem mengirim notifikasi otomatis pada event-event berikut:</p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #fef3c7;">
                                        <tr>
                                            <th>Event</th>
                                            <th>Penerima</th>
                                            <th>Pesan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pengaduan baru dibuat</td>
                                            <td><span class="badge badge-danger">Admin</span></td>
                                            <td>Ada pengaduan baru yang perlu diverifikasi</td>
                                        </tr>
                                        <tr>
                                            <td>Pengaduan disetujui</td>
                                            <td><span class="badge badge-primary">Siswa (Pelapor)</span></td>
                                            <td>Pengaduan Anda telah disetujui dan sedang diproses</td>
                                        </tr>
                                        <tr>
                                            <td>Pengaduan ditolak</td>
                                            <td><span class="badge badge-primary">Siswa (Pelapor)</span></td>
                                            <td>Pengaduan Anda ditolak dengan alasan: ...</td>
                                        </tr>
                                        <tr>
                                            <td>Wali kelas proses tindak lanjut awal</td>
                                            <td><span class="badge badge-primary">Siswa (Korban)</span></td>
                                            <td>Pengaduan anda sedang diproses oleh wali kelas</td>
                                        </tr>
                                        <tr>
                                            <td>Wali kelas proses tindak lanjut awal</td>
                                            <td><span class="badge badge-primary">Siswa (Pelaku)</span></td>
                                            <td>Anda menjadi tersangka pelaku pembullyan, segera hubungi wali kelas</td>
                                        </tr>
                                        <tr>
                                            <td>Tindak lanjut selesai</td>
                                            <td><span class="badge badge-primary">Siswa (Pelapor)</span></td>
                                            <td>Pengaduan Anda telah selesai ditangani</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                
                <!-- MIGRATIONS TAB -->
                <div class="tab-pane fade" id="migrations" role="tabpanel">
                    
                    <!-- Table: users -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: users
                            </h5>
                            <small class="text-muted">Menyimpan data pengguna sistem (admin, guru_bk, wali_kelas, siswa)</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>bigint (PK)</td><td>Primary key, auto increment</td></tr>
                                        <tr><td><code>name</code></td><td>string</td><td>Nama lengkap pengguna</td></tr>
                                        <tr><td><code>email</code></td><td>string (unique)</td><td>Email pengguna untuk login</td></tr>
                                        <tr><td><code>email_verified_at</code></td><td>timestamp (nullable)</td><td>Waktu verifikasi email</td></tr>
                                        <tr><td><code>password</code></td><td>string</td><td>Password terenkripsi</td></tr>
                                        <tr><td><code>role</code></td><td>enum</td><td>Role pengguna: admin, guru_bk, wali_kelas, siswa, kepala_sekolah</td></tr>
                                        <tr><td><code>kelas</code></td><td>string (nullable)</td><td>Kelas (untuk siswa & wali kelas)</td></tr>
                                        <tr><td><code>nip</code></td><td>string (nullable)</td><td>NIP/NIS pengguna</td></tr>
                                        <tr><td><code>phone</code></td><td>string (nullable)</td><td>Nomor telepon</td></tr>
                                        <tr><td><code>address</code></td><td>text (nullable)</td><td>Alamat</td></tr>
                                        <tr><td><code>avatar</code></td><td>string (nullable)</td><td>Path foto profil</td></tr>
                                        <tr><td><code>remember_token</code></td><td>string (nullable)</td><td>Token untuk fitur "remember me"</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: pengaduan -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: pengaduan
                            </h5>
                            <small class="text-muted">Menyimpan data laporan pengaduan bullying dari siswa</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>bigint (PK)</td><td>Primary key, auto increment</td></tr>
                                        <tr><td><code>user_id</code></td><td>bigint (FK → users)</td><td>ID pengguna yang membuat laporan</td></tr>
                                        <tr><td><code>nomor_laporan</code></td><td>string (unique)</td><td>Nomor unik laporan (format: PB-YYYYMMDD-XXX)</td></tr>
                                        <tr><td><code>report_type</code></td><td>enum</td><td>Tipe pelapor: korban, teman_korban, orang_tua, guru, lainnya</td></tr>
                                        <tr><td><code>reporter_name</code></td><td>string</td><td>Nama pelapor</td></tr>
                                        <tr><td><code>reporter_class</code></td><td>string</td><td>Kelas pelapor</td></tr>
                                        <tr><td><code>victim_name</code></td><td>string</td><td>Nama korban</td></tr>
                                        <tr><td><code>victim_class</code></td><td>string</td><td>Kelas korban</td></tr>
                                        <tr><td><code>perpetrator_name</code></td><td>string</td><td>Nama pelaku</td></tr>
                                        <tr><td><code>perpetrator_class</code></td><td>string</td><td>Kelas pelaku</td></tr>
                                        <tr><td><code>incident_date</code></td><td>date</td><td>Tanggal kejadian</td></tr>
                                        <tr><td><code>incident_time</code></td><td>time (nullable)</td><td>Waktu kejadian</td></tr>
                                        <tr><td><code>location</code></td><td>string</td><td>Lokasi kejadian</td></tr>
                                        <tr><td><code>bullying_type</code></td><td>enum</td><td>Jenis bullying: fisik, verbal, cyber, pengucilan, intimidasi, lainnya</td></tr>
                                        <tr><td><code>description</code></td><td>text</td><td>Deskripsi kejadian</td></tr>
                                        <tr><td><code>witnesses</code></td><td>string (nullable)</td><td>Nama saksi</td></tr>
                                        <tr><td><code>urgency</code></td><td>enum</td><td>Tingkat urgensi: rendah, sedang, tinggi</td></tr>
                                        <tr><td><code>attachment</code></td><td>string (nullable)</td><td>Path file lampiran bukti</td></tr>
                                        <tr><td><code>status</code></td><td>enum</td><td>Status: draf, menunggu, disetujui, ditolak, selesai</td></tr>
                                        <tr><td><code>alasan_penolakan</code></td><td>text (nullable)</td><td>Alasan jika pengaduan ditolak</td></tr>
                                        <tr><td><code>rejected_at</code></td><td>timestamp (nullable)</td><td>Waktu penolakan</td></tr>
                                        <tr><td><code>rejected_by</code></td><td>bigint (FK → users)</td><td>ID admin yang menolak</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: tindak_lanjut -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: tindak_lanjut
                            </h5>
                            <small class="text-muted">Menyimpan data tindak lanjut pengaduan oleh Guru BK</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>bigint (PK)</td><td>Primary key, auto increment</td></tr>
                                        <tr><td><code>pengaduan_id</code></td><td>bigint (FK → pengaduan)</td><td>ID pengaduan yang ditindaklanjuti</td></tr>
                                        <tr><td><code>user_id</code></td><td>bigint (FK → users)</td><td>ID guru BK yang menangani</td></tr>
                                        <tr><td><code>nomor_tindakan</code></td><td>string (unique)</td><td>Nomor unik tindakan</td></tr>
                                        <tr><td><code>jenis_tindakan</code></td><td>enum</td><td>Jenis: pembinaan, konseling, skorsing, peringatan, lainnya</td></tr>
                                        <tr><td><code>deskripsi</code></td><td>text</td><td>Deskripsi rencana tindakan</td></tr>
                                        <tr><td><code>tanggal_tindakan</code></td><td>date</td><td>Tanggal rencana tindakan</td></tr>
                                        <tr><td><code>tanggal_mulai_proses</code></td><td>date (nullable)</td><td>Tanggal mulai proses</td></tr>
                                        <tr><td><code>catatan_proses</code></td><td>text (nullable)</td><td>Catatan selama proses</td></tr>
                                        <tr><td><code>pihak_terlibat</code></td><td>text (nullable)</td><td>Pihak yang terlibat dalam proses</td></tr>
                                        <tr><td><code>kendala</code></td><td>text (nullable)</td><td>Kendala yang dihadapi</td></tr>
                                        <tr><td><code>tanggal_selesai</code></td><td>date (nullable)</td><td>Tanggal penyelesaian</td></tr>
                                        <tr><td><code>hasil</code></td><td>text (nullable)</td><td>Hasil penanganan</td></tr>
                                        <tr><td><code>evaluasi</code></td><td>text (nullable)</td><td>Evaluasi penanganan</td></tr>
                                        <tr><td><code>rekomendasi</code></td><td>text (nullable)</td><td>Rekomendasi tindak lanjut</td></tr>
                                        <tr><td><code>status</code></td><td>enum</td><td>Status: direncanakan, diproses, selesai</td></tr>
                                        <tr><td><code>status_hasil</code></td><td>string (nullable)</td><td>Status hasil penanganan</td></tr>
                                        <tr><td><code>attachment</code></td><td>string (nullable)</td><td>Path file lampiran</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: tindak_lanjut_awal -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: tindak_lanjut_awal
                            </h5>
                            <small class="text-muted">Menyimpan data tindak lanjut awal oleh Wali Kelas</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>bigint (PK)</td><td>Primary key, auto increment</td></tr>
                                        <tr><td><code>pengaduan_id</code></td><td>bigint (FK → pengaduan)</td><td>ID pengaduan yang ditindaklanjuti</td></tr>
                                        <tr><td><code>user_id</code></td><td>bigint (FK → users)</td><td>ID wali kelas yang menangani</td></tr>
                                        <tr><td><code>catatan</code></td><td>text (nullable)</td><td>Catatan/rencana tindak lanjut</td></tr>
                                        <tr><td><code>panggil_korban</code></td><td>boolean</td><td>Flag panggil korban</td></tr>
                                        <tr><td><code>panggil_pelaku</code></td><td>boolean</td><td>Flag panggil pelaku</td></tr>
                                        <tr><td><code>panggil_korban_id</code></td><td>bigint (FK → users)</td><td>ID user siswa korban yang dipanggil</td></tr>
                                        <tr><td><code>panggil_pelaku_id</code></td><td>bigint (FK → users)</td><td>ID user siswa pelaku yang dipanggil</td></tr>
                                        <tr><td><code>rekomendasi_bk</code></td><td>boolean</td><td>Flag rekomendasi ke guru BK</td></tr>
                                        <tr><td><code>status</code></td><td>enum</td><td>Status: diproses, selesai, direkomendasi_bk</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: notifications -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: notifications
                            </h5>
                            <small class="text-muted">Menyimpan data notifikasi untuk pengguna (Laravel Notification)</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>uuid (PK)</td><td>Primary key UUID</td></tr>
                                        <tr><td><code>type</code></td><td>string</td><td>Tipe notifikasi (class name)</td></tr>
                                        <tr><td><code>notifiable_type</code></td><td>string</td><td>Model penerima (App\Models\User)</td></tr>
                                        <tr><td><code>notifiable_id</code></td><td>bigint</td><td>ID penerima notifikasi</td></tr>
                                        <tr><td><code>data</code></td><td>text (JSON)</td><td>Data notifikasi dalam format JSON</td></tr>
                                        <tr><td><code>read_at</code></td><td>timestamp (nullable)</td><td>Waktu notifikasi dibaca</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: login_history -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: login_history
                            </h5>
                            <small class="text-muted">Menyimpan riwayat login pengguna</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>bigint (PK)</td><td>Primary key, auto increment</td></tr>
                                        <tr><td><code>user_id</code></td><td>bigint (FK → users)</td><td>ID pengguna yang login</td></tr>
                                        <tr><td><code>ip_address</code></td><td>string</td><td>Alamat IP</td></tr>
                                        <tr><td><code>user_agent</code></td><td>text</td><td>User agent browser</td></tr>
                                        <tr><td><code>device</code></td><td>string</td><td>Jenis perangkat</td></tr>
                                        <tr><td><code>browser</code></td><td>string</td><td>Nama browser</td></tr>
                                        <tr><td><code>platform</code></td><td>string</td><td>Sistem operasi</td></tr>
                                        <tr><td><code>login_at</code></td><td>timestamp</td><td>Waktu login</td></tr>
                                        <tr><td><code>timestamps</code></td><td>timestamp</td><td>created_at & updated_at</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table: sessions -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                            <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Tabel: sessions
                            </h5>
                            <small class="text-muted">Menyimpan data sesi pengguna (Laravel Session)</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #e0e7ff;">
                                        <tr>
                                            <th>Field</th>
                                            <th>Tipe</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>id</code></td><td>string (PK)</td><td>Session ID</td></tr>
                                        <tr><td><code>user_id</code></td><td>bigint (nullable)</td><td>ID pengguna jika sudah login</td></tr>
                                        <tr><td><code>ip_address</code></td><td>string(45)</td><td>Alamat IP</td></tr>
                                        <tr><td><code>user_agent</code></td><td>text</td><td>User agent browser</td></tr>
                                        <tr><td><code>payload</code></td><td>longText</td><td>Data sesi terenkripsi</td></tr>
                                        <tr><td><code>last_activity</code></td><td>integer</td><td>Timestamp aktivitas terakhir</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- MODELS TAB -->
                <div class="tab-pane fade" id="models" role="tabpanel">
                    
                    <!-- Model: User -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: User
                            </h5>
                            <small class="text-muted">App\Models\User - Model untuk pengguna sistem</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item"><code>pengaduan()</code> → HasMany ke <strong>Pengaduan</strong> - Satu user bisa memiliki banyak pengaduan</li>
                                <li class="list-group-item"><code>tindakLanjut()</code> → HasMany ke <strong>TindakLanjut</strong> - Satu guru BK bisa menangani banyak tindak lanjut</li>
                                <li class="list-group-item"><code>loginHistory()</code> → HasMany ke <strong>LoginHistory</strong> - Riwayat login user</li>
                                <li class="list-group-item"><code>notifications()</code> → Notifiable trait - Notifikasi untuk user</li>
                            </ul>
                            
                            <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-code mr-2"></i>Methods</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #d1fae5;">
                                        <tr>
                                            <th>Method</th>
                                            <th>Return</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>isAdmin()</code></td><td>bool</td><td>Cek apakah user adalah admin</td></tr>
                                        <tr><td><code>isGuruBK()</code></td><td>bool</td><td>Cek apakah user adalah Guru BK</td></tr>
                                        <tr><td><code>isWaliKelas()</code></td><td>bool</td><td>Cek apakah user adalah Wali Kelas</td></tr>
                                        <tr><td><code>isSiswa()</code></td><td>bool</td><td>Cek apakah user adalah Siswa</td></tr>
                                        <tr><td><code>hasRole($role)</code></td><td>bool</td><td>Cek apakah user memiliki role tertentu</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Model: Pengaduan -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: Pengaduan
                            </h5>
                            <small class="text-muted">App\Models\Pengaduan - Model untuk pengaduan bullying</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item"><code>user()</code> → BelongsTo ke <strong>User</strong> - Pengaduan dibuat oleh satu user (pelapor)</li>
                                <li class="list-group-item"><code>tindakLanjut()</code> → HasOne ke <strong>TindakLanjut</strong> - Satu pengaduan memiliki satu tindak lanjut dari BK</li>
                                <li class="list-group-item"><code>tindakLanjutAwal()</code> → HasOne ke <strong>TindakLanjutAwal</strong> - Satu pengaduan memiliki satu tindak lanjut awal dari wali kelas</li>
                                <li class="list-group-item"><code>rejectedBy()</code> → BelongsTo ke <strong>User</strong> - Admin yang menolak pengaduan</li>
                            </ul>
                            
                            <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-code mr-2"></i>Methods</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #d1fae5;">
                                        <tr>
                                            <th>Method</th>
                                            <th>Return</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>getRouteKeyName()</code></td><td>string</td><td>Override route key menggunakan nomor_laporan</td></tr>
                                        <tr><td><code>scopeFilter($query, $filters)</code></td><td>Builder</td><td>Scope untuk filter pencarian pengaduan</td></tr>
                                        <tr><td><code>getStatusTampil()</code></td><td>string</td><td>Mendapatkan status pengaduan dalam format tampilan</td></tr>
                                        <tr><td><code>getKorbanAttribute()</code></td><td>string</td><td>Accessor untuk mendapatkan nama korban</td></tr>
                                        <tr><td><code>getJenisBullyingAttribute()</code></td><td>string</td><td>Accessor untuk mendapatkan jenis bullying dalam format tampilan</td></tr>
                                        <tr><td><code>getPrioritasAttribute()</code></td><td>string</td><td>Accessor untuk mendapatkan prioritas/urgensi</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h6 class="font-weight-bold text-warning mt-4 mb-3"><i class="fas fa-bolt mr-2"></i>Events (booted)</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><code>deleting</code> - Saat pengaduan dihapus, semua notifikasi terkait juga dihapus</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Model: TindakLanjut -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: TindakLanjut
                            </h5>
                            <small class="text-muted">App\Models\TindakLanjut - Model untuk tindak lanjut oleh Guru BK</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item"><code>pengaduan()</code> → BelongsTo ke <strong>Pengaduan</strong> - Tindak lanjut untuk satu pengaduan</li>
                                <li class="list-group-item"><code>user()</code> → BelongsTo ke <strong>User</strong> - Guru BK yang menangani</li>
                            </ul>
                            
                            <h6 class="font-weight-bold text-warning mt-4 mb-3"><i class="fas fa-bolt mr-2"></i>Events (booted)</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><code>created</code> - Saat tindak lanjut dibuat, status pengaduan diubah menjadi 'disetujui'</li>
                                <li class="list-group-item"><code>updated</code> - Saat status tindak lanjut diubah menjadi 'selesai', status pengaduan juga diubah menjadi 'selesai'</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Model: TindakLanjutAwal -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: TindakLanjutAwal
                            </h5>
                            <small class="text-muted">App\Models\TindakLanjutAwal - Model untuk tindak lanjut awal oleh Wali Kelas</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item"><code>pengaduan()</code> → BelongsTo ke <strong>Pengaduan</strong> - Tindak lanjut awal untuk satu pengaduan</li>
                                <li class="list-group-item"><code>user()</code> → BelongsTo ke <strong>User</strong> - Wali kelas yang menangani</li>
                                <li class="list-group-item"><code>korban()</code> → BelongsTo ke <strong>User</strong> - Siswa korban yang dipanggil</li>
                                <li class="list-group-item"><code>pelaku()</code> → BelongsTo ke <strong>User</strong> - Siswa pelaku yang dipanggil</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Model: LoginHistory -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: LoginHistory
                            </h5>
                            <small class="text-muted">App\Models\LoginHistory - Model untuk riwayat login</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><code>user()</code> → BelongsTo ke <strong>User</strong> - User yang melakukan login</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Model: Notification -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                            <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                                <i class="fas fa-cube mr-2"></i>Model: Notification
                            </h5>
                            <small class="text-muted">App\Models\Notification - Model untuk notifikasi</small>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-link mr-2"></i>Relasi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item"><code>user()</code> → BelongsTo ke <strong>User</strong> - Penerima notifikasi</li>
                                <li class="list-group-item"><code>pengaduan()</code> → BelongsTo ke <strong>Pengaduan</strong> - Pengaduan terkait notifikasi</li>
                            </ul>
                            
                            <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-code mr-2"></i>Scopes</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #d1fae5;">
                                        <tr>
                                            <th>Scope</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><code>scopeUnread()</code></td><td>Filter notifikasi yang belum dibaca</td></tr>
                                        <tr><td><code>scopeRead()</code></td><td>Filter notifikasi yang sudah dibaca</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Diagram Relasi -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #e0e7ff; border-bottom: 1px solid #a5b4fc;">
                            <h5 class="mb-0" style="color: #3730a3; font-weight: 600;">
                                <i class="fas fa-project-diagram mr-2"></i>Diagram Relasi Antar Tabel
                            </h5>
                        </div>
                        <div class="card-body">
                            <div style="background: #f8fafc; padding: 20px; border-radius: 8px; font-family: monospace; font-size: 13px; line-height: 1.8;">
<pre style="margin: 0; white-space: pre-wrap;">
┌─────────────────┐
│      USERS      │
├─────────────────┤
│ id (PK)         │◄─────────────────────────────────────────────────────┐
│ name            │                                                       │
│ email           │                                                       │
│ role            │                                                       │
│ kelas           │                                                       │
└────────┬────────┘                                                       │
         │                                                                │
         │ 1:N                                                            │
         ▼                                                                │
┌─────────────────┐       ┌───────────────────┐       ┌─────────────────────┐
│   PENGADUAN     │       │   TINDAK_LANJUT   │       │ TINDAK_LANJUT_AWAL  │
├─────────────────┤       ├───────────────────┤       ├─────────────────────┤
│ id (PK)         │◄──────│ pengaduan_id (FK) │       │ id (PK)             │
│ user_id (FK)────│──►    │ user_id (FK)──────│──►    │ pengaduan_id (FK)───│──►
│ nomor_laporan   │       │ nomor_tindakan    │       │ user_id (FK)────────│──►
│ victim_name     │       │ jenis_tindakan    │       │ panggil_korban_id───│──►
│ perpetrator_name│ 1:1   │ status            │ 1:1   │ panggil_pelaku_id───│──►
│ status          │◄──────│ hasil             │◄──────│ status              │
│ rejected_by(FK)─│──►    └───────────────────┘       └─────────────────────┘
└─────────────────┘
         │
         │ 1:N
         ▼
┌─────────────────┐       ┌───────────────────┐
│  NOTIFICATIONS  │       │   LOGIN_HISTORY   │
├─────────────────┤       ├───────────────────┤
│ id (PK)         │       │ id (PK)           │
│ notifiable_id───│──►    │ user_id (FK)──────│──►
│ type            │       │ ip_address        │
│ data (JSON)     │       │ browser           │
│ read_at         │       │ login_at          │
└─────────────────┘       └───────────────────┘
</pre>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CONTROLLERS TAB -->
                <div class="tab-pane fade" id="controllers" role="tabpanel">
                    
                    <!-- Controller: DashboardController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>DashboardController
                            </h5>
                            <small class="text-muted">Mengelola tampilan dashboard untuk semua role</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /dashboard</td>
                                            <td>Menampilkan dashboard sesuai role user (siswa, guru_bk, wali_kelas, admin, kepala_sekolah). Menyediakan data statistik, pengaduan terbaru, dan data chart.</td>
                                        </tr>
                                        <tr>
                                            <td><code>getChartDataSiswa($userId)</code></td>
                                            <td>-</td>
                                            <td>Generate data chart bulanan untuk siswa (pengaduan per bulan)</td>
                                        </tr>
                                        <tr>
                                            <td><code>getChartDataGuruBK()</code></td>
                                            <td>-</td>
                                            <td>Generate data chart bulanan untuk Guru BK (semua pengaduan)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: PengaduanController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>PengaduanController
                            </h5>
                            <small class="text-muted">Mengelola CRUD pengaduan bullying</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /pengaduan</td>
                                            <td>Menampilkan daftar pengaduan sesuai role: Siswa (pengaduan sendiri), Wali Kelas (siswa kelasnya), Guru BK (direkomendasi ke BK), Admin (semua)</td>
                                        </tr>
                                        <tr>
                                            <td><code>create()</code></td>
                                            <td>GET /buat-pengaduan/create</td>
                                            <td>Form buat pengaduan baru (siswa only)</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST /buat-pengaduan</td>
                                            <td>Simpan pengaduan baru, generate nomor laporan otomatis, kirim notifikasi ke admin</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET /pengaduan/{id}</td>
                                            <td>Detail pengaduan (admin/guru_bk/wali_kelas)</td>
                                        </tr>
                                        <tr>
                                            <td><code>showSiswa($id)</code></td>
                                            <td>GET /pengaduan-saya/{id}</td>
                                            <td>Detail pengaduan milik siswa (siswa only)</td>
                                        </tr>
                                        <tr>
                                            <td><code>edit($id)</code></td>
                                            <td>GET /buat-pengaduan/{id}/edit</td>
                                            <td>Form edit pengaduan (hanya draf)</td>
                                        </tr>
                                        <tr>
                                            <td><code>update(Request, $id)</code></td>
                                            <td>PUT /buat-pengaduan/{id}</td>
                                            <td>Update pengaduan (hanya draf)</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy($id)</code></td>
                                            <td>DELETE /buat-pengaduan/{id}</td>
                                            <td>Hapus pengaduan (hanya draf)</td>
                                        </tr>
                                        <tr>
                                            <td><code>saveDraft(Request)</code></td>
                                            <td>POST /buat-pengaduan/simpan-draft</td>
                                            <td>Simpan pengaduan sebagai draf</td>
                                        </tr>
                                        <tr>
                                            <td><code>draf()</code></td>
                                            <td>GET /draf-pengaduan</td>
                                            <td>Daftar pengaduan draf milik siswa</td>
                                        </tr>
                                        <tr>
                                            <td><code>riwayat()</code></td>
                                            <td>GET /riwayat-pengaduan</td>
                                            <td>Riwayat pengaduan siswa</td>
                                        </tr>
                                        <tr>
                                            <td><code>kirim($id)</code></td>
                                            <td>POST /draf-pengaduan/{id}/kirim</td>
                                            <td>Kirim draf menjadi pengaduan aktif</td>
                                        </tr>
                                        <tr>
                                            <td><code>approve($id)</code></td>
                                            <td>POST /pengaduan/{id}/approve</td>
                                            <td>Setujui pengaduan (admin only), kirim notifikasi ke pelapor</td>
                                        </tr>
                                        <tr>
                                            <td><code>reject($id)</code></td>
                                            <td>POST /pengaduan/{id}/reject</td>
                                            <td>Tolak pengaduan dengan alasan (admin only)</td>
                                        </tr>
                                        <tr>
                                            <td><code>downloadAttachment($id)</code></td>
                                            <td>GET /pengaduan/{id}/download</td>
                                            <td>Download file lampiran pengaduan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: TindakLanjutController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>TindakLanjutController
                            </h5>
                            <small class="text-muted">Mengelola tindak lanjut pengaduan oleh Guru BK</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /tindak-lanjut</td>
                                            <td>Daftar semua tindak lanjut</td>
                                        </tr>
                                        <tr>
                                            <td><code>create()</code></td>
                                            <td>GET /tindak-lanjut/create</td>
                                            <td>Form buat tindak lanjut (Step 1: Rencana)</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST /tindak-lanjut</td>
                                            <td>Simpan tindak lanjut baru dengan status 'direncanakan'</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}</td>
                                            <td>Detail tindak lanjut</td>
                                        </tr>
                                        <tr>
                                            <td><code>edit($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/edit</td>
                                            <td>Form edit tindak lanjut</td>
                                        </tr>
                                        <tr>
                                            <td><code>update(Request, $id)</code></td>
                                            <td>PUT /tindak-lanjut/{id}</td>
                                            <td>Update tindak lanjut</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy($id)</code></td>
                                            <td>DELETE /tindak-lanjut/{id}</td>
                                            <td>Hapus tindak lanjut</td>
                                        </tr>
                                        <tr>
                                            <td><code>proses($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/proses</td>
                                            <td>Form proses tindak lanjut (Step 2: Proses)</td>
                                        </tr>
                                        <tr>
                                            <td><code>updateProses($id)</code></td>
                                            <td>PATCH /tindak-lanjut/{id}/update-proses</td>
                                            <td>Update ke status 'diproses'</td>
                                        </tr>
                                        <tr>
                                            <td><code>selesai($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/selesai</td>
                                            <td>Form selesaikan tindak lanjut (Step 3: Selesai)</td>
                                        </tr>
                                        <tr>
                                            <td><code>updateSelesai($id)</code></td>
                                            <td>PATCH /tindak-lanjut/{id}/update-selesai</td>
                                            <td>Update ke status 'selesai', kirim notifikasi ke pelapor</td>
                                        </tr>
                                        <tr>
                                            <td><code>showProses($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/show-proses</td>
                                            <td>Lihat detail proses</td>
                                        </tr>
                                        <tr>
                                            <td><code>showSelesai($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/show-selesai</td>
                                            <td>Lihat detail selesai</td>
                                        </tr>
                                        <tr>
                                            <td><code>showDetail($id)</code></td>
                                            <td>GET /tindak-lanjut/{id}/detail</td>
                                            <td>Lihat detail lengkap (semua step)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: TindakLanjutAwalController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>TindakLanjutAwalController
                            </h5>
                            <small class="text-muted">Mengelola tindak lanjut awal oleh Wali Kelas</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /tindak-lanjut-awal</td>
                                            <td>Daftar tindak lanjut awal (pengaduan dari kelas wali kelas)</td>
                                        </tr>
                                        <tr>
                                            <td><code>create(Request)</code></td>
                                            <td>GET /tindak-lanjut-awal/create</td>
                                            <td>Form buat/edit tindak lanjut awal</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST /tindak-lanjut-awal</td>
                                            <td>Simpan tindak lanjut awal, pilih korban & pelaku, kirim notifikasi ke siswa terkait</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET /tindak-lanjut-awal/{id}</td>
                                            <td>Detail tindak lanjut awal</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy($id)</code></td>
                                            <td>DELETE /tindak-lanjut-awal/{id}</td>
                                            <td>Hapus tindak lanjut awal</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: NotificationController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>NotificationController
                            </h5>
                            <small class="text-muted">Mengelola notifikasi pengguna</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /notifications</td>
                                            <td>Daftar semua notifikasi user dengan pagination</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET /notifications/detail/{id}</td>
                                            <td>Detail notifikasi</td>
                                        </tr>
                                        <tr>
                                            <td><code>markAsRead($id)</code></td>
                                            <td>POST /notifications/{id}/read</td>
                                            <td>Tandai notifikasi sebagai sudah dibaca</td>
                                        </tr>
                                        <tr>
                                            <td><code>approve($id)</code></td>
                                            <td>POST /notifications/{id}/approve</td>
                                            <td>Setujui pengaduan dari notifikasi</td>
                                        </tr>
                                        <tr>
                                            <td><code>reject($id)</code></td>
                                            <td>POST /notifications/{id}/reject</td>
                                            <td>Tolak pengaduan dari notifikasi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: ProfileController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>ProfileController
                            </h5>
                            <small class="text-muted">Mengelola profil pengguna</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /profile</td>
                                            <td>Halaman profil user dengan login history</td>
                                        </tr>
                                        <tr>
                                            <td><code>edit()</code></td>
                                            <td>GET /profile/edit</td>
                                            <td>Form edit profil</td>
                                        </tr>
                                        <tr>
                                            <td><code>update(Request)</code></td>
                                            <td>PATCH /profile</td>
                                            <td>Update profil</td>
                                        </tr>
                                        <tr>
                                            <td><code>updateProfile(Request)</code></td>
                                            <td>PUT /profile/information</td>
                                            <td>Update informasi profil (nama, email, phone, dll)</td>
                                        </tr>
                                        <tr>
                                            <td><code>updatePassword(Request)</code></td>
                                            <td>PUT /profile/password</td>
                                            <td>Update password</td>
                                        </tr>
                                        <tr>
                                            <td><code>updateAvatar(Request)</code></td>
                                            <td>POST /profile/avatar</td>
                                            <td>Upload foto profil</td>
                                        </tr>
                                        <tr>
                                            <td><code>deleteAvatar()</code></td>
                                            <td>DELETE /profile/avatar</td>
                                            <td>Hapus foto profil</td>
                                        </tr>
                                        <tr>
                                            <td><code>logoutAllDevices()</code></td>
                                            <td>POST /profile/logout-all</td>
                                            <td>Logout dari semua perangkat</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy()</code></td>
                                            <td>DELETE /profile</td>
                                            <td>Hapus akun</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: UserController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>UserController
                            </h5>
                            <small class="text-muted">Mengelola data user (Admin only)</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /users</td>
                                            <td>Daftar semua user</td>
                                        </tr>
                                        <tr>
                                            <td><code>create()</code></td>
                                            <td>GET /users/create</td>
                                            <td>Form tambah user</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST /users</td>
                                            <td>Simpan user baru</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET /users/{id}</td>
                                            <td>Detail user</td>
                                        </tr>
                                        <tr>
                                            <td><code>edit($id)</code></td>
                                            <td>GET /users/{id}/edit</td>
                                            <td>Form edit user</td>
                                        </tr>
                                        <tr>
                                            <td><code>update(Request, $id)</code></td>
                                            <td>PUT /users/{id}</td>
                                            <td>Update user</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy($id)</code></td>
                                            <td>DELETE /users/{id}</td>
                                            <td>Hapus user (tidak bisa hapus admin/kepala_sekolah)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: SiswaController, GuruController, WaliKelasController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>SiswaController / GuruController / WaliKelasController
                            </h5>
                            <small class="text-muted">Mengelola data siswa, guru, dan wali kelas</small>
                        </div>
                        <div class="card-body">
                            <p>Ketiga controller ini memiliki struktur serupa (Resource Controller):</p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /siswa, /guru, /wali-kelas</td>
                                            <td>Daftar data</td>
                                        </tr>
                                        <tr>
                                            <td><code>create()</code></td>
                                            <td>GET .../create</td>
                                            <td>Form tambah</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST ...</td>
                                            <td>Simpan data baru</td>
                                        </tr>
                                        <tr>
                                            <td><code>show($id)</code></td>
                                            <td>GET .../{id}</td>
                                            <td>Detail data</td>
                                        </tr>
                                        <tr>
                                            <td><code>edit($id)</code></td>
                                            <td>GET .../{id}/edit</td>
                                            <td>Form edit</td>
                                        </tr>
                                        <tr>
                                            <td><code>update(Request, $id)</code></td>
                                            <td>PUT .../{id}</td>
                                            <td>Update data</td>
                                        </tr>
                                        <tr>
                                            <td><code>destroy($id)</code></td>
                                            <td>DELETE .../{id}</td>
                                            <td>Hapus data</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: LaporanController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>LaporanController
                            </h5>
                            <small class="text-muted">Generate laporan (Admin & Kepala Sekolah only)</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>index()</code></td>
                                            <td>GET /laporan</td>
                                            <td>Halaman utama laporan</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanTahunan()</code></td>
                                            <td>GET /laporan/tahunan</td>
                                            <td>Laporan per tahun</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanBulanan()</code></td>
                                            <td>GET /laporan/bulanan</td>
                                            <td>Laporan per bulan</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanPengaduan()</code></td>
                                            <td>GET /laporan/pengaduan</td>
                                            <td>Laporan pengaduan (export PDF)</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanTindakLanjut()</code></td>
                                            <td>GET /laporan/tindak-lanjut</td>
                                            <td>Laporan tindak lanjut (export PDF)</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanSiswa()</code></td>
                                            <td>GET /laporan/siswa</td>
                                            <td>Laporan data siswa (export PDF)</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanGuru()</code></td>
                                            <td>GET /laporan/guru</td>
                                            <td>Laporan data guru (export PDF)</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanWaliKelas()</code></td>
                                            <td>GET /laporan/wali-kelas</td>
                                            <td>Laporan data wali kelas (export PDF)</td>
                                        </tr>
                                        <tr>
                                            <td><code>laporanUser()</code></td>
                                            <td>GET /laporan/user</td>
                                            <td>Laporan data user (export PDF)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Controller: RoleController -->
                    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                        <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                            <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                                <i class="fas fa-cog mr-2"></i>RoleController
                            </h5>
                            <small class="text-muted">Mengelola pemilihan role saat registrasi</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background: #f0fdf4;">
                                        <tr>
                                            <th width="25%">Method</th>
                                            <th width="15%">Route</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>create()</code></td>
                                            <td>GET /role-selection</td>
                                            <td>Halaman pilih role setelah registrasi</td>
                                        </tr>
                                        <tr>
                                            <td><code>store(Request)</code></td>
                                            <td>POST /role-selection</td>
                                            <td>Simpan role yang dipilih</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #4A7AB5, #5B8BC5);
    }
    .nav-pills .nav-link:not(.active) {
        color: #4b5563;
    }
    .nav-pills .nav-link:not(.active):hover {
        background: #f3f4f6;
    }
    code {
        background: #fee2e2;
        color: #dc2626;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 13px;
    }
    .table code {
        background: #fef3c7;
        color: #92400e;
    }
</style>
@endsection
