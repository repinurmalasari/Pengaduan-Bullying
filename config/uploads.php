<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base Upload Path
    |--------------------------------------------------------------------------
    |
    | Path dasar untuk menyimpan file upload. Menggunakan folder "uploads"
    | di dalam direktori public agar bisa diakses langsung via URL tanpa
    | memerlukan storage:link (cocok untuk shared hosting tanpa SSH).
    |
    */

    'base_path' => public_path('uploads'),
    'base_url' => 'uploads',

    /*
    |--------------------------------------------------------------------------
    | Upload Paths per Kategori
    |--------------------------------------------------------------------------
    |
    | Konfigurasi folder dan validasi untuk setiap jenis upload.
    |
    */

    'paths' => [

        'avatar' => [
            'folder' => 'avatars',
            'mimes' => 'jpeg,png,jpg,gif',
            'max_size' => 2048, // 2MB
        ],

        'pengaduan' => [
            'folder' => 'pengaduan',
            'mimes' => 'png,jpg,jpeg,mp4',
            'max_size' => 10240, // 10MB
        ],

        'tindak_lanjut' => [
            'folder' => 'tindak-lanjut',
            'mimes' => 'png,jpg,jpeg,pdf,doc,docx,mp4',
            'max_size' => 10240, // 10MB
        ],

    ],

];
