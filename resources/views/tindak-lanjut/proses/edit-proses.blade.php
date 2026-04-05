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
                    
                    <!-- Active Line Progress - Hijau sampai step 2 (bulat Proses) -->
                    @if($tindakLanjut->status === 'diproses')
                        <!-- Hijau sampai step 2 (50%) -->
                        <div style="position: absolute; top: 20px; left: 0; width: 50%; height: 3px; background: #10b981; z-index: 1;"></div>
                    @else
                        <!-- Hijau sampai step 3 (selesai) -->
                        <div style="position: absolute; top: 20px; left: 0; width: 100%; height: 3px; background: #10b981; z-index: 1;"></div>
                    @endif
                    
                    <!-- Step 1 - Direncanakan (Always Completed) -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Direncanakan</p>
                    </div>
                    
                    <!-- Step 2 - Proses -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        @if($tindakLanjut->status === 'diproses')
                            <!-- Status Diproses - Hijau dengan centang -->
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                                <i class="fas fa-check"></i>
                            </div>
                            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
                        @elseif($tindakLanjut->status === 'selesai')
                            <!-- Status Selesai - Hijau dengan check -->
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">
                                <i class="fas fa-check"></i>
                            </div>
                            <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #10b981;">Proses</p>
                        @else
                            <!-- Status Direncanakan - Abu-abu -->
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
                <!-- Header Section (Orange Gradient) -->
                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-edit" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Edit Proses Tindak Lanjut</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Ubah data proses tindakan yang sedang berjalan</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Alert Success (jika ada) -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; border-left: 4px solid #10b981;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Form Utama -->
                    <form method="POST" action="{{ route('tindak-lanjut.update-proses-edit', $tindakLanjut->id) }}" id="form-update-proses">
                        @csrf
                        @method('PATCH')

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

                        <!-- Tanggal Mulai Proses -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Tanggal Mulai Proses <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="tanggal_mulai_proses" 
                                   class="form-control form-control-lg @error('tanggal_mulai_proses') is-invalid @enderror" 
                                   required 
                                   value="{{ old('tanggal_mulai_proses', optional($tindakLanjut->tanggal_mulai_proses)->format('Y-m-d')) }}" 
                                   style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            @error('tanggal_mulai_proses') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pihak Terlibat (Optional) -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Pihak yang Terlibat</label>
                            <input type="text" 
                                   name="pihak_terlibat" 
                                   class="form-control form-control-lg @error('pihak_terlibat') is-invalid @enderror" 
                                   value="{{ old('pihak_terlibat', $tindakLanjut->pihak_terlibat ?? '') }}" 
                                   placeholder="Contoh: Guru BK, Orang Tua, Wali Kelas" 
                                   style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            <small class="text-muted">Pisahkan dengan koma jika lebih dari satu</small>
                            @error('pihak_terlibat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Catatan Proses -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Catatan Proses <span class="text-danger">*</span></label>
                            <textarea name="catatan_proses" 
                                      class="form-control @error('catatan_proses') is-invalid @enderror" 
                                      rows="5" 
                                      required 
                                      placeholder="Jelaskan proses yang sedang dilakukan..." 
                                      style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('catatan_proses', $tindakLanjut->catatan_proses ?? '') }}</textarea>
                            @error('catatan_proses') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Hidden input untuk status agar tetap tersimpan -->
                        <input type="hidden" name="status" value="{{ $tindakLanjut->status }}">

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <!-- Button Kembali ke Direncanakan -->
                            <div class="col-md-4">
                                <a href="{{ route('tindak-lanjut.edit', $tindakLanjut->id) }}" 
                                   class="btn btn-lg w-100" 
                                   style="border: 1px solid #4A7AB5; color: #4A7AB5; background: white; border-radius: 10px; font-weight: 500; text-decoration: none; padding: 12px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-arrow-left me-2"></i> Direncanakan
                                </a>
                            </div>

                            <!-- Button Simpan Proses -->
                            <div class="col-md-4">
                                <button type="submit" 
                                        class="btn btn-lg w-100" 
                                        style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                         Simpan Perubahan
                                </button>
                            </div>

                            <!-- Button Lanjut ke Selesai -->
                            <div class="col-md-4">
                                <button type="button" 
                                        onclick="document.getElementById('form-selesai').submit();"
                                        class="btn btn-lg w-100" 
                                        style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                    <i class="fas fa-arrow-right me-2"></i> Lanjut Selesai
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Form untuk Lanjut ke Selesai (Terpisah) -->
                    <form method="GET" action="{{ route('tindak-lanjut.selesai', $tindakLanjut->id) }}" id="form-selesai" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection