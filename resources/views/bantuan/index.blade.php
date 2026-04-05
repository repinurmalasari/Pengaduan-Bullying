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
                            <i class="fas fa-question-circle" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Pusat Bantuan</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">
                                Panduan penggunaan Sistem Pengaduan Bullying untuk 
                                <span class="badge badge-light">
                                    @if($user->role == 'siswa') Siswa
                                    @elseif($user->role == 'wali_kelas') Wali Kelas
                                    @elseif($user->role == 'guru_bk') Guru BK
                                    @elseif($user->role == 'admin') Admin
                                    @elseif($user->role == 'kepala_sekolah') Kepala Sekolah
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- LENGKAPI PROFIL UNTUK SEMUA ROLE --}}
            {{-- ============================================== --}}
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-user-circle mr-2"></i>Lengkapi Profil Anda
                    </h5>
                </div>
                <div class="card-body">
                    @if($user->role == 'siswa')
                        <p>
                            Untuk memaksimalkan layanan dan memudahkan proses verifikasi, pastikan Anda melengkapi profil dengan data berikut:
                        </p>
                        <ul>
                            <li><strong>Nama Lengkap</strong> sesuai identitas</li>
                            <li><strong>Kelas</strong> dan <strong>Nomor Induk Siswa</strong></li>
                            <li><strong>Email</strong> aktif (jika ada)</li>
                            <li><strong>Foto profil</strong> (opsional, untuk memudahkan identifikasi oleh guru)</li>
                        </ul>
                        <p>Data profil yang lengkap akan mempercepat proses penanganan pengaduan dan memudahkan komunikasi jika diperlukan klarifikasi.</p>
                    @elseif($user->role == 'wali_kelas')
                        <p>
                            Lengkapi profil Anda dengan:
                        </p>
                        <ul>
                            <li><strong>Nama Lengkap</strong> dan <strong>NIP</strong></li>
                            <li><strong>Kelas yang diampu</strong></li>
                            <li><strong>Email</strong> aktif</li>
                            <li><strong>Nomor telepon</strong> (untuk komunikasi internal)</li>
                        </ul>
                        <p>Profil yang lengkap memudahkan koordinasi dengan siswa, guru BK, dan admin sekolah.</p>
                    @elseif($user->role == 'guru_bk')
                        <p>
                            Pastikan profil Anda berisi:
                        </p>
                        <ul>
                            <li><strong>Nama Lengkap</strong> dan <strong>NIP</strong></li>
                            <li><strong>Email</strong> aktif</li>
                            <li><strong>Nomor telepon</strong> (untuk koordinasi penanganan kasus)</li>
                        </ul>
                        <p>Profil yang lengkap akan memperlancar proses tindak lanjut dan komunikasi antar pihak terkait.</p>
                    @elseif($user->role == 'admin')
                        <p>
                            Sebagai admin, pastikan profil Anda berisi:
                        </p>
                        <ul>
                            <li><strong>Nama Lengkap</strong></li>
                            <li><strong>Email</strong> aktif</li>
                            <li><strong>Nomor telepon</strong> (untuk keperluan administrasi)</li>
                        </ul>
                        <p>Profil admin yang lengkap penting untuk validasi dan keamanan sistem.</p>
                    @elseif($user->role == 'kepala_sekolah')
                        <p>
                            Lengkapi profil Anda dengan:
                        </p>
                        <ul>
                            <li><strong>Nama Lengkap</strong> dan <strong>NIP</strong></li>
                            <li><strong>Email</strong> aktif</li>
                            <li><strong>Nomor telepon</strong> (untuk komunikasi dengan admin dan guru)</li>
                        </ul>
                        <p>Profil kepala sekolah yang lengkap memudahkan monitoring dan pengambilan keputusan.</p>
                    @endif
                </div>
            </div>
            {{-- ============================================== --}}

            {{-- ============================================== --}}
            {{-- BANTUAN UNTUK SISWA --}}
            {{-- ============================================== --}}
            @if($user->role == 'siswa')
            
            <!-- Quick Start -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #eff6ff; border-bottom: 1px solid #bfdbfe;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-rocket mr-2"></i>Mulai Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div style="background: #dbeafe; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <span style="font-size: 24px; font-weight: bold; color: #1e40af;">1</span>
                            </div>
                            <h6 class="font-weight-bold">Buat Pengaduan</h6>
                            <p class="small text-muted">Klik menu "Data Pengaduan" di sidebar, lalu klik "Buat Pengaduan"</p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div style="background: #dbeafe; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <span style="font-size: 24px; font-weight: bold; color: #1e40af;">2</span>
                            </div>
                            <h6 class="font-weight-bold">Isi Form</h6>
                            <p class="small text-muted">Lengkapi data kejadian bullying</p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div style="background: #dbeafe; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <span style="font-size: 24px; font-weight: bold; color: #1e40af;">3</span>
                            </div>
                            <h6 class="font-weight-bold">Kirim</h6>
                            <p class="small text-muted">Kirim atau simpan sebagai draf</p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div style="background: #dbeafe; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <span style="font-size: 24px; font-weight: bold; color: #1e40af;">4</span>
                            </div>
                            <h6 class="font-weight-bold">Pantau</h6>
                            <p class="small text-muted">Cek status di "Riwayat Pengaduan"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Siswa -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-question mr-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqSiswa">
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq1">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara membuat pengaduan baru?</strong>
                                </button>
                            </div>
                            <div id="faq1" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Klik menu <strong>"Data Pengaduan"</strong> di sidebar kiri, lalu klik <strong>"Buat Pengaduan"</strong></li>
                                        <li>Pilih tipe pelapor (korban langsung, teman korban, dll)</li>
                                        <li>Isi data korban dan pelaku dengan lengkap</li>
                                        <li>Isi detail kejadian (tanggal, lokasi, deskripsi)</li>
                                        <li>Pilih jenis bullying dan tingkat urgensi</li>
                                        <li>Upload bukti jika ada (opsional)</li>
                                        <li>Klik <strong>"Kirim Pengaduan"</strong> atau <strong>"Simpan Draf"</strong></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq2">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Apa perbedaan "Kirim" dan "Simpan Draf"?</strong>
                                </button>
                            </div>
                            <div id="faq2" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ul>
                                        <li><strong>Kirim Pengaduan:</strong> Pengaduan langsung dikirim ke pihak sekolah untuk diverifikasi. Anda tidak bisa mengedit lagi setelah dikirim.</li>
                                        <li><strong>Simpan Draf:</strong> Pengaduan disimpan sementara. Anda bisa mengedit atau melengkapi data di kemudian hari sebelum mengirimnya.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq3">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara melihat status pengaduan saya?</strong>
                                </button>
                            </div>
                            <div id="faq3" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Klik menu <strong>"Riwayat Pengaduan"</strong> di sidebar</li>
                                        <li>Anda akan melihat daftar semua pengaduan yang sudah dikirim</li>
                                        <li>Kolom <strong>"Status"</strong> menunjukkan progres pengaduan Anda</li>
                                        <li>Klik <strong>"Lihat"</strong> untuk melihat detail lengkap</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq4">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Apa arti status pengaduan saya?</strong>
                                </button>
                            </div>
                            <div id="faq4" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ul>
                                        <li><span class="badge badge-secondary">Draf</span> - Belum dikirim, masih bisa diedit</li>
                                        <li><span class="badge badge-secondary">Menunggu</span> - Sedang menunggu verifikasi admin</li>
                                        <li><span class="badge badge-success">Disetujui</span> - Disetujui, menunggu tindak lanjut wali kelas</li>
                                        <li><span class="badge badge-danger">Ditolak</span> - Ditolak dengan alasan tertentu</li>
                                        <li><span class="badge badge-warning">Diproses</span> - Sedang ditangani wali kelas/guru BK</li>
                                        <li><span class="badge badge-success">Selesai</span> - Penanganan sudah selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq5">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Apakah identitas saya dirahasiakan?</strong>
                                </button>
                            </div>
                            <div id="faq5" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Ya, identitas pelapor bersifat <strong>rahasia</strong>. Hanya admin, guru BK, dan wali kelas yang berwenang yang dapat melihat data pelapor. Pelaku tidak akan mengetahui siapa yang melaporkan.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faq6">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana jika pengaduan saya ditolak?</strong>
                                </button>
                            </div>
                            <div id="faq6" class="collapse" data-parent="#faqSiswa">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Jika pengaduan ditolak, Anda akan menerima notifikasi dengan alasan penolakan. Anda dapat:</p>
                                    <ul>
                                        <li>Membaca alasan penolakan di detail pengaduan</li>
                                        <li>Membuat pengaduan baru dengan data yang lebih lengkap/jelas</li>
                                        <li>Berkonsultasi langsung dengan guru BK jika diperlukan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panduan Video/Gambar -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                    <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                        <i class="fas fa-lightbulb mr-2"></i>Tips Membuat Pengaduan yang Baik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="mr-3">
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-success">Yang Harus Dilakukan</h6>
                                    <ul class="pl-3 mb-0">
                                        <li>Isi semua data dengan lengkap dan jujur</li>
                                        <li>Jelaskan kejadian secara detail dan kronologis</li>
                                        <li>Sertakan bukti pendukung jika ada (foto, screenshot)</li>
                                        <li>Sebutkan saksi jika ada</li>
                                        <li>Pilih tingkat urgensi yang sesuai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="mr-3">
                                    <i class="fas fa-times-circle text-danger fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-danger">Yang Harus Dihindari</h6>
                                    <ul class="pl-3 mb-0">
                                        <li>Jangan membuat laporan palsu</li>
                                        <li>Jangan berlebihan atau mengurangi fakta</li>
                                        <li>Jangan menyebutkan nama tanpa bukti</li>
                                        <li>Jangan menggunakan kata-kata kasar</li>
                                        <li>Jangan melaporkan hal yang sama berulang kali</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            {{-- ============================================== --}}
            {{-- BANTUAN UNTUK WALI KELAS --}}
            {{-- ============================================== --}}
            @if($user->role == 'wali_kelas')
            
            <!-- Quick Start Wali Kelas -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #fef3c7; border-bottom: 1px solid #fcd34d;">
                    <h5 class="mb-0" style="color: #92400e; font-weight: 600;">
                        <i class="fas fa-rocket mr-2"></i>Panduan Singkat Wali Kelas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        Sebagai wali kelas, Anda bertanggung jawab untuk menangani tindak lanjut awal pengaduan yang melibatkan siswa dari kelas Anda (baik sebagai korban maupun pelaku). Anda menerima notifikasi saat ada pengaduan baru yang melibatkan siswa kelas Anda.
                    </div>
                    
                    <h6 class="font-weight-bold mt-4 mb-3">Alur Penanganan Tindak Lanjut Awal:</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card h-100" style="border: 2px solid #3b82f6;">
                                <div class="card-body text-center">
                                    <div style="background: #3b82f6; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">1</span>
                                    </div>
                                    <h6 class="font-weight-bold text-primary">TERIMA NOTIFIKASI</h6>
                                    <p class="small text-muted mb-0">Notifikasi otomatis saat ada pengaduan baru yang melibatkan siswa kelas Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100" style="border: 2px solid #f59e0b;">
                                <div class="card-body text-center">
                                    <div style="background: #f59e0b; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">2</span>
                                    </div>
                                    <h6 class="font-weight-bold text-warning">PROSES AWAL</h6>
                                    <p class="small text-muted mb-0">Pilih korban & pelaku, isi catatan rencana tindakan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100" style="border: 2px solid #8b5cf6;">
                                <div class="card-body text-center">
                                    <div style="background: #8b5cf6; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">3</span>
                                    </div>
                                    <h6 class="font-weight-bold" style="color: #8b5cf6;">INVESTIGASI</h6>
                                    <p class="small text-muted mb-0">Panggil siswa, investigasi & lakukan mediasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100" style="border: 2px solid #22c55e;">
                                <div class="card-body text-center">
                                    <div style="background: #22c55e; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">4</span>
                                    </div>
                                    <h6 class="font-weight-bold text-success">SELESAI / REKOMENDASI</h6>
                                    <p class="small text-muted mb-0">Selesaikan kasus ringan atau rekomendasikan ke BK</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panduan Menu -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #e0e7ff; border-bottom: 1px solid #a5b4fc;">
                    <h5 class="mb-0" style="color: #3730a3; font-weight: 600;">
                        <i class="fas fa-bars mr-2"></i>Panduan Menu Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 1px solid #e5e7eb;">
                                <div class="card-body">
                                    <h6 class="font-weight-bold"><i class="fas fa-file-alt text-primary mr-2"></i>Data Pengaduan</h6>
                                    <p class="small text-muted mb-2">Menu untuk melihat pengaduan yang melibatkan siswa kelas Anda.</p>
                                    <ul class="small mb-0">
                                        <li>Lihat detail pengaduan</li>
                                        <li>Klik tombol aksi untuk memproses tindak lanjut awal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 1px solid #e5e7eb;">
                                <div class="card-body">
                                    <h6 class="font-weight-bold"><i class="fas fa-clipboard-check text-success mr-2"></i>Data Tindak Lanjut Awal</h6>
                                    <p class="small text-muted mb-2">Menu untuk mengelola tindak lanjut awal yang Anda buat.</p>
                                    <ul class="small mb-0">
                                        <li>Lihat daftar tindak lanjut awal</li>
                                        <li>Edit / lanjutkan proses penanganan</li>
                                        <li>Selesaikan atau rekomendasikan ke BK</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 1px solid #e5e7eb;">
                                <div class="card-body">
                                    <h6 class="font-weight-bold"><i class="fas fa-tasks text-warning mr-2"></i>Data Tindak Lanjut</h6>
                                    <p class="small text-muted mb-2">Lihat tindak lanjut yang ditangani Guru BK (read-only).</p>
                                    <ul class="small mb-0">
                                        <li>Pantau progress kasus yang direkomendasi ke BK</li>
                                        <li>Tidak bisa edit - hanya untuk monitoring</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 1px solid #e5e7eb;">
                                <div class="card-body">
                                    <h6 class="font-weight-bold"><i class="fas fa-users text-info mr-2"></i>Data Siswa</h6>
                                    <p class="small text-muted mb-2">Lihat daftar siswa untuk referensi.</p>
                                    <ul class="small mb-0">
                                        <li>Lihat data siswa terdaftar</li>
                                        <li>Gunakan untuk mengecek data korban/pelaku</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Wali Kelas -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-question mr-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqWaliKelas">
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK1">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Pengaduan mana saja yang bisa saya lihat?</strong>
                                </button>
                            </div>
                            <div id="faqWK1" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Anda hanya dapat melihat pengaduan dimana:</p>
                                    <ul>
                                        <li><strong>Korban</strong> berasal dari kelas Anda, ATAU</li>
                                        <li><strong>Pelaku</strong> berasal dari kelas Anda</li>
                                    </ul>
                                    <p class="mb-0">Pengaduan yang tidak melibatkan siswa kelas Anda tidak akan muncul.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK2">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara memproses tindak lanjut awal?</strong>
                                </button>
                            </div>
                            <div id="faqWK2" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Data Pengaduan"</strong></li>
                                        <li>Klik tombol <strong>aksi</strong> (warna ungu) pada pengaduan baru</li>
                                        <li>Pilih siswa <strong>korban</strong> dan <strong>pelaku</strong> yang akan dipanggil</li>
                                        <li>Isi <strong>catatan/rencana tindakan</strong></li>
                                        <li>Klik <strong>"Proses"</strong></li>
                                        <li>Siswa korban dan pelaku akan <strong>otomatis menerima notifikasi</strong> pemanggilan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK3">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara menyelesaikan kasus ringan?</strong>
                                </button>
                            </div>
                            <div id="faqWK3" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Data Tindak Lanjut Awal"</strong></li>
                                        <li>Klik tombol <strong>Edit</strong> pada kasus yang ingin diselesaikan</li>
                                        <li>Di Step 2 (Penyelesaian), pilih <strong>"Selesai (Kasus Ringan)"</strong></li>
                                        <li>Isi <strong>catatan penyelesaian</strong> (minimal 10 karakter)</li>
                                        <li>Klik <strong>"Selesaikan Kasus"</strong></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK4">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara merekomendasikan ke Guru BK?</strong>
                                </button>
                            </div>
                            <div id="faqWK4" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Data Tindak Lanjut Awal"</strong></li>
                                        <li>Klik tombol <strong>Edit</strong> pada kasus yang berat</li>
                                        <li>Di Step 2 (Penyelesaian), pilih <strong>"Rekomendasikan ke Guru BK"</strong></li>
                                        <li>Isi <strong>catatan rekomendasi</strong> untuk Guru BK (minimal 10 karakter)</li>
                                        <li>Klik <strong>"Rekomendasikan"</strong></li>
                                        <li>Guru BK akan <strong>otomatis menerima notifikasi</strong> beserta catatan Anda</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK5">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Kapan harus merekomendasikan ke BK?</strong>
                                </button>
                            </div>
                            <div id="faqWK5" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Rekomendasikan ke Guru BK jika:</p>
                                    <ul>
                                        <li>Kasus bullying bersifat <strong>berat</strong> (fisik, berulang, menyebabkan trauma)</li>
                                        <li>Melibatkan <strong>banyak pelaku</strong> atau terorganisir</li>
                                        <li>Korban memerlukan <strong>konseling intensif</strong></li>
                                        <li>Memerlukan <strong>sanksi skorsing</strong> atau lebih berat</li>
                                        <li>Kasus tidak dapat diselesaikan di tingkat kelas</li>
                                        <li>Pelaku tidak kooperatif atau tidak menunjukkan penyesalan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqWK6">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Apa arti status di Data Tindak Lanjut Awal?</strong>
                                </button>
                            </div>
                            <div id="faqWK6" class="collapse" data-parent="#faqWaliKelas">
                                <div class="card-body" style="background: #f8fafc;">
                                    <table class="table table-bordered table-sm">
                                        <tr>
                                            <td><span class="badge" style="background: #fef3c7; color: #92400e;">Diproses</span></td>
                                            <td>Kasus sedang dalam penanganan Anda. Silakan lanjutkan investigasi dan mediasi.</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background: #dcfce7; color: #166534;">Selesai</span></td>
                                            <td>Kasus ringan telah berhasil diselesaikan oleh wali kelas.</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background: #e0e7ff; color: #3730a3;">Direkomendasi BK</span></td>
                                            <td>Kasus berat, telah diteruskan ke Guru BK untuk penanganan lanjutan.</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alur Kerja Wali Kelas -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                    <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                        <i class="fas fa-project-diagram mr-2"></i>Alur Kerja Detail
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center p-3" style="background: #f8fafc; border-radius: 10px;">
                        <div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 15px;">
                            <div class="text-center">
                                <div style="background: #3b82f6; color: white; padding: 15px; border-radius: 10px; min-width: 120px;">
                                    <i class="fas fa-bell fa-2x mb-2"></i>
                                    <p class="mb-0 small font-weight-bold">Notifikasi Masuk</p>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right fa-2x text-muted d-none d-md-block"></i>
                            <div class="text-center">
                                <div style="background: #f59e0b; color: white; padding: 15px; border-radius: 10px; min-width: 120px;">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <p class="mb-0 small font-weight-bold">Pilih Korban & Pelaku</p>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right fa-2x text-muted d-none d-md-block"></i>
                            <div class="text-center">
                                <div style="background: #8b5cf6; color: white; padding: 15px; border-radius: 10px; min-width: 120px;">
                                    <i class="fas fa-clipboard-check fa-2x mb-2"></i>
                                    <p class="mb-0 small font-weight-bold">Investigasi & Mediasi</p>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right fa-2x text-muted d-none d-md-block"></i>
                            <div class="text-center">
                                <div class="d-flex flex-column" style="gap: 10px;">
                                    <div style="background: #22c55e; color: white; padding: 10px; border-radius: 8px;">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        <span class="small font-weight-bold">Selesai (Ringan)</span>
                                    </div>
                                    <div style="background: #6366f1; color: white; padding: 10px; border-radius: 8px;">
                                        <i class="fas fa-arrow-circle-right mr-1"></i>
                                        <span class="small font-weight-bold">Rekomendasi BK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-lightbulb mr-2"></i>
                        <strong>Tips:</strong> Setiap notifikasi yang Anda terima menyertakan link langsung ke detail pengaduan. Klik link tersebut untuk langsung melihat dan memproses pengaduan.
                    </div>
                </div>
            </div>

            @endif

            {{-- ============================================== --}}
            {{-- BANTUAN UNTUK GURU BK --}}
            {{-- ============================================== --}}
            @if($user->role == 'guru_bk')
            
            <!-- Quick Start Guru BK -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #dcfce7; border-bottom: 1px solid #86efac;">
                    <h5 class="mb-0" style="color: #166534; font-weight: 600;">
                        <i class="fas fa-rocket mr-2"></i>Panduan Singkat Guru BK
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle mr-2"></i>
                        Sebagai Guru BK, Anda menangani kasus bullying yang direkomendasi oleh wali kelas. Proses tindak lanjut terdiri dari 3 tahap: Rencana → Proses → Selesai.
                    </div>
                    
                    <h6 class="font-weight-bold mt-4 mb-3">Tahapan Tindak Lanjut:</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100" style="border: 2px solid #3b82f6;">
                                <div class="card-body text-center">
                                    <div style="background: #3b82f6; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">1</span>
                                    </div>
                                    <h6 class="font-weight-bold text-primary">RENCANA</h6>
                                    <ul class="text-left small pl-3">
                                        <li>Pilih jenis tindakan</li>
                                        <li>Tulis deskripsi rencana</li>
                                        <li>Tentukan tanggal pelaksanaan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100" style="border: 2px solid #f59e0b;">
                                <div class="card-body text-center">
                                    <div style="background: #f59e0b; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">2</span>
                                    </div>
                                    <h6 class="font-weight-bold text-warning">PROSES</h6>
                                    <ul class="text-left small pl-3">
                                        <li>Catat pihak yang terlibat</li>
                                        <li>Dokumentasi proses</li>
                                        <li>Catat kendala (jika ada)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100" style="border: 2px solid #22c55e;">
                                <div class="card-body text-center">
                                    <div style="background: #22c55e; color: white; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                                        <span style="font-size: 20px; font-weight: bold;">3</span>
                                    </div>
                                    <h6 class="font-weight-bold text-success">SELESAI</h6>
                                    <ul class="text-left small pl-3">
                                        <li>Tulis hasil penanganan</li>
                                        <li>Buat evaluasi</li>
                                        <li>Berikan rekomendasi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Guru BK -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-question mr-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqGuruBK">
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqBK1">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Pengaduan mana yang muncul di data saya?</strong>
                                </button>
                            </div>
                            <div id="faqBK1" class="collapse" data-parent="#faqGuruBK">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Anda hanya melihat pengaduan yang sudah <strong>direkomendasi ke BK</strong> oleh wali kelas. Pengaduan yang masih ditangani wali kelas atau belum direkomendasikan tidak akan muncul di daftar Anda.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqBK2">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara membuat tindak lanjut baru?</strong>
                                </button>
                            </div>
                            <div id="faqBK2" class="collapse" data-parent="#faqGuruBK">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Data Pengaduan"</strong></li>
                                        <li>Klik tombol aksi pada pengaduan yang akan ditindaklanjuti</li>
                                        <li>Pilih pengaduan yang akan ditindaklanjuti</li>
                                        <li>Isi form rencana tindakan (Step 1)</li>
                                        <li>Klik <strong>"Simpan"</strong></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqBK3">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Apa saja jenis tindakan yang tersedia?</strong>
                                </button>
                            </div>
                            <div id="faqBK3" class="collapse" data-parent="#faqGuruBK">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ul>
                                        <li><strong>Pembinaan</strong> - Pembinaan karakter dan perilaku</li>
                                        <li><strong>Konseling</strong> - Konseling individual atau kelompok</li>
                                        <li><strong>Skorsing</strong> - Pemberian sanksi skorsing</li>
                                        <li><strong>Peringatan</strong> - Surat peringatan resmi</li>
                                        <li><strong>Lainnya</strong> - Tindakan lain sesuai kebutuhan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqBK4">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana jika proses terhambat kendala?</strong>
                                </button>
                            </div>
                            <div id="faqBK4" class="collapse" data-parent="#faqGuruBK">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>Dokumentasikan kendala di form Step 2 (Proses). Kolom <strong>"Kendala"</strong> disediakan untuk mencatat hambatan yang dihadapi selama penanganan. Ini penting untuk evaluasi dan laporan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            {{-- ============================================== --}}
            {{-- BANTUAN UNTUK ADMIN --}}
            {{-- ============================================== --}}
            @if($user->role == 'admin')
            
            <!-- Quick Start Admin -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #fee2e2; border-bottom: 1px solid #fca5a5;">
                    <h5 class="mb-0" style="color: #991b1b; font-weight: 600;">
                        <i class="fas fa-rocket mr-2"></i>Panduan Singkat Admin
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Sebagai Admin, Anda memiliki akses penuh ke sistem termasuk verifikasi pengaduan, manajemen data master, dan generate laporan.
                    </div>
                    
                    <h6 class="font-weight-bold mt-4 mb-3">Tugas Utama Admin:</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 text-center" style="border: 2px solid #ef4444;">
                                <div class="card-body">
                                    <i class="fas fa-check-double fa-3x text-danger mb-3"></i>
                                    <h6 class="font-weight-bold">Verifikasi Pengaduan</h6>
                                    <p class="small text-muted mb-0">Setujui atau tolak pengaduan yang masuk</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 text-center" style="border: 2px solid #3b82f6;">
                                <div class="card-body">
                                    <i class="fas fa-users-cog fa-3x text-primary mb-3"></i>
                                    <h6 class="font-weight-bold">Manajemen User</h6>
                                    <p class="small text-muted mb-0">Kelola data siswa, guru BK, wali kelas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 text-center" style="border: 2px solid #f59e0b;">
                                <div class="card-body">
                                    <i class="fas fa-file-pdf fa-3x text-warning mb-3"></i>
                                    <h6 class="font-weight-bold">Generate Laporan</h6>
                                    <p class="small text-muted mb-0">Cetak laporan PDF pengaduan & data master</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Admin -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-question mr-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAdmin">
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqA1">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara verifikasi pengaduan?</strong>
                                </button>
                            </div>
                            <div id="faqA1" class="collapse" data-parent="#faqAdmin">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Data Pengaduan"</strong> atau <strong>"Notifikasi"</strong></li>
                                        <li>Klik pengaduan dengan status <span class="badge badge-warning">Menunggu</span></li>
                                        <li>Review detail pengaduan</li>
                                        <li>Klik <strong>"Setujui"</strong> jika valid, atau <strong>"Tolak"</strong> dengan alasan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqA2">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>User mana yang tidak bisa dihapus?</strong>
                                </button>
                            </div>
                            <div id="faqA2" class="collapse" data-parent="#faqAdmin">
                                <div class="card-body" style="background: #f8fafc;">
                                    <p>User dengan role <strong>Admin</strong> dan <strong>Kepala Sekolah</strong> bersifat permanen dan tidak dapat dihapus. Ini untuk menjaga keamanan sistem.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-2" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="card-header p-0" style="background: white;">
                                <button class="btn btn-link btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#faqA3">
                                    <i class="fas fa-chevron-right mr-2 text-primary"></i>
                                    <strong>Bagaimana cara generate laporan?</strong>
                                </button>
                            </div>
                            <div id="faqA3" class="collapse" data-parent="#faqAdmin">
                                <div class="card-body" style="background: #f8fafc;">
                                    <ol>
                                        <li>Buka menu <strong>"Laporan"</strong></li>
                                        <li>Pilih jenis laporan yang diinginkan</li>
                                        <li>Filter berdasarkan periode jika diperlukan</li>
                                        <li>Klik <strong>"Download PDF"</strong> atau <strong>"Cetak"</strong></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            {{-- ============================================== --}}
            {{-- BANTUAN UNTUK KEPALA SEKOLAH --}}
            {{-- ============================================== --}}
            @if($user->role == 'kepala_sekolah')
            
            <!-- Quick Start Kepala Sekolah -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f3e8ff; border-bottom: 1px solid #d8b4fe;">
                    <h5 class="mb-0" style="color: #6b21a8; font-weight: 600;">
                        <i class="fas fa-rocket mr-2"></i>Panduan Singkat Kepala Sekolah
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert" style="background: #f3e8ff; border: 1px solid #d8b4fe; color: #6b21a8;">
                        <i class="fas fa-crown mr-2"></i>
                        Sebagai Kepala Sekolah, Anda memiliki akses untuk monitoring dan melihat laporan keseluruhan penanganan kasus bullying di sekolah.
                    </div>
                    
                    <h6 class="font-weight-bold mt-4 mb-3">Fitur yang Tersedia:</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 2px solid #a855f7;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-tachometer-alt fa-2x text-purple mr-3" style="color: #a855f7;"></i>
                                        <h6 class="font-weight-bold mb-0">Dashboard Monitoring</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Lihat statistik keseluruhan: total pengaduan, yang sedang diproses, selesai, dan ditolak.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100" style="border: 2px solid #a855f7;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-file-alt fa-2x text-purple mr-3" style="color: #a855f7;"></i>
                                        <h6 class="font-weight-bold mb-0">Laporan PDF</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Download laporan tahunan, bulanan, pengaduan, tindak lanjut, dan data master.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panduan Laporan -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-file-pdf mr-2"></i>Jenis Laporan yang Tersedia
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background: #f3e8ff;">
                                <tr>
                                    <th>Laporan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-calendar-alt text-primary mr-2"></i>Laporan Tahunan</td>
                                    <td>Rekapitulasi pengaduan per tahun</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-calendar text-info mr-2"></i>Laporan Bulanan</td>
                                    <td>Rekapitulasi pengaduan per bulan</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-folder-open text-warning mr-2"></i>Laporan Pengaduan</td>
                                    <td>Daftar lengkap semua pengaduan</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-tasks text-success mr-2"></i>Laporan Tindak Lanjut</td>
                                    <td>Daftar tindak lanjut dan hasilnya</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-user-graduate text-secondary mr-2"></i>Laporan Data Siswa</td>
                                    <td>Daftar siswa terdaftar di sistem</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-chalkboard-teacher text-dark mr-2"></i>Laporan Data Guru</td>
                                    <td>Daftar guru terdaftar di sistem</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @endif

            {{-- ============================================== --}}
            {{-- KONTAK BANTUAN (UNTUK SEMUA ROLE) --}}
            {{-- ============================================== --}}
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                <div class="card-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="mb-0" style="color: #1e40af; font-weight: 600;">
                        <i class="fas fa-headset mr-2"></i>Butuh Bantuan Lebih Lanjut?
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-center p-4" style="background: #eff6ff; border-radius: 10px; height: 100%; min-height: 220px; display: flex; flex-direction: column; justify-content: center;">
                                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                                <h6 class="font-weight-bold">Email Bantuan</h6>
                                <p class="mb-0" style="font-size: 14px;">sistempengaduanbullying@gmail.com<br><span class="text-muted small">(Respon 1x24 jam kerja)</span></p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center p-4" style="background: #fef9c3; border-radius: 10px; height: 100%; min-height: 220px; display: flex; flex-direction: column; justify-content: center;">
                                <i class="fas fa-phone-alt fa-3x text-warning mb-3"></i>
                                <h6 class="font-weight-bold">Telepon Sekolah</h6>
                                <p class="mb-0">(0265) - 655621<br><span class="text-muted small">Senin - Jum'at Jam 07.00-15.30</span></p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center p-4" style="background: #fef3c7; border-radius: 10px; height: 100%; min-height: 220px; display: flex; flex-direction: column; justify-content: center;">
                                <i class="fas fa-school fa-3x text-warning mb-3"></i>
                                <h6 class="font-weight-bold">Ruang BK</h6>
                                <p class="mb-0">Sekolah SMKN 1 Padaherang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion .btn-link {
        color: #1a1a1a;
        text-decoration: none;
    }
    .accordion .btn-link:hover {
        color: #3b82f6;
        text-decoration: none;
    }
    .accordion .btn-link:focus {
        text-decoration: none;
        box-shadow: none;
    }
    .collapse.show + .card-header .fa-chevron-right {
        transform: rotate(90deg);
    }
</style>
@endsection
