<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // nama tabel yang digunakan
    protected $table = 'siswas';
    
    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama', 
        'nis', 
        'kelas', 
        'email', 
        'no_telepon', 
        'alamat'
        ];
}
