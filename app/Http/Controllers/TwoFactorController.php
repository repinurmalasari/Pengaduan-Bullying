<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| TwoFactorController.php
|--------------------------------------------------------------------------
*/
class TwoFactorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Setup 2FA
    |--------------------------------------------------------------------------
    */
    public function setup()
    {
        // Ambil user saat ini
        $user = Auth::user();
        
        // Tampilkan halaman setup
        return view('auth.two-factor-setup', compact('user'));
    }
    
    /*
    |--------------------------------------------------------------------------
    | Enable 2FA 
    |--------------------------------------------------------------------------
    */
    public function enable(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required|string',
        ]);
        
        // Ambil user saat ini
        $user = Auth::user();
        
        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak valid.']);
        }
        
        // Generate 6-digit secret code
        $secret = $this->generateSecretCode();
        
        // Store encrypted secret
        $user->two_factor_secret = Crypt::encryptString($secret);
        $user->save();
        
        // Send verification code to email
        $this->sendVerificationCode($user, $secret);
        
        // Redirect to verification page
        return redirect()->route('two-factor.verify')
            ->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Halaman Show Verifikasi 2FA
    |--------------------------------------------------------------------------
    */
    public function showVerify()
    {
        // Ambil user saat ini
        $user = Auth::user();
        
        //  Pastikan user sudah setup 2FA
        if (!$user->two_factor_secret) {
            return redirect()->route('two-factor.setup')
                ->with('error', 'Silakan setup 2FA terlebih dahulu.');
        }
        
        // Tampilkan halaman verifikasi
        return view('auth.two-factor-verify', compact('user'));
    }
    
    /*
    |--------------------------------------------------------------------------
    | Verifikasi Kode 2FA
    |--------------------------------------------------------------------------
    */
    public function verify(Request $request)
    {
        // Validasi input kode
        $request->validate([
            'code' => 'required|string|size:6',
        ]);
        
        // Ambil user saat ini
        $user = Auth::user();
        
        // Pastikan user sudah setup 2FA
        if (!$user->two_factor_secret) {
            return redirect()->route('two-factor.setup')
                ->with('error', 'Silakan setup 2FA terlebih dahulu.');
        }
        
        // Decrypt dan cek kode
        $storedCode = Crypt::decryptString($user->two_factor_secret);
        
        // Bandingkan kode
        if ($request->code !== $storedCode) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid.']);
        }
        
        // generate recovery codes
        $recoveryCodes = $this->generateRecoveryCodes();
        
        // Enable 2FA
        $user->two_factor_enabled = true;
        $user->two_factor_recovery_codes = Crypt::encryptString(json_encode($recoveryCodes));
        $user->two_factor_confirmed_at = now();
        $user->save();
        
        return redirect()->route('two-factor.recovery-codes')
            ->with('success', 'Two-Factor Authentication berhasil diaktifkan!')
            ->with('recovery_codes', $recoveryCodes);
    }
    
    /*
    |--------------------------------------------------------------------------
    | Halaman Recovery Codes
    |--------------------------------------------------------------------------
    */
    public function recoveryCodes()
    {
        // Ambil user saat ini
        $user = Auth::user();
        
        // Pastikan 2FA sudah diaktifkan
        if (!$user->two_factor_enabled) {
            return redirect()->route('profile.index');
        }
        
        // Ambil recovery codes dari session
        $recoveryCodes = session('recovery_codes');
        
        // Tampilkan halaman recovery codes
        return view('auth.two-factor-recovery', compact('user', 'recoveryCodes'));
    }
    
    /*
    |--------------------------------------------------------------------------
    | Disable 2FA
    |--------------------------------------------------------------------------
    */
    public function disable(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required|string',
        ]);
        
        // Ambil user saat ini
        $user = Auth::user();
        
        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak valid.']);
        }
        
        // Disable 2FA
        $user->two_factor_enabled = false;
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();
        
        // Redirect ke profile
        return redirect()->route('profile.index')
            ->with('success', 'Two-Factor Authentication berhasil dinonaktifkan.');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Resend Kode Verifikasi
    |--------------------------------------------------------------------------
    */
    public function resend()
    {
        // Ambil user saat ini
        $user = Auth::user();
        
        // Pastikan user sudah setup 2FA
        if (!$user->two_factor_secret) {
            return redirect()->route('two-factor.setup');
        }
        
        // Generate new secret code
        $secret = $this->generateSecretCode();
        $user->two_factor_secret = Crypt::encryptString($secret);
        $user->save();
        
        // Send to email
        $this->sendVerificationCode($user, $secret);
        
        // Redirect back
        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Halaman 2FA Challenge saat Login
    |--------------------------------------------------------------------------
    */
    public function challenge()
    {
        // Pastikan ada user_id di session
        if (!session('two_factor_user_id')) {
            return redirect()->route('login');
        }
        
        // Tampilkan halaman challenge
        return view('auth.two-factor-challenge');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Verifikasi 2FA saat Login
    |--------------------------------------------------------------------------
    */
    public function challengeVerify(Request $request)
    {
        // Validasi input kode
        $request->validate([
            'code' => 'required|string',
        ]);
        
        // Ambil user_id dari session
        $userId = session('two_factor_user_id');
        
        // Pastikan user ada
        if (!$userId) {
            return redirect()->route('login');
        }
        
        // Ambil user dari database
        $user = \App\Models\User::find($userId);
        
        // Pastikan user ada
        if (!$user) {
            return redirect()->route('login');
        }
        
        // cek apakah input adalah recovery code
        if (strlen($request->code) === 10) {
            return $this->verifyRecoveryCode($request, $user);
        }
        
        // verifikasi kode biasa
        $storedCode = session('two_factor_code');
        
        if ($request->code !== $storedCode) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid.']);
        }
        
        // Clear session
        session()->forget(['two_factor_user_id', 'two_factor_code']);
        
        // Login the user
        Auth::login($user, session('two_factor_remember', false));
        session()->forget('two_factor_remember');
        
        return redirect()->intended('/dashboard');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Verifikasi Recovery Code saat Login
    |--------------------------------------------------------------------------
    */
    private function verifyRecoveryCode(Request $request, $user)
    {
        // Decrypt recovery codes
        $recoveryCodes = json_decode(Crypt::decryptString($user->two_factor_recovery_codes), true);
        
        // Cek apakah kode ada di recovery codes
        $codeIndex = array_search($request->code, $recoveryCodes);
        
        // Jika tidak ditemukan
        if ($codeIndex === false) {
            return back()->withErrors(['code' => 'Recovery code tidak valid.']);
        }
        
        // hapus recovery code yang sudah dipakai
        unset($recoveryCodes[$codeIndex]);
        $user->two_factor_recovery_codes = Crypt::encryptString(json_encode(array_values($recoveryCodes)));
        $user->save();
        
        // Clear session
        session()->forget(['two_factor_user_id', 'two_factor_code']);
        
        // Login the user
        Auth::login($user, session('two_factor_remember', false));
        session()->forget('two_factor_remember');
        
        return redirect()->intended('/dashboard')
            ->with('warning', 'Anda telah menggunakan recovery code. Sisa: ' . count($recoveryCodes) . ' kode.');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Generate 6-Digit Secret Code
    |--------------------------------------------------------------------------
    */
    private function generateSecretCode(): string
    {
        // Generate a random 6-digit code
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    
    /*
    |--------------------------------------------------------------------------
    | Generate Recovery Codes
    |--------------------------------------------------------------------------
    */
    private function generateRecoveryCodes(): array
    {
        // Generate 8 recovery codes
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = Str::upper(Str::random(10));
        }
        return $codes;
    }
    
    /*
    |--------------------------------------------------------------------------
    | Kirim Kode Verifikasi via Email
    |--------------------------------------------------------------------------
    */
    private function sendVerificationCode($user, $code)
    {
        // Send email notification
        $user->notify(new \App\Notifications\TwoFactorCodeNotification($code));
    }
}
