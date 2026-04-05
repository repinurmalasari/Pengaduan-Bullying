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
                            <i class="fas fa-shield-alt" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Buat Laporan</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Laporkan dengan aman dan terjaga kerahasiaannya</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Info Box -->
                    <div style="background: #E3F2FD; border-left: 4px solid #4A7AB5; padding: 16px 20px; border-radius: 8px; margin-bottom: 32px;">
                        <div style="color: #4A7AB5; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-lock"></i>
                            <span style="font-size: 14px; font-weight: 500;">Laporan Anda akan dijaga kerahasiaannya</span>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Anda Melapor Sebagai -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a;">Anda Melapor Sebagai <span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                <option>Pilih jenis pelapor</option>
                                <option>Korban</option>
                                <option>Teman Korban</option>
                                <option>Orang Tua</option>
                                <option>Guru</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <!-- Data Pelapor Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelapor</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Contoh: 10 IPA 1" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>
                        </div>

                        <!-- Data Korban Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Korban</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Korban <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Nama korban bullying" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Korban <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Contoh: 10 IPA 1" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>
                        </div>

                        <!-- Data Pelaku Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelaku</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Pelaku <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Nama pelaku bullying" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Pelaku <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Contoh: 11 IPS 2" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>
                        </div>

                        <!-- Detail Kejadian Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Detail Kejadian</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Tanggal Kejadian <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Waktu Kejadian</label>
                                <input type="time" class="form-control form-control-lg" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Lokasi Kejadian <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Contoh: Kantin sekolah, Kelas 10-A, Toilet lantai 2" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Jenis Bullying <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                    <option>Pilih jenis bullying</option>
                                    <option>Fisik (Kekerasan/Pukulan)</option>
                                    <option>Verbal (Ejekan/Umpatan)</option>
                                    <option>Cyber (Media Sosial/Chat)</option>
                                    <option>Pengucilan</option>
                                    <option>Intimidasi</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Deskripsi Kejadian <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="6" placeholder="Jelaskan kronologi kejadian secara detail. Apa yang terjadi? Bagaimana pelaku melakukannya? Dampak apa yang dirasakan korban?" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;"></textarea>
                                <small class="text-muted d-block mt-2">Semakin detail informasi yang Anda berikan, semakin baik kami dapat menangani kasus ini.</small>
                            </div>
                        </div>

                        <!-- Saksi Mata Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Saksi Mata (Jika Ada)</h5>
                            <div class="form-group">
                                <label class="form-label">Nama saksi yang melihat kejadian (opsional)</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Nama saksi yang melihat kejadian (opsional)" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>
                        </div>

                        <!-- Tingkat Urgensi -->
                        <div class="mb-5">
                            <label class="form-label fw-500" style="color: #1a1a1a; display: block; margin-bottom: 16px;">Tingkat Urgensi <span class="text-danger">*</span></label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="urgency-option" onclick="selectUrgency(this, 'rendah')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Rendah</div>
                                        <div style="font-size: 13px; color: #666;">Tidak mendesak</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="urgency-option" onclick="selectUrgency(this, 'sedang')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Sedang</div>
                                        <div style="font-size: 13px; color: #666;">Perlu perhatian</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="urgency-option" onclick="selectUrgency(this, 'tinggi')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Tinggi</div>
                                        <div style="font-size: 13px; color: #666;">Segera ditangani</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="urgency-value" name="urgency" value="">
                        </div>

                        <!-- Lampiran Bukti -->
                        <div class="mb-5">
                            <label class="form-label fw-500" style="color: #1a1a1a; display: block; margin-bottom: 16px;">Lampiran Bukti (Foto/Video/Screenshot)</label>
                            <div class="upload-area" style="border: 2px dashed #ddd; border-radius: 12px; padding: 40px 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('fileInput').click();">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #999; margin-bottom: 16px; display: block;"></i>
                                <div style="font-weight: 500; color: #4A7AB5; margin-bottom: 8px;">Pilih File</div>
                                <div style="font-size: 13px; color: #666;">PNG, JPG, MP4 maksimal 10MB</div>
                            </div>
                            <input type="file" id="fileInput" name="attachment" style="display: none;" accept=".png,.jpg,.jpeg,.mp4">
                        </div>

                        <!-- Warning Message -->
                        <div style="background: #FFF3E0; border-left: 4px solid #FF9800; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                <i class="fas fa-exclamation-triangle" style="color: #FF9800; flex-shrink: 0; margin-top: 2px;"></i>
                                <div style="font-size: 13px;">
                                    <div style="font-weight: 600; color: #FF9800; margin-bottom: 4px;">Peringatan Penting</div>
                                    <div style="color: #555;">Memberikan laporan palsu adalah tindakan serius dan dapat dikenakan sanksi. Pastikan semua informasi yang Anda berikan adalah benar dan akurat.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;">
                                    Simpan Draft
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-paper-plane"></i> Kirim Laporan
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Help Section -->
                    <div class="help-section" style="background: #F5F5F5; padding: 30px; border-radius: 12px; margin-top: 40px;">
                        <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 24px;">Butuh Bantuan Segera?</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #4A7AB5;">
                                    <div style="font-weight: 600; color: #4A7AB5; margin-bottom: 8px;">Konseling BK</div>
                                    <div style="color: #666; font-size: 13px;">Hubungi: <span style="font-weight: 500; color: #4A7AB5;">(021) 1234-5678</span></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #4A7AB5;">
                                    <div style="font-weight: 600; color: #4A7AB5; margin-bottom: 8px;">Hotline Darurat</div>
                                    <div style="color: #666; font-size: 13px;">24/7: <span style="font-weight: 500; color: #4A7AB5;">0800-123-4567</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-size: 14px;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .form-control-lg {
        font-size: 14px;
        height: auto;
    }

    .form-control:focus {
        border-color: #4A7AB5;
        box-shadow: 0 0 0 0.2rem rgba(74, 122, 181, 0.25);
    }

    .form-control::placeholder {
        color: #999;
    }

    .urgency-option:hover {
        border-color: #4A7AB5 !important;
        background: #F9F9F9;
    }

    .urgency-option.selected {
        background: white !important;
        border: 2px solid #4A7AB5 !important;
    }

    .urgency-option.selected .urgency-title {
        color: #4A7AB5;
    }

    .upload-area:hover {
        border-color: #4A7AB5 !important;
        background: #F9F9F9;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .fw-600 {
        font-weight: 600;
    }

    .fw-500 {
        font-weight: 500;
    }
</style>

<script>
    function selectUrgency(element, value) {
        // Remove active class from all options
        document.querySelectorAll('.urgency-option').forEach(el => {
            el.classList.remove('selected');
            el.style.borderColor = '#ddd';
            el.style.background = 'white';
        });
        
        // Add active class to clicked element
        element.classList.add('selected');
        element.style.borderColor = '#4A7AB5';
        element.style.background = '#F9F9F9';
        
        // Set hidden input value
        document.getElementById('urgency-value').value = value;
    }
</script>
@endsection