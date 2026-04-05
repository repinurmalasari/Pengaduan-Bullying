<x-guest-layout>
    <div class="mb-4 text-center">
        <div style="font-size: 38px; color: #4a7ba7; margin-bottom: 10px;">
            <i class="fas fa-unlock-alt"></i>
        </div>
        <h2 class="fw-bold mb-2" style="color: #4a7ba7;">Lupa Kata Sandi?</h2>
        <p class="text-muted mb-0" style="font-size: 1rem;">Masukkan email yang terdaftar, kami akan mengirimkan link untuk mengatur ulang kata sandi Anda.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            Link reset kata sandi telah dikirim ke email Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus placeholder="Masukkan email Anda">
            @error('email')
                <div class="invalid-feedback">
                    @if($message === "We can't find a user with that email address.")
                        Kami tidak menemukan pengguna dengan alamat email tersebut.
                    @else
                        {{ $message }}
                    @endif
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background: linear-gradient(90deg, #5a8fb8 0%, #4a7ba7 100%); border: none;">
            <i class="fas fa-paper-plane me-1"></i> Kirim Link Reset Kata Sandi
        </button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('login') }}" class="text-decoration-none" style="color: #4a7ba7; font-weight: 500;">
            <i class="fas fa-arrow-left"></i> Kembali ke Login
        </a>
    </div>
</x-guest-layout>
