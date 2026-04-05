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
                            <i class="fas fa-edit" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Edit Pengaduan</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Ubah informasi pengaduan Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Form -->
                    <form method="POST" action="{{ route('buat-pengaduan.update', $pengaduan->id) }}" enctype="multipart/form-data" id="editPengaduanForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Anda Melapor Sebagai -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a;">Anda Melapor Sebagai <span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg @error('report_type') is-invalid @enderror" name="report_type" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                <option value="">Pilih jenis pelapor</option>
                                <option value="korban" {{ $pengaduan->report_type == 'korban' ? 'selected' : '' }}>Korban</option>
                                <option value="teman_korban" {{ $pengaduan->report_type == 'teman_korban' ? 'selected' : '' }}>Teman Korban</option>
                                <option value="orang_tua" {{ $pengaduan->report_type == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="guru" {{ $pengaduan->report_type == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="lainnya" {{ $pengaduan->report_type == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('report_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Data Pelapor Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelapor</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="reporter_name" class="form-control form-control-lg @error('reporter_name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('reporter_name', $pengaduan->reporter_name) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('reporter_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="reporter_class" class="form-control form-control-lg @error('reporter_class') is-invalid @enderror" placeholder="Contoh: 10 IPA 1" value="{{ old('reporter_class', $pengaduan->reporter_class) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('reporter_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Data Korban Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Korban</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Korban <span class="text-danger">*</span></label>
                                <input type="text" name="victim_name" class="form-control form-control-lg @error('victim_name') is-invalid @enderror" placeholder="Nama korban bullying" value="{{ old('victim_name', $pengaduan->victim_name) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('victim_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Korban <span class="text-danger">*</span></label>
                                <input type="text" name="victim_class" class="form-control form-control-lg @error('victim_class') is-invalid @enderror" placeholder="Contoh: 10 IPA 1" value="{{ old('victim_class', $pengaduan->victim_class) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('victim_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Data Pelaku Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelaku</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Pelaku <span class="text-danger">*</span></label>
                                <input type="text" name="perpetrator_name" class="form-control form-control-lg @error('perpetrator_name') is-invalid @enderror" placeholder="Nama pelaku bullying" value="{{ old('perpetrator_name', $pengaduan->perpetrator_name) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('perpetrator_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Pelaku <span class="text-danger">*</span></label>
                                <input type="text" name="perpetrator_class" class="form-control form-control-lg @error('perpetrator_class') is-invalid @enderror" placeholder="Contoh: 11 IPS 2" value="{{ old('perpetrator_class', $pengaduan->perpetrator_class) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('perpetrator_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Detail Kejadian Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Detail Kejadian</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Tanggal Kejadian <span class="text-danger">*</span></label>
                                <input type="date" name="incident_date" class="form-control form-control-lg @error('incident_date') is-invalid @enderror" value="{{ old('incident_date', $pengaduan->incident_date->format('Y-m-d')) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('incident_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Waktu Kejadian</label>
                                <input type="time" name="incident_time" class="form-control form-control-lg @error('incident_time') is-invalid @enderror" value="{{ old('incident_time', $pengaduan->incident_time ? \Carbon\Carbon::parse($pengaduan->incident_time)->format('H:i') : '') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('incident_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Lokasi Kejadian <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control form-control-lg @error('location') is-invalid @enderror" placeholder="Contoh: Kantin sekolah, Kelas 10-A, Toilet lantai 2" value="{{ old('location', $pengaduan->location) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Jenis Bullying <span class="text-danger">*</span></label>
                                <select name="bullying_type" class="form-control form-control-lg @error('bullying_type') is-invalid @enderror" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                    <option value="">Pilih jenis bullying</option>
                                    <option value="fisik" {{ $pengaduan->bullying_type == 'fisik' ? 'selected' : '' }}>Fisik (Kekerasan/Pukulan)</option>
                                    <option value="verbal" {{ $pengaduan->bullying_type == 'verbal' ? 'selected' : '' }}>Verbal (Ejekan/Umpatan)</option>
                                    <option value="cyber" {{ $pengaduan->bullying_type == 'cyber' ? 'selected' : '' }}>Cyber (Media Sosial/Chat)</option>
                                    <option value="pengucilan" {{ $pengaduan->bullying_type == 'pengucilan' ? 'selected' : '' }}>Pengucilan</option>
                                    <option value="intimidasi" {{ $pengaduan->bullying_type == 'intimidasi' ? 'selected' : '' }}>Intimidasi</option>
                                    <option value="lainnya" {{ $pengaduan->bullying_type == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('bullying_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Deskripsi Kejadian <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Jelaskan kronologi kejadian secara detail..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('description', $pengaduan->description) }}</textarea>
                                <small class="text-muted d-block mt-2">Semakin detail informasi yang Anda berikan, semakin baik kami dapat menangani kasus ini.</small>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Saksi Mata Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Saksi Mata (Jika Ada)</h5>
                            <div class="form-group">
                                <label class="form-label">Nama saksi yang melihat kejadian (opsional)</label>
                                <input type="text" name="witnesses" class="form-control form-control-lg @error('witnesses') is-invalid @enderror" placeholder="Nama saksi yang melihat kejadian (opsional)" value="{{ old('witnesses', $pengaduan->witnesses) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('witnesses') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tingkat Urgensi -->
                        <div class="mb-5">
                            <label class="form-label fw-500" style="color: #1a1a1a; display: block; margin-bottom: 16px;">Tingkat Urgensi <span class="text-danger">*</span></label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="urgency-option {{ $pengaduan->urgency == 'rendah' ? 'selected' : '' }}" onclick="selectUrgency(this, 'rendah')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Rendah</div>
                                        <div style="font-size: 13px; color: #666;">Tidak mendesak</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="urgency-option {{ $pengaduan->urgency == 'sedang' ? 'selected' : '' }}" onclick="selectUrgency(this, 'sedang')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Sedang</div>
                                        <div style="font-size: 13px; color: #666;">Perlu perhatian</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="urgency-option {{ $pengaduan->urgency == 'tinggi' ? 'selected' : '' }}" onclick="selectUrgency(this, 'tinggi')" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        <div style="font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">Tinggi</div>
                                        <div style="font-size: 13px; color: #666;">Segera ditangani</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="urgency-value" name="urgency" value="{{ $pengaduan->urgency }}">
                            @error('urgency') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
                        </div>

                        <!-- Lampiran Bukti Section -->
                        <div class="mb-5">
                            <label class="form-label fw-500" style="color: #1a1a1a; display: block; margin-bottom: 16px;">Lampiran Bukti (Foto/Video/Screenshot)</label>
                            
                            @if($pengaduan->attachment)
                            <!-- Preview Lampiran Yang Sudah Ada -->
                            <div id="existingAttachment" style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 12px; padding: 20px; margin-bottom: 16px;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center" style="gap: 12px;">
                                        <i class="fas fa-file-image" style="font-size: 32px; color: #4A7AB5;"></i>
                                        <div>
                                            <div style="font-weight: 500; color: #1a1a1a;">Lampiran Saat Ini</div>
                                            <div style="font-size: 13px; color: #666;">{{ basename($pengaduan->attachment) }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex" style="gap: 8px;">
                                        <a href="{{ $pengaduan->attachment_url }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <button type="button" onclick="removeExistingAttachment()" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="remove_attachment" id="remove_attachment" value="0">
                            @endif

                            <!-- Upload Area -->
                            <div class="upload-area" id="uploadArea" style="border: 2px dashed #ddd; border-radius: 12px; padding: 40px 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('fileInput').click();">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #999; margin-bottom: 16px; display: block;"></i>
                                <div style="font-weight: 500; color: #4A7AB5; margin-bottom: 8px;">Pilih File {{ $pengaduan->attachment ? 'Baru' : '' }}</div>
                                <div style="font-size: 13px; color: #666;">PNG, JPG, MP4 maksimal 10MB</div>
                            </div>
                            <input type="file" id="fileInput" name="attachment" style="display: none;" accept=".png,.jpg,.jpeg,.mp4">
                            @error('attachment') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <a href="{{ route('buat-pengaduan.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                    <i class="fas fa-times"></i>Batal
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500;">
                                    @if($pengaduan->status == 'ditolak')
                                        <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                                    @else
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
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

    .urgency-option:hover {
        border-color: #4A7AB5 !important;
        background: #F9F9F9;
    }

    .urgency-option.selected {
        background: white !important;
        border: 2px solid #4A7AB5 !important;
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
    // Fungsi untuk handle file upload
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const uploadArea = document.getElementById('uploadArea');
        
        if (file) {
            // Validasi ukuran file (max 10MB)
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar! Maksimal 10MB');
                this.value = '';
                return;
            }
            
            // Validasi tipe file
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'video/mp4'];
            if (!allowedTypes.includes(file.type)) {
                alert('Tipe file tidak didukung! Hanya PNG, JPG, dan MP4');
                this.value = '';
                return;
            }
            
            // Tampilkan preview file baru
            uploadArea.innerHTML = `
                <div style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 48px; color: #4CAF50; margin-bottom: 16px; display: block;"></i>
                    <div style="font-weight: 500; color: #4CAF50; margin-bottom: 8px;">File Baru Dipilih</div>
                    <div style="font-size: 13px; color: #666; margin-bottom: 12px;">${file.name}</div>
                    <button type="button" onclick="resetFileUpload()" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-times"></i> Batalkan
                    </button>
                </div>
            `;
        }
    });

    // Fungsi untuk memilih tingkat urgensi
    function selectUrgency(element, value) {
        document.querySelectorAll('.urgency-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        element.classList.add('selected');
        document.getElementById('urgency-value').value = value;
    }

    // Fungsi untuk reset upload
    function resetFileUpload() {
        const fileInput = document.getElementById('fileInput');
        const uploadArea = document.getElementById('uploadArea');
        const existingAttachment = document.getElementById('existingAttachment');
        
        fileInput.value = '';
        uploadArea.innerHTML = `
            <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #999; margin-bottom: 16px; display: block;"></i>
            <div style="font-weight: 500; color: #4A7AB5; margin-bottom: 8px;">Pilih File Baru</div>
            <div style="font-size: 13px; color: #666;">PNG, JPG, MP4 maksimal 10MB</div>
        `;
        uploadArea.onclick = () => fileInput.click();
        
        // Tampilkan kembali existing attachment jika ada dan reset remove_attachment
        if (existingAttachment) {
            existingAttachment.style.display = 'block';
            document.getElementById('remove_attachment').value = '0';
        }
    }

    // Fungsi untuk hapus lampiran yang sudah ada
    function removeExistingAttachment() {
        if (confirm('Apakah Anda yakin ingin menghapus lampiran ini?')) {
            document.getElementById('existingAttachment').style.display = 'none';
            document.getElementById('remove_attachment').value = '1';
        }
    }
</script>
@endsection