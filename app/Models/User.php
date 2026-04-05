<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mencegah penghapusan user tertentu (admin & kepala sekolah)
     */
    protected static function booted()
    {
        // Menangani event deleting
        static::deleting(function ($user) {
            if (in_array($user->role, ['admin', 'kepala_sekolah'])) {
                throw new \Exception(
                    'User dengan role admin atau kepala sekolah bersifat permanen dan tidak boleh dihapus.'
                );
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas',
        'nip',
        'phone',
        'address',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // kolom yang disembunyikan saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // casting kolom ke tipe data yang sesuai
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_confirmed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessor: URL Avatar
    |--------------------------------------------------------------------------
    */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        return upload_url($this->avatar, 'avatar');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is Guru BK
     */
    public function isGuruBK(): bool
    {
        return $this->role === 'guru_bk';
    }

    /**
     * Check if user is Wali Kelas
     */
    public function isWaliKelas(): bool
    {
        return $this->role === 'wali_kelas';
    }

    /**
     * Check if user is Siswa
     */
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get user role name in readable format
     */
    public function getRoleName(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'guru_bk' => 'Guru BK',
            'wali_kelas' => 'Wali Kelas',
            'siswa' => 'Siswa',
            default => 'Belum Ada Peran'
        };
    }

    /**
     * Scope to filter users by role
     */
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to get users without role
     */
    public function scopeWithoutRole($query)
    {
        return $query->whereNull('role');
    }

    /**
     * Check if user has completed registration (has role)
     */
    public function hasCompletedRegistration(): bool
    {
        return $this->role !== null && $this->role !== '';
    }

    /**
     * Relationships (tambahkan sesuai kebutuhan)
     */
    
    // Relasi untuk Siswa
    public function pengaduanSiswa()
    {
        return $this->hasMany(Pengaduan::class, 'user_id');
    }

    // Relasi untuk Guru BK
    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'user_id');
    }
    
    // Relasi untuk Login History
    public function loginHistory()
    {
        return $this->hasMany(LoginHistory::class);
    }
}