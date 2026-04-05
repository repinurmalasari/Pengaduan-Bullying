@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            
          <!-- Progress Steps -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center" style="position: relative;">
        <!-- Line Background -->
        <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background: #e0e0e0; z-index: 1;"></div>
        
        <!-- Active Line Progress - Sesuai Status -->
        @if($tindakLanjut->status === 'direncanakan')
            <!-- Hanya hijau sampai step 1 -->
            <div style="position: absolute; top: 20px; left: 0; width: 16.67%; height: 3px; background: #10b981; z-index: 1;"></div>
        @elseif($tindakLanjut->status === 'diproses')
            <!-- Hijau sampai step 1, Orange sampai step 2 -->
            <div style="position: absolute; top: 20px; left: 0; width: 16.67%; height: 3px; background: #10b981; z-index: 1;"></div>
            <div style="position: absolute; top: 20px; left: 16.67%; width: 33.33%; height: 3px; background: #f59e0b; z-index: 1;"></div>
        @else
            <!-- Hijau sampai step 3 (selesai) -->
            <div style="position: absolute; top: 20px; left: 0; width: 100%; height: 3px; background: #10b981; z-index: 1;"></div>
        @endif
        
        <!-- Step 1 - Direncanakan -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                <i class="fas fa-check"></i>
            </div>
            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
        </div>
        
        <!-- Step 2 - Proses -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            @if($tindakLanjut->status === 'diproses')
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">2</div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #f59e0b;">Proses</p>
            @elseif($tindakLanjut->status === 'selesai')
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                    <i class="fas fa-check"></i>
                </div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
            @else
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">2</div>
                <p style="margin-top: 8px; font-size: 12px; color: #999;">Proses</p>
            @endif
        </div>
        
        <!-- Step 3 - Selesai -->
        <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
            @if($tindakLanjut->status === 'selesai')
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                    <i class="fas fa-check"></i>
                </div>
                <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Selesai</p>
            @else
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">3</div>
                <p style="margin-top: 8px; font-size: 12px; color: #999;">Selesai</p>
            @endif
        </div>
    </div>
</div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-edit" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Edit Direncanakan</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Ubah rencana tindakan untuk kasus pengaduan</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Form -->
                    <form method="POST" action="{{ route('tindak-lanjut.update', $tindakLanjut->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="pengaduan_id" value="{{ $tindakLanjut->pengaduan_id }}">
                        
                        <!-- Info Pengaduan -->
                        <div class="mb-4" style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                            <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                                <i class="fas fa-info-circle" style="color: #4B7EC4;"></i> Informasi Pengaduan
                            </h6>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->nomor_laporan }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Kejadian</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->incident_date->format('d-m-Y') }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelapor</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->reporter_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->victim_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->perpetrator_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Bullying</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->bullying_type }}</p>
                                </div>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Lokasi</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pengaduan->location }}</p>
                            </div>

                            <div>
                                <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi</p>
                                <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->pengaduan->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Rencana Tindakan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Tanggal Rencana Tindakan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_tindakan" class="form-control form-control-lg @error('tanggal_tindakan') is-invalid @enderror" required value="{{ $tindakLanjut->tanggal_tindakan->format('Y-m-d') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            @error('tanggal_tindakan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Jenis Tindakan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Jenis Tindakan <span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg @error('jenis_tindakan') is-invalid @enderror" name="jenis_tindakan" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                <option value="">-- Pilih Jenis Tindakan --</option>
                                <option value="pembinaan" {{ $tindakLanjut->jenis_tindakan == 'pembinaan' ? 'selected' : '' }}>Pembinaan</option>
                                <option value="konseling" {{ $tindakLanjut->jenis_tindakan == 'konseling' ? 'selected' : '' }}>Konseling</option>
                                <option value="skorsing" {{ $tindakLanjut->jenis_tindakan == 'skorsing' ? 'selected' : '' }}>Skorsing</option>
                                <option value="peringatan" {{ $tindakLanjut->jenis_tindakan == 'peringatan' ? 'selected' : '' }}>Peringatan</option>
                                <option value="lainnya" {{ $tindakLanjut->jenis_tindakan == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_tindakan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Deskripsi Rencana -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Deskripsi Rencana Tindakan <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required placeholder="Jelaskan rencana tindakan yang akan dilakukan..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ $tindakLanjut->deskripsi }}</textarea>
                            @error('deskripsi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Hidden input untuk status agar tetap tersimpan saat update -->
                        <input type="hidden" name="status" value="{{ $tindakLanjut->status }}">

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <!-- Tombol Batal -->
                            <div class="col-md-4">
                                <a href="{{ route('tindak-lanjut.index') }}" 
                                    class="btn btn-lg w-100" 
                                    style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
    
                            <!-- Tombol Simpan Perubahan -->
                            <div class="col-md-4">
                                <button type="submit" 
                                        class="btn btn-lg w-100" 
                                        style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                         Simpan Perubahan
                                </button>
                            </div>
    
                            <!-- Tombol Lanjut Proses / Edit Proses -->
                            <div class="col-md-4">
                                @if($tindakLanjut->status === 'diproses' || $tindakLanjut->status === 'selesai')
                                    <!-- Jika sudah diproses atau selesai, tampilkan Edit Proses -->
                                    <a href="{{ route('tindak-lanjut.edit-proses', $tindakLanjut->id) }}" 
                                       class="btn btn-lg w-100" 
                                       style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; text-decoration: none; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-edit"></i> Edit Proses
                                    </a>
                                @else
                                    <!-- Jika masih direncanakan, tampilkan Lanjut Proses -->
                                    <a href="{{ route('tindak-lanjut.proses', $tindakLanjut->id) }}" 
                                       class="btn btn-lg w-100" 
                                       style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; text-decoration: none; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-arrow-right"></i> Lanjut Proses
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection