@extends('layouts.app')

@section('content')
@php
    $tindakLanjut = \App\Models\TindakLanjut::where('pengaduan_id', $pengaduan->id)->first();
@endphp

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Progress Steps -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center" style="position: relative;">
                    <!-- Line -->
                    <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background: #e0e0e0; z-index: 1;"></div>
                    
                    <!-- Step 1 -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #4A7AB5; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">1</div>
                        <p style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #4A7AB5;">Direncanakan</p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">2</div>
                        <p style="margin-top: 8px; font-size: 12px; color: #999;">Proses</p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div style="position: relative; z-index: 2; text-align: center; flex: 1;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #999; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600;">3</div>
                        <p style="margin-top: 8px; font-size: 12px; color: #999;">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Rencanakan Tindak Lanjut</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Buat rencana tindakan untuk kasus pengaduan</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Form -->
                    <form method="POST" action="{{ route('tindak-lanjut.store') }}">
                        @csrf
                        <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                        
                        <!-- Info Pengaduan (OTOMATIS TERISI) -->
                        <div class="mb-4" style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #4B7EC4;">
                            <h6 style="margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 16px;">
                                <i class="fas fa-info-circle" style="color: #4B7EC4;"></i> Informasi Pengaduan
                            </h6>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Nomor Laporan</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->nomor_laporan }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Tanggal Kejadian</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->incident_date->format('d-m-Y') }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelapor</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->reporter_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Korban</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->victim_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Pelaku</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->perpetrator_name }}</p>
                                </div>

                                <div>
                                    <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Jenis Bullying</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->bullying_type }}</p>
                                </div>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <p style="margin: 0; font-size: 12px; color: #666; font-weight: 500;">Lokasi</p>
                                <p style="margin: 4px 0 0 0; font-size: 14px; color: #1a1a1a; font-weight: 600;">{{ $pengaduan->location }}</p>
                            </div>

                            <div>
                                <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: 500;">Deskripsi</p>
                                <div style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                    <p style="margin: 0; font-size: 14px; color: #1a1a1a; line-height: 1.6;">{{ $pengaduan->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Tindakan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Jenis Tindakan <span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg @error('jenis_tindakan') is-invalid @enderror" name="jenis_tindakan" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                <option value="">-- Pilih Jenis Tindakan --</option>
                                <option value="pembinaan" {{ old('jenis_tindakan', $tindakLanjut->jenis_tindakan ?? '') == 'pembinaan' ? 'selected' : '' }}>Pembinaan</option>
                                <option value="konseling" {{ old('jenis_tindakan', $tindakLanjut->jenis_tindakan ?? '') == 'konseling' ? 'selected' : '' }}>Konseling</option>
                                <option value="skorsing" {{ old('jenis_tindakan', $tindakLanjut->jenis_tindakan ?? '') == 'skorsing' ? 'selected' : '' }}>Skorsing</option>
                                <option value="peringatan" {{ old('jenis_tindakan', $tindakLanjut->jenis_tindakan ?? '') == 'peringatan' ? 'selected' : '' }}>Peringatan</option>
                                <option value="lainnya" {{ old('jenis_tindakan', $tindakLanjut->jenis_tindakan ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_tindakan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Deskripsi Rencana -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Deskripsi Rencana Tindakan <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required placeholder="Jelaskan rencana tindakan yang akan dilakukan..." style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">{{ old('deskripsi', $tindakLanjut->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tanggal Rencana Tindakan -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-500" style="color: #1a1a1a; font-size: 14px; margin-bottom: 10px;">Tanggal Rencana Tindakan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_tindakan" class="form-control form-control-lg @error('tanggal_tindakan') is-invalid @enderror" required value="{{ old('tanggal_tindakan', optional($tindakLanjut)->tanggal_tindakan ? optional($tindakLanjut)->tanggal_tindakan->format('Y-m-d') : '') }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            @error('tanggal_tindakan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('tindak-lanjut.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; padding: 12px;">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px;">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                            <div class="col-md-4">
                                @if($tindakLanjut && $tindakLanjut->status === 'direncanakan')
                                    {{-- LINK KE HALAMAN PROSES (GET) --}}
                                    <a href="{{ route('tindak-lanjut.proses', $tindakLanjut->id) }}" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-arrow-right"></i> Lanjut Ke Proses
                                    </a>
                                @else
                                    <button type="button" class="btn btn-lg w-100" disabled style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 500; padding: 12px; opacity: 0.6;">
                                        <i class="fas fa-arrow-right"></i> Lanjut Ke Proses
                                    </button>
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