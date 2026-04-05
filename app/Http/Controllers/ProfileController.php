<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\LoginHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| Profile Controller
|--------------------------------------------------------------------------
*/

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Profil User
    |--------------------------------------------------------------------------
    */
    public function index(): View
{
    $user = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | Statistik Pengaduan untuk Siswa
    |--------------------------------------------------------------------------
    */
    $totalPengaduan = 0;
    $diproses = 0;
    $selesai = 0;

    if ($user->role === 'siswa') {
        $totalPengaduan = \App\Models\Pengaduan::where('user_id', $user->id)->count();

        $diproses = \App\Models\Pengaduan::where('user_id', $user->id)
            ->where('status', 'diproses')
            ->count();

        $selesai = \App\Models\Pengaduan::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Data Notifikasi 
    |--------------------------------------------------------------------------
    */
    $notifikasiBaru = $user->unreadNotifications()->count();

    $notifications = $user->notifications()
        ->latest()
        ->take(5)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Riwayat Login
    |--------------------------------------------------------------------------
    */
    $loginHistory = LoginHistory::where('user_id', $user->id)
        ->latest('login_at')
        ->take(10)
        ->get();

    return view('profile.index', compact(
        'user',
        'totalPengaduan',
        'diproses',
        'selesai',
        'notifikasiBaru',
        'notifications',
        'loginHistory'
    ));
}

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Edit Profil
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request): View
    {
        // Jika Anda punya view profile.edit terpisah, gunakan ini
        // Jika tidak, bisa redirect ke index
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Informasi Profil
    |--------------------------------------------------------------------------
    */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);
        
        $user->fill($validated);

        /*
        |--------------------------------------------------------------------------
        | Reset Email Verification jika Email Berubah
        |--------------------------------------------------------------------------
        */
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Profil dari Halaman Profil
    |--------------------------------------------------------------------------
    */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nip.max' => 'NIP maksimal 50 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
            'position.max' => 'Jabatan maksimal 100 karakter.',
            'address.max' => 'Alamat maksimal 500 karakter.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Reset Email Verification jika Email Berubah
        |--------------------------------------------------------------------------
        */
        if ($validated['email'] !== $user->email) {
            $validated['email_verified_at'] = null;
        }

        $user->update($validated);

        return Redirect::route('profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------
    */
    public function updatePassword(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verifikasi Password Lama
        |--------------------------------------------------------------------------
        */
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.'
            ])->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Update Password Baru
        |--------------------------------------------------------------------------
        */
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return Redirect::route('profile.index')
            ->with('success', 'Password berhasil diubah!');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Avatar
    |--------------------------------------------------------------------------
    */
    public function updateAvatar(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'avatar.required' => 'Foto profil wajib dipilih.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'avatar.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Hapus Avatar Lama
        |--------------------------------------------------------------------------
        */
        upload_delete($user->avatar);

        /*
        |--------------------------------------------------------------------------
        | Simpan Avatar Baru
        |--------------------------------------------------------------------------
        */
        $avatarPath = upload_store($request->file('avatar'), 'avatar');

        $user->update([
            'avatar' => $avatarPath
        ]);

        return Redirect::route('profile.index')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Avatar
    |--------------------------------------------------------------------------
    */
    public function deleteAvatar(): RedirectResponse
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Hapus File Avatar
        |--------------------------------------------------------------------------
        */
        
        if ($user->avatar && upload_exists($user->avatar)) {
            upload_delete($user->avatar);

            $user->update(['avatar' => null]);
            
            return Redirect::route('profile.index')
                ->with('success', 'Foto profil berhasil dihapus!');
        }

        return Redirect::route('profile.index')
            ->with('info', 'Tidak ada foto profil untuk dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout dari Semua Perangkat
    |--------------------------------------------------------------------------
    */
    public function logoutAllDevices(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'password' => ['required', 'string'],
        ], [
            'password.required' => 'Password wajib diisi untuk konfirmasi.',
        ]);

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verifikasi Password
        |--------------------------------------------------------------------------
        */
        if (!Hash::check($request->password, $user->password)) {
            return Redirect::route('profile.index')
                ->with('error', 'Password yang Anda masukkan salah.');
        }

        /*
        |--------------------------------------------------------------------------
        | Logout dari Semua Sesi
        |--------------------------------------------------------------------------
        */
        Auth::logoutOtherDevices($request->password);

        return Redirect::route('profile.index')
            ->with('success', 'Berhasil logout dari semua perangkat lain.');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Akun User
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.required' => 'Password wajib diisi untuk konfirmasi.',
            'password.current_password' => 'Password yang Anda masukkan salah.',
        ]);

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Hapus Avatar
        |--------------------------------------------------------------------------
        */
        upload_delete($user->avatar);

        /*
        |--------------------------------------------------------------------------
        | Logout dan Hapus User
        |--------------------------------------------------------------------------
        */
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}