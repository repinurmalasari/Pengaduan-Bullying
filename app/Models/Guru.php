<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    // nama tabel yang digunakan
    protected $table = 'gurus';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama', 
        'nip', 
        'email', 
        'no_telepon', 
        'alamat'];
}
