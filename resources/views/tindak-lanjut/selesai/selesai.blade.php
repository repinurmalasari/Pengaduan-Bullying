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
                    
                    <!-- Active Line Progress - Hijau dari step 1 sampai tengah step 3 -->
                    <div style="position: absolute; top: 20px; left: 0; width: 50%; height: 3px; background: #10b981; z-index: 1;"></div>
                    
                    <!-- Step 1 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
                    </div>
                    
                    <!-- Step 2 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
                    </div>
                    
                    <!-- Step 3 - Active (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            3
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section (Green Gradient) -->
                <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Selesaikan Tindak Lanjut</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Catat hasil dan selesaikan tindakan</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Ringkasan Tindakan (READ ONLY - Background Hijau Muda) -->
                    <div class="mb-4" style="background: #d1fae5; padding: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-list-check" style="color: #10b981;"></i> Ringkasan Tindakan
                        </h6>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Tindakan</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ ucfirst($tindakLanjut->jenis_tindakan) }}</p>
                            </div>

                            <div>
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Rencana</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_tindakan->format('d-m-Y') }}</p>
                            </div>
                        </div>

                        @if($tindakLanjut->tanggal_mulai_proses)
                        <div style="margin-bottom: 16px;">
                            <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Mulai Proses</p>
                            <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->tanggal_mulai_proses->format('d-m-Y') }}</p>
                        </div>
                        @endif

                        @if($tindakLanjut->pihak_terlibat)
                        <div style="margin-bottom: 16px;">
                            <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pihak yang Terlibat</p>
                            <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $tindakLanjut->pihak_terlibat }}</p>
                        </div>
                        @endif

                        <div style="margin-bottom: 16px;">
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Catatan Proses</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->catatan_proses ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk Selesaikan -->
                    <form method="POST" action="{{ route('tindak-lanjut.update-selesai', $tindakLanjut->id) }}" id="form-selesaikan">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Tanggal Selesai -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_selesai" class="form-control form-control-lg @error('tanggal_selesai') is-invalid @enderror" required value="{{ old('tanggal_selesai', now()->format('Y-m-d')) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            @error('tanggal_selesai') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Hasil Tindakan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Hasil Tindakan <span class="text-danger">*</span></label>
                            <textarea name="hasil" class="form-control @error('hasil') is-invalid @enderror" rows="5" required placeholder="Jelaskan hasil dari tindakan yang telah dilakukan secara detail..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('hasil') }}</textarea>
                            @error('hasil') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Evaluasi -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Evaluasi</label>
                            <textarea name="evaluasi" class="form-control @error('evaluasi') is-invalid @enderror" rows="4" placeholder="Berikan evaluasi terhadap tindakan yang telah dilakukan..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('evaluasi') }}</textarea>
                            <small class="text-muted">Opsional - Evaluasi efektivitas tindakan dan saran perbaikan</small>
                            @error('evaluasi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status Hasil - Dropdown Style -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px; display: block;">
                                Status Hasil <span class="text-danger">*</span>
                            </label>
                            <select name="status_hasil" class="form-select @error('status_hasil') is-invalid @enderror" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px; width: 100%; display: block;">
                                <option value="">-- Pilih Status Hasil --</option>
                                <option value="berhasil" {{ old('status_hasil') == 'berhasil' ? 'selected' : '' }}> Berhasil - Tindakan berhasil sepenuhnya</option>
                                <option value="cukup_berhasil" {{ old('status_hasil') == 'cukup_berhasil' ? 'selected' : '' }}> Cukup Berhasil - Ada hasil tapi perlu perbaikan</option>
                                <option value="perlu_tindak_lanjut" {{ old('status_hasil') == 'perlu_tindak_lanjut' ? 'selected' : '' }}> Perlu Tindak Lanjut - Perlu tindakan tambahan</option>
                            </select>
                            @error('status_hasil') 
                                <span class="text-danger" style="font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> 
                            @enderror
                        </div>
                    </form>

                    <!-- Action Buttons -->
                    <div class="row g-3">
                        <!-- Button Kembali ke Proses -->
                        <div class="col-md-6">
                            <a href="{{ route('tindak-lanjut.edit-proses', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="border: 1px solid #f59e0b; color: #f59e0b; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <!-- Button Selesaikan -->
                        <div class="col-md-6">
                            <button type="submit" form="form-selesaikan" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 12px;">
                                <i class="fas fa-check-circle"></i> Selesaikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection