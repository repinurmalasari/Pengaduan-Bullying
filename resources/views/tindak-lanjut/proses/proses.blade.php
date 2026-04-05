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
                    
                    <!-- Active Line Progress - Garis Hijau sampai step 1, Orange dari step 1 ke step 2 -->
                    <div style="position: absolute; top: 20px; left: 0; width: 16.67%; height: 3px; background: #10b981; z-index: 1;"></div>
                    <div style="position: absolute; top: 20px; left: 16.67%; width: 33.33%; height: 3px; background: #f59e0b; z-index: 1;"></div>
                    
                    <!-- Step 1 - Completed (Hijau dengan icon check) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
                    </div>
                    
                    <!-- Step 2 - Active (Orange) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">2</div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #f59e0b;">Proses</p>
                    </div>
                    
                    <!-- Step 3 - Pending (Abu-abu) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">3</div>
                        <p style="margin-top: 8px; font-size: 12px; color: #999;">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section (Orange Gradient) -->
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tasks" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Proses Tindak Lanjut</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Lakukan tindakan sesuai rencana yang telah dibuat</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Rencana Tindakan (READ ONLY - Background Orange Muda) -->
                    <div class="mb-4" style="background: #fff7ed; padding: 20px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                            <i class="fas fa-clipboard-list" style="color: #f59e0b;"></i> Rencana Tindakan
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

                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi Rencana</p>
                            <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $tindakLanjut->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk Simpan Proses -->
                    <form method="POST" action="{{ route('tindak-lanjut.update-proses', $tindakLanjut->id) }}" id="form-simpan-proses">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Tanggal Mulai Proses -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Tanggal Mulai Proses <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_mulai_proses" class="form-control form-control-lg @error('tanggal_mulai_proses') is-invalid @enderror" required value="{{ old('tanggal_mulai_proses', now()->format('Y-m-d')) }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            @error('tanggal_mulai_proses') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pihak Terlibat (Optional) -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Pihak yang Terlibat</label>
                            <input type="text" name="pihak_terlibat" class="form-control form-control-lg @error('pihak_terlibat') is-invalid @enderror" value="{{ old('pihak_terlibat') }}" placeholder="Contoh: Guru BK, Orang Tua, Wali Kelas" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            <small class="text-muted">Pisahkan dengan koma jika lebih dari satu</small>
                            @error('pihak_terlibat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Catatan Proses -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Catatan Proses <span class="text-danger">*</span></label>
                            <textarea name="catatan_proses" class="form-control @error('catatan_proses') is-invalid @enderror" rows="5" required placeholder="Jelaskan proses yang akan dilakukan..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('catatan_proses') }}</textarea>
                            @error('catatan_proses') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    <!-- Form untuk Lanjut ke Selesai -->
                    <form method="GET" action="{{ route('tindak-lanjut.selesai', $tindakLanjut->id) }}" id="form-selesai" style="display: none;">
                    </form>

                    <!-- Action Buttons -->
                    <div class="row g-3">
                        <!-- Button Kembali ke Direncanakan -->
                        <div class="col-md-4">
                            <a href="{{ route('tindak-lanjut.edit', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="border: 1px solid #4A7AB5; color: #4A7AB5; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                <i class="fas fa-arrow-left"></i> Direncanakan
                            </a>
                        </div>

                        <!-- Button Simpan Proses -->
                        <div class="col-md-4">
                            <button type="submit" form="form-simpan-proses" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>

                        <!-- Button Lanjut ke Selesai -->
                        <div class="col-md-4">
                            <button type="submit" form="form-selesai" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                <i class="fas fa-arrow-right"></i> Lanjut Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection