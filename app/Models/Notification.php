<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // nama tabel yang digunakan
    protected $table = 'notifications';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'pengaduan_id',
        'is_read'
    ];

    // casting kolom ke tipe data yang sesuai
    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke User
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Pengaduan
    |--------------------------------------------------------------------------
    */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scope: Notifikasi Belum Dibaca
    |--------------------------------------------------------------------------
    */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /*
    |--------------------------------------------------------------------------
    | Scope: Notifikasi Sudah Dibaca
    |--------------------------------------------------------------------------
    */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Scope: Filter Berdasarkan Tipe
    |--------------------------------------------------------------------------
    */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}