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
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Buat Pengaduan</h2>
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
                    <form method="POST" action="{{ route('buat-pengaduan.store') }}" enctype="multipart/form-data" id="pengaduanForm" onsubmit="handleSubmit(event)">
                        @csrf
                        
                        <!-- Anda Melapor Sebagai -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a;">Anda Melapor Sebagai <span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg @error('report_type') is-invalid @enderror" name="report_type" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                <option value="">Pilih jenis pelapor</option>
                                <option value="korban" {{ old('report_type') == 'korban' ? 'selected' : '' }}>Korban</option>
                                <option value="teman_korban" {{ old('report_type') == 'teman_korban' ? 'selected' : '' }}>Teman Korban</option>
                                <option value="orang_tua" {{ old('report_type') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="guru" {{ old('report_type') == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="lainnya" {{ old('report_type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('report_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Data Pelapor Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelapor</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="reporter_name" class="form-control form-control-lg @error('reporter_name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('reporter_name') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('reporter_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="reporter_class" class="form-control form-control-lg @error('reporter_class') is-invalid @enderror" placeholder="Contoh: XII PPLG B" value="{{ old('reporter_class') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('reporter_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Data Korban Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Korban</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Korban <span class="text-danger">*</span></label>
                                <input type="text" name="victim_name" class="form-control form-control-lg @error('victim_name') is-invalid @enderror" placeholder="Nama korban bullying" value="{{ old('victim_name') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('victim_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Korban <span class="text-danger">*</span></label>
                                <input type="text" name="victim_class" class="form-control form-control-lg @error('victim_class') is-invalid @enderror" placeholder="Contoh: XII PPLG B" value="{{ old('victim_class') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('victim_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Data Pelaku Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Data Pelaku</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Pelaku <span class="text-danger">*</span></label>
                                <input type="text" name="perpetrator_name" class="form-control form-control-lg @error('perpetrator_name') is-invalid @enderror" placeholder="Nama pelaku bullying" value="{{ old('perpetrator_name') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('perpetrator_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Kelas Pelaku <span class="text-danger">*</span></label>
                                <input type="text" name="perpetrator_class" class="form-control form-control-lg @error('perpetrator_class') is-invalid @enderror" placeholder="Contoh: XII PPLG B" value="{{ old('perpetrator_class') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('perpetrator_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Detail Kejadian Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Detail Kejadian</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Tanggal Kejadian <span class="text-danger">*</span></label>
                                <input type="date" name="incident_date" class="form-control form-control-lg @error('incident_date') is-invalid @enderror" value="{{ old('incident_date') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('incident_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Waktu Kejadian</label>
                                <input type="time" name="incident_time" class="form-control form-control-lg @error('incident_time') is-invalid @enderror" value="{{ old('incident_time') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('incident_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Lokasi Kejadian <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control form-control-lg @error('location') is-invalid @enderror" placeholder="Contoh: Kantin sekolah, Kelas XII PPLG B, Toilet lantai 2" value="{{ old('location') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Jenis Bullying <span class="text-danger">*</span></label>
                                <select name="bullying_type" class="form-control form-control-lg @error('bullying_type') is-invalid @enderror" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                    <option value="">Pilih jenis bullying</option>
                                    <option value="fisik" {{ old('bullying_type') == 'fisik' ? 'selected' : '' }}>Fisik (Kekerasan/Pukulan)</option>
                                    <option value="verbal" {{ old('bullying_type') == 'verbal' ? 'selected' : '' }}>Verbal (Ejekan/Umpatan)</option>
                                    <option value="cyber" {{ old('bullying_type') == 'cyber' ? 'selected' : '' }}>Cyber (Media Sosial/Chat)</option>
                                    <option value="pengucilan" {{ old('bullying_type') == 'pengucilan' ? 'selected' : '' }}>Pengucilan</option>
                                    <option value="intimidasi" {{ old('bullying_type') == 'intimidasi' ? 'selected' : '' }}>Intimidasi</option>
                                    <option value="lainnya" {{ old('bullying_type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('bullying_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Deskripsi Kejadian <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Jelaskan kronologi kejadian secara detail. Apa yang terjadi? Bagaimana pelaku melakukannya? Dampak apa yang dirasakan korban?" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('description') }}</textarea>
                                <small class="text-muted d-block mt-2">Semakin detail informasi yang Anda berikan, semakin baik kami dapat menangani kasus ini.</small>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Saksi Mata Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Saksi Mata (Jika Ada)</h5>
                            <div class="form-group">
                                <label class="form-label">Nama saksi yang melihat kejadian (opsional)</label>
                                <input type="text" name="witnesses" class="form-control form-control-lg @error('witnesses') is-invalid @enderror" placeholder="Nama saksi yang melihat kejadian (opsional)" value="{{ old('witnesses') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('witnesses') <span class="text-danger">{{ $message }}</span> @enderror
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
                            @error('urgency') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
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
                            @error('attachment') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
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
                                <button type="button" id="draftBtn" onclick="saveDraft()" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-save"></i> Simpan Draft
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="submitBtn" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-paper-plane"></i> Kirim Pengaduan
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

    .upload-area:hover {
        border-color: #4A7AB5 !important;
        background: #F9F9F9;
    }

    .btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .fw-600 {
        font-weight: 600;
    }

    .fw-500 {
        font-weight: 500;
    }

    @keyframes slideIn {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
</style>

<script>
// ✅ HANDLE SUBMIT FORM (DENGAN LOADING)
function handleSubmit(event) {
    event.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const draftBtn = document.getElementById('draftBtn');
    const form = document.getElementById('pengaduanForm');
    
    // Simpan teks asli
    const originalText = submitBtn.innerHTML;
    
    // Tampilkan loading
    submitBtn.disabled = true;
    draftBtn.disabled = true; // Disable draft button juga
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    
    // Submit form
    form.submit();
}

// ✅ FUNGSI SIMPAN DRAFT
function saveDraft() {
    const form = document.getElementById('pengaduanForm');
    const formData = new FormData(form);
    
    // Ambil tombol
    const draftBtn = document.getElementById('draftBtn');
    const submitBtn = document.getElementById('submitBtn');
    const originalText = draftBtn.innerHTML;
    
    // Tampilkan loading
    draftBtn.disabled = true;
    submitBtn.disabled = true;
    draftBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    
    fetch('{{ route('simpan-draft') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Draft berhasil disimpan!', 'success');
            setTimeout(() => {
                window.location.href = '{{ route('draf-pengaduan') }}';
            }, 1000);
        } else {
            showNotification(data.message || 'Gagal menyimpan draft', 'error');
            draftBtn.disabled = false;
            submitBtn.disabled = false;
            draftBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan draft', 'error');
        draftBtn.disabled = false;
        submitBtn.disabled = false;
        draftBtn.innerHTML = originalText;
    });
}

// ✅ FUNGSI NOTIFIKASI
function showNotification(message, type = 'success') {
    const bgColor = type === 'success' ? '#10b981' : '#ef4444';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    `;
    notification.innerHTML = `<i class="fas fa-${icon}"></i><span>${message}</span>`;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ✅ FUNGSI FILE UPLOAD
document.getElementById('fileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const uploadArea = document.querySelector('.upload-area');
    
    if (file) {
        const maxSize = 10 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 10MB');
            this.value = '';
            return;
        }
        
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'video/mp4'];
        if (!allowedTypes.includes(file.type)) {
            alert('Tipe file tidak didukung! Hanya PNG, JPG, dan MP4');
            this.value = '';
            return;
        }
        
        uploadArea.innerHTML = `
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="font-size: 48px; color: #4CAF50; margin-bottom: 16px; display: block;"></i>
                <div style="font-weight: 500; color: #4CAF50; margin-bottom: 8px;">File Berhasil Dipilih</div>
                <div style="font-size: 13px; color: #666; margin-bottom: 12px;">${file.name}</div>
                <button type="button" onclick="resetFileUpload()" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-times"></i> Hapus
                </button>
            </div>
        `;
    }
});

// ✅ FUNGSI PILIH URGENSI
function selectUrgency(element, value) {
    document.querySelectorAll('.urgency-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    element.classList.add('selected');
    document.getElementById('urgency-value').value = value;
}

// ✅ FUNGSI RESET UPLOAD
function resetFileUpload() {
    const fileInput = document.getElementById('fileInput');
    const uploadArea = document.querySelector('.upload-area');
    
    fileInput.value = '';
    uploadArea.innerHTML = `
        <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #999; margin-bottom: 16px; display: block;"></i>
        <div style="font-weight: 500; color: #4A7AB5; margin-bottom: 8px;">Pilih File</div>
        <div style="font-size: 13px; color: #666;">PNG, JPG, MP4 maksimal 10MB</div>
    `;
    uploadArea.onclick = () => fileInput.click();
}
</script>
@endsection