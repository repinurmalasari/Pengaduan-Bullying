@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Card -->
            <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08); overflow: hidden;">
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #4A7AB5, #5B8BC5); padding: 32px 24px;">
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="background: rgba(255, 255, 255, 0.2); width: 70px; height: 70px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-edit" style="font-size: 40px; color: white;"></i>
                        </div>
                        <div>
                            <h2 style="margin: 0; font-weight: 600; color: white; font-size: 28px;">Edit User</h2>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">Ubah informasi pengguna sistem</p>
                        </div>
                    </div>
                </div>

                <!-- Body Content -->
                <div style="padding: 32px;">
                    <!-- Form -->
                    <form method="POST" action="{{ route('users.update', $user) }}" id="editUserForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Data User Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Informasi User</h5>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="contoh@email.com" value="{{ old('email', $user->email) }}" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-control form-control-lg @error('role') is-invalid @enderror" required style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px; font-size: 14px;">
                                    <option value="">Pilih role pengguna</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="mb-5">
                            <h5 style="font-weight: 600; color: #1a1a1a; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">Ubah Password</h5>
                            <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;">
                                <small style="color: #856404; font-size: 13px;">
                                    <i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengubah password
                                </small>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-500">Password Baru</label>
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Masukkan password baru" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-500">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password baru" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 16px;">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <a href="{{ route('users.index') }}" class="btn btn-lg w-100" style="border: 1px solid #ddd; color: #1a1a1a; background: white; border-radius: 10px; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px;">
                                    <i class="fas fa-times"></i>Batal
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #4A7AB5, #3A6AA5); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 12px;">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-size: 14px;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .form-control-lg {
        font-size: 14px;
        height: auto;
    }

    .form-control:focus {
        border-color: #4A7AB5;
        box-shadow: 0 0 0 0.2rem rgba(74, 122, 181, 0.25);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .fw-600 {
        font-weight: 600;
    }

    .fw-500 {
        font-weight: 500;
    }
</style>
@endsection