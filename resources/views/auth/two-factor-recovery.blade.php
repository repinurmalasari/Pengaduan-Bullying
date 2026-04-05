@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header -->
                <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px 24px;">
                    <div class="text-center">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <i class="fas fa-check" style="font-size: 32px; color: white;"></i>
                        </div>
                        <h3 style="color: white; font-weight: 600; margin-bottom: 8px;">2FA Berhasil Diaktifkan!</h3>
                        <p style="color: rgba(255,255,255,0.9); font-size: 14px; margin: 0;">
                            Simpan recovery codes di tempat yang aman
                        </p>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="alert alert-warning" style="border-radius: 12px;">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-exclamation-triangle mr-3 mt-1" style="font-size: 20px;"></i>
                            <div>
                                <strong>Penting!</strong>
                                <p class="mb-0 small">Recovery codes ini hanya ditampilkan sekali. Simpan di tempat yang aman seperti password manager. Anda dapat menggunakan salah satu kode ini jika kehilangan akses ke email.</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($recoveryCodes)
                    <div class="card mb-4" style="background: #f9fafb; border: 2px dashed #d1d5db; border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="font-weight-bold mb-3">
                                <i class="fas fa-key mr-2 text-primary"></i>Recovery Codes
                            </h6>
                            <div class="row">
                                @foreach($recoveryCodes as $code)
                                <div class="col-6 mb-2">
                                    <code style="background: white; padding: 8px 12px; display: block; border-radius: 6px; font-size: 14px; border: 1px solid #e5e7eb;">
                                        {{ $code }}
                                    </code>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3 mb-4" style="gap: 12px;">
                        <button type="button" class="btn btn-outline-primary" onclick="copyRecoveryCodes()">
                            <i class="fas fa-copy mr-1"></i>Copy
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="downloadRecoveryCodes()">
                            <i class="fas fa-download mr-1"></i>Download
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="printRecoveryCodes()">
                            <i class="fas fa-print mr-1"></i>Print
                        </button>
                    </div>
                    @endif
                    
                    <a href="{{ route('profile.index') }}" class="btn btn-success btn-block">
                        <i class="fas fa-check mr-2"></i>Selesai
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyRecoveryCodes() {
    const codes = @json($recoveryCodes ?? []);
    const text = "Recovery Codes - {{ config('app.name') }}\n" + 
                 "User: {{ $user->email }}\n" +
                 "Generated: {{ now()->format('d M Y H:i') }}\n\n" +
                 codes.join('\n');
    
    navigator.clipboard.writeText(text).then(() => {
        alert('Recovery codes berhasil di-copy!');
    });
}

function downloadRecoveryCodes() {
    const codes = @json($recoveryCodes ?? []);
    const text = "Recovery Codes - {{ config('app.name') }}\n" + 
                 "User: {{ $user->email }}\n" +
                 "Generated: {{ now()->format('d M Y H:i') }}\n\n" +
                 codes.join('\n') +
                 "\n\nPENTING: Simpan file ini di tempat yang aman!";
    
    const blob = new Blob([text], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'recovery-codes-{{ Str::slug(config('app.name')) }}.txt';
    a.click();
    window.URL.revokeObjectURL(url);
}

function printRecoveryCodes() {
    window.print();
}
</script>

<style>
@media print {
    .btn, .alert, nav, .sidebar, footer {
        display: none !important;
    }
}
</style>
@endsection
