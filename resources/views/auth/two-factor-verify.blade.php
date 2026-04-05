@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="text-center">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <i class="fas fa-envelope-open-text" style="font-size: 32px; color: white;"></i>
                        </div>
                        <h3 style="color: white; font-weight: 600; margin-bottom: 8px;">Verifikasi Kode</h3>
                        <p style="color: rgba(255,255,255,0.9); font-size: 14px; margin: 0;">
                            Kode telah dikirim ke {{ Str::mask($user->email, '*', 3, -10) }}
                        </p>
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
                    
                    <form action="{{ route('two-factor.verify') }}" method="POST">
                        @csrf
                        
                        <div class="form-group text-center">
                            <label class="font-weight-bold mb-3">Masukkan 6 Digit Kode</label>
                            <input type="text" name="code" 
                                   class="form-control form-control-lg text-center @error('code') is-invalid @enderror" 
                                   placeholder="000000"
                                   maxlength="6"
                                   pattern="[0-9]{6}"
                                   style="font-size: 28px; letter-spacing: 10px; font-weight: bold;"
                                   autofocus required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-check mr-2"></i>Verifikasi
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted small mb-2">Tidak menerima kode?</p>
                        <form action="{{ route('two-factor.resend') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link p-0">
                                <i class="fas fa-redo mr-1"></i>Kirim Ulang Kode
                            </button>
                        </form>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('two-factor.setup') }}" class="text-muted small">
                            <i class="fas fa-arrow-left mr-1"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input[name="code"]::-webkit-outer-spin-button,
    input[name="code"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[name="code"] {
        -moz-appearance: textfield;
    }
</style>
@endsection
