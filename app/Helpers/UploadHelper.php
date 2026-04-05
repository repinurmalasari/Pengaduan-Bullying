<?php

use Illuminate\Http\UploadedFile;

/*
|--------------------------------------------------------------------------
| Upload Helper Functions
|--------------------------------------------------------------------------
|
| Helper untuk mengelola file upload menggunakan path dari config/uploads.php.
| Semua file disimpan langsung di public/uploads/ tanpa storage:link,
| sehingga kompatibel dengan shared hosting yang tidak support SSH.
|
*/

if (!function_exists('upload_path')) {
    /**
     * Mendapatkan full path ke folder upload berdasarkan kategori.
     *
     * @param string $category  Kategori upload (avatar, pengaduan, tindak_lanjut)
     * @param string|null $filename  Nama file (opsional)
     * @return string
     */
    function upload_path(string $category, ?string $filename = null): string
    {
        $basePath = config('uploads.base_path');
        $folder = config("uploads.paths.{$category}.folder", $category);

        $path = $basePath . DIRECTORY_SEPARATOR . $folder;

        if ($filename) {
            $path .= DIRECTORY_SEPARATOR . $filename;
        }

        return $path;
    }
}

if (!function_exists('upload_url')) {
    /**
     * Mendapatkan URL publik file upload.
     *
     * @param string|null $filename  Path relatif file (misal: avatars/xxx.jpg)
     * @param string $category  Kategori upload
     * @return string|null
     */
    function upload_url(?string $filename, string $category = ''): ?string
    {
        if (!$filename) {
            return null;
        }

        $baseUrl = config('uploads.base_url');

        // Jika filename sudah mengandung folder (misal: avatars/xxx.jpg)
        // langsung gunakan
        return asset($baseUrl . '/' . $filename);
    }
}

if (!function_exists('upload_store')) {
    /**
     * Simpan file upload ke folder yang sesuai.
     *
     * @param UploadedFile $file  File yang diupload
     * @param string $category  Kategori upload (avatar, pengaduan, tindak_lanjut)
     * @param string|null $filename  Nama file custom (opsional, auto-generate jika null)
     * @return string  Path relatif file yang disimpan (misal: avatars/xxx.jpg)
     */
    function upload_store(UploadedFile $file, string $category, ?string $filename = null): string
    {
        $folder = config("uploads.paths.{$category}.folder", $category);
        $destPath = config('uploads.base_path') . DIRECTORY_SEPARATOR . $folder;

        // Buat direktori jika belum ada
        if (!file_exists($destPath)) {
            mkdir($destPath, 0755, true);
        }

        // Generate nama file jika tidak diberikan
        if (!$filename) {
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
        }

        // Pindahkan file ke folder tujuan
        $file->move($destPath, $filename);

        // Return path relatif: folder/filename
        return $folder . '/' . $filename;
    }
}

if (!function_exists('upload_delete')) {
    /**
     * Hapus file upload.
     *
     * @param string|null $filePath  Path relatif file (misal: avatars/xxx.jpg)
     * @return bool
     */
    function upload_delete(?string $filePath): bool
    {
        if (!$filePath) {
            return false;
        }

        $fullPath = config('uploads.base_path') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $filePath);

        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}

if (!function_exists('upload_exists')) {
    /**
     * Cek apakah file upload ada.
     *
     * @param string|null $filePath  Path relatif file
     * @return bool
     */
    function upload_exists(?string $filePath): bool
    {
        if (!$filePath) {
            return false;
        }

        $fullPath = config('uploads.base_path') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $filePath);

        return file_exists($fullPath);
    }
}

if (!function_exists('upload_validation')) {
    /**
     * Mendapatkan string validasi Laravel untuk kategori upload.
     *
     * @param string $category  Kategori upload
     * @return string  Contoh: "file|mimes:png,jpg,jpeg,mp4|max:10240"
     */
    function upload_validation(string $category): string
    {
        $mimes = config("uploads.paths.{$category}.mimes", 'png,jpg,jpeg');
        $maxSize = config("uploads.paths.{$category}.max_size", 2048);

        return "file|mimes:{$mimes}|max:{$maxSize}";
    }
}

if (!function_exists('upload_download')) {
    /**
     * Download file upload.
     *
     * @param string $filePath  Path relatif file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    function upload_download(string $filePath): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $fullPath = config('uploads.base_path') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $filePath);

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($fullPath);
    }
}
