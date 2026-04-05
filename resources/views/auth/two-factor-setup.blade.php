@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header -->
                <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-alt" style="font-size: 36px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 24px;">Two-Factor Authentication</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">
                                Tingkatkan keamanan akun Anda
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    @if($user->two_factor_enabled)
                        <!-- 2FA Already Enabled -->
                        <div class="text-center mb-4">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                <i class="fas fa-check" style="font-size: 36px; color: white;"></i>
                            </div>
                            <h4 style="color: #10b981; font-weight: 600;">2FA Sudah Aktif</h4>
                            <p class="text-muted">
                                Two-Factor Authentication telah diaktifkan pada
                                @if($user->two_factor_confirmed_at instanceof \Illuminate\Support\Carbon)
                                    {{ $user->two_factor_confirmed_at->format('d M Y, H:i') }}
                                @elseif($user->two_factor_confirmed_at)
                                    {{ \Illuminate\Support\Carbon::parse($user->two_factor_confirmed_at)->format('d M Y, H:i') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        
                        <div class="card mb-4" style="background: #f0fdf4; border: 1px solid #86efac; border-radius: 12px;">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-success mb-3">
                                    <i class="fas fa-info-circle mr-2"></i>Informasi
                                </h6>
                                <p class="mb-0 text-muted small">
                                    Setiap kali Anda login, sistem akan mengirimkan kode verifikasi ke email Anda. Pastikan email Anda selalu aktif.
                                </p>
                            </div>
                        </div>
                        
                        <form action="{{ route('two-factor.disable') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Konfirmasi Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password untuk menonaktifkan 2FA" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-danger btn-block" 
                                    onclick="return confirm('Yakin ingin menonaktifkan Two-Factor Authentication?')">
                                <i class="fas fa-times mr-2"></i>Nonaktifkan 2FA
                            </button>
                        </form>
                    @else
                        <!-- Setup 2FA -->
                        <div class="text-center mb-4">
                            <p class="text-muted">Two-Factor Authentication menambahkan lapisan keamanan ekstra dengan meminta kode verifikasi setiap kali login.</p>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100" style="background: #f0fdf4; border: 1px solid #86efac; border-radius: 12px;">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x text-success mb-3"></i>
                                        <h6 class="font-weight-bold">Email Verification</h6>
                                        <p class="small text-muted mb-0">Kode dikirim ke email Anda</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100" style="background: #eff6ff; border: 1px solid #93c5fd; border-radius: 12px;">
                                    <div class="card-body text-center">
                                        <i class="fas fa-key fa-2x text-primary mb-3"></i>
                                        <h6 class="font-weight-bold">Recovery Codes</h6>
                                        <p class="small text-muted mb-0">8 kode darurat disediakan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('two-factor.enable') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Konfirmasi Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password untuk mengaktifkan 2FA" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Masukkan password Anda untuk mengonfirmasi identitas.</small>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-shield-alt mr-2"></i>Aktifkan 2FA
                            </button>
                        </form>
                    @endif
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('profile.index') }}" class="text-muted">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
