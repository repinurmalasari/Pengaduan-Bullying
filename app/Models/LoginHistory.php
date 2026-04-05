<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginHistory extends Model
{
    // nama tabel yang digunakan
    protected $table = 'login_history';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'device',
        'browser',
        'platform',
        'login_at',
    ];

    // casting kolom login_at ke tipe datetime
    protected $casts = [
        'login_at' => 'datetime',
    ];

    // relasi ke model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
