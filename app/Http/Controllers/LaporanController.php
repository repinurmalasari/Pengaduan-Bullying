<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use App\Models\TindakLanjutAwal;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


/*
|--------------------------------------------------------------------------
| Laporan Controller
|--------------------------------------------------------------------------
*/

class LaporanController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Tampilkan Halaman Laporan
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('laporan.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Data Pengaduan
    |--------------------------------------------------------------------------
    */

    public function laporanPengaduan(Request $request)
    {
        $query = Pengaduan::with(['user', 'tindakLanjut', 'tindakLanjutAwal']);
        
        // Filter Berdasarkan Periode
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'hari':
                    if ($request->filled('tanggal')) {
                        $query->whereDate('created_at', $request->tanggal);
                    } else {
                        $query->whereDate('created_at', Carbon::today());
                    }
                    break;
                case 'bulan':
                    if ($request->filled('bulan') && $request->filled('tahun')) {
                        $query->whereMonth('created_at', $request->bulan)
                              ->whereYear('created_at', $request->tahun);
                    } else {
                        $query->whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year);
                    }
                    break;
                case 'tahun':
                    if ($request->filled('tahun')) {
                        $query->whereYear('created_at', $request->tahun);
                    } else {
                        $query->whereYear('created_at', Carbon::now()->year);
                    }
                    break;
            }
        }

        // Filter Berdasarkan Status (FINAL STATUS)
            if ($request->filled('status')) {
            $statusFilter = $request->status;
    
            // Filter akan dilakukan setelah mapping final_status
            // Jadi kita ambil semua data dulu, baru filter di collection
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->get();

        /*
        |--------------------------------------------------------------------------
        | Mapping Final Status (SAMA SEPERTI DI PengaduanController@index)
        |--------------------------------------------------------------------------
        */

        $pengaduan = $pengaduan->map(function ($item) {

            // LOGIC STATUS FINAL (PRIORITAS: Ditolak > Tindak Lanjut BK > Tindak Lanjut Awal > Status Pengaduan)
            if ($item->status === 'ditolak') {
                $finalStatus = 'ditolak';
            } elseif ($item->tindakLanjut && in_array($item->tindakLanjut->status, ['diproses', 'selesai'])) {

                // Tindak lanjut BK sudah diproses/selesai → prioritaskan ini
                $finalStatus = $item->tindakLanjut->status;
            } elseif ($item->tindakLanjutAwal) {

                // Tindak lanjut awal dari wali kelas (termasuk direkomendasi_bk)
                $finalStatus = $item->tindakLanjutAwal->status;
            } elseif ($item->tindakLanjut) {

                // Tindak lanjut BK masih direncanakan
                $finalStatus = $item->tindakLanjut->status;
            } elseif ($item->status === 'disetujui') {
                $finalStatus = 'disetujui';
            } else {
                $finalStatus = 'menunggu';
            }

            $item->final_status = $finalStatus;
            $item->status_tampil = $this->getStatusLabel($finalStatus);

            return $item;

        });

        // FILTER FINAL STATUS DI SINI
            if ($request->filled('status')) {
            $pengaduan = $pengaduan->filter(function ($item) use ($request) {

        return $item->final_status === $request->status;
        });
    }
    
        // Hitung Statistik
        $statistik = [
            'total' => $pengaduan->count(),
            'menunggu' => $pengaduan->filter(fn ($p) => $p->final_status === 'menunggu')->count(),
            'disetujui' => $pengaduan->filter(fn ($p) => $p->final_status === 'disetujui')->count(),
            'ditolak' => $pengaduan->filter(fn ($p) => $p->final_status === 'ditolak')->count(),
            'direncanakan' => $pengaduan->filter(fn ($p) => $p->final_status === 'direncanakan')->count(),
            'proses' => $pengaduan->filter(fn ($p) => $p->final_status === 'diproses')->count(),
            'selesai' => $pengaduan->filter(fn ($p) => $p->final_status === 'selesai')->count(),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.pengaduan', compact('pengaduan', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Pengaduan_' . date('Y-m-d_His') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Mapping Status Label
    |--------------------------------------------------------------------------
    */

    private function getStatusLabel($finalStatus)
    {
        $statusMap = [
            'menunggu' => 'Menunggu Verifikasi',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'direncanakan' => 'Direncanakan',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'direkomendasi_bk' => 'Direkomendasi ke BK'
        ];
        
        return $statusMap[$finalStatus] ?? ucfirst($finalStatus);
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Tindak Lanjut
    |--------------------------------------------------------------------------
    */

    public function laporanTindakLanjut(Request $request)
    {
        $query = TindakLanjut::with(['pengaduan.user']);
        
        /*
        |--------------------------------------------------------------------------
        | Filter Berdasarkan Periode
        |--------------------------------------------------------------------------
        */

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'hari':
                    if ($request->filled('tanggal')) {
                        $query->whereDate('tanggal_tindakan', $request->tanggal);
                    } else {
                        $query->whereDate('tanggal_tindakan', Carbon::today());
                    }
                    break;
                case 'bulan':
                    if ($request->filled('bulan') && $request->filled('tahun')) {
                        $query->whereMonth('tanggal_tindakan', $request->bulan)
                              ->whereYear('tanggal_tindakan', $request->tahun);
                    } else {
                        $query->whereMonth('tanggal_tindakan', Carbon::now()->month)
                              ->whereYear('tanggal_tindakan', Carbon::now()->year);
                    }
                    break;
                case 'tahun':
                    if ($request->filled('tahun')) {
                        $query->whereYear('tanggal_tindakan', $request->tahun);
                    } else {
                        $query->whereYear('tanggal_tindakan', Carbon::now()->year);
                    }
                    break;
            }
        }

        // Filter berdasarkan jenis tindakan
        if ($request->filled('jenis_tindakan')) {
            $query->where('jenis_tindakan', $request->jenis_tindakan);
        }

        $tindakLanjut = $query->orderBy('tanggal_tindakan', 'desc')->get();

        // Hitung Statistik
        $statistik = [
            'total' => $tindakLanjut->count(),
            'direncanakan' => $tindakLanjut->where('status', 'direncanakan')->count(),
            'diproses' => $tindakLanjut->where('status', 'diproses')->count(),
            'selesai' => $tindakLanjut->where('status', 'selesai')->count(),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.tindak-lanjut', compact('tindakLanjut', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Tindak_Lanjut_' . date('Y-m-d_His') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Data Siswa
    |--------------------------------------------------------------------------
    */
    public function laporanSiswa(Request $request)
    {
        $query = User::where('role', 'siswa')
                     ->withCount(['pengaduanSiswa']);

        // Filter Berdasarkan Kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Filter Berdasarkan Tahun Registrasi
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $siswa = $query->orderBy('name')->get();

        // Hitung Statistik         
        $statistik = [
            'total_siswa' => $siswa->count(),
            'siswa_pelapor' => $siswa->where('pengaduan_siswa_count', '>', 0)->count(),
            'total_laporan' => $siswa->sum('pengaduan_siswa_count'),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.siswa', compact('siswa', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Data_Siswa_' . date('Y-m-d_His') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Data Guru
    |--------------------------------------------------------------------------
    */

    public function laporanGuru(Request $request)
    {
        $query = User::where('role', 'guru_bk')
                     ->withCount(['tindakLanjut']);

        $guru = $query->orderBy('name')->get();

        // Hitung Statistik
        $statistik = [
            'total_guru' => $guru->count(),
            'guru_aktif' => $guru->where('tindak_lanjut_count', '>', 0)->count(),
            'total_tindakan' => $guru->sum('tindak_lanjut_count'),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.guru', compact('guru', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Data_Guru_' . date('Y-m-d_His') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Data Wali Kelas
    |--------------------------------------------------------------------------
    */

    public function laporanWaliKelas(Request $request)
    {
        $query = User::where('role', 'wali_kelas');

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Filter berdasarkan tahun registrasi
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $waliKelas = $query->orderBy('name')->get();

        // Hitung Statistik
        $statistik = [
            'total_wali_kelas' => $waliKelas->count(),
            'dengan_kelas' => $waliKelas->where('kelas', '!=', null)->count(),
        ];

        // Ambil daftar kelas yang ada
        $kelasList = User::where('role', 'wali_kelas')
            ->whereNotNull('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        // Generate PDF
        $periode = $this->getPeriodeText($request);

        $pdf = PDF::loadView('laporan.pdf.wali-kelas', compact('waliKelas', 'statistik', 'kelasList', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Data_Wali_Kelas_' . date('Y-m-d_His') . '.pdf');
    }

     /*
    |--------------------------------------------------------------------------
    | Laporan Manajemen User
    |--------------------------------------------------------------------------
    */

    public function laporanUser(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Filter berdasarkan periode registrasi
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'bulan':
                    if ($request->filled('bulan') && $request->filled('tahun')) {
                        $query->whereMonth('created_at', $request->bulan)
                              ->whereYear('created_at', $request->tahun);
                    }
                    break;
                case 'tahun':
                    if ($request->filled('tahun')) {
                        $query->whereYear('created_at', $request->tahun);
                    }
                    break;
            }
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        // Hitung Statistik
        $statistik = [
            'total_user' => $users->count(),
            'admin' => $users->where('role', 'admin')->count(),
            'guru' => $users->where('role', 'guru')->count(),
            'siswa' => $users->where('role', 'siswa')->count(),
            'aktif' => $users->where('is_active', 1)->count(),
            'tidak_aktif' => $users->where('is_active', 0)->count(),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.user', compact('users', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Manajemen_User_' . date('Y-m-d_His') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | Laporan Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function laporanTindakLanjutAwal(Request $request)
    {
        $query = TindakLanjutAwal::with(['pengaduan.user', 'waliKelas']);
        
        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'hari':
                    if ($request->filled('tanggal')) {
                        $query->whereDate('created_at', $request->tanggal);
                    } else {
                        $query->whereDate('created_at', Carbon::today());
                    }
                    break;
                case 'bulan':
                    if ($request->filled('bulan') && $request->filled('tahun')) {
                        $query->whereMonth('created_at', $request->bulan)
                              ->whereYear('created_at', $request->tahun);
                    } else {
                        $query->whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year);
                    }
                    break;
                case 'tahun':
                    if ($request->filled('tahun')) {
                        $query->whereYear('created_at', $request->tahun);
                    } else {
                        $query->whereYear('created_at', Carbon::now()->year);
                    }
                    break;
            }
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tindakLanjutAwal = $query->orderBy('created_at', 'desc')->get();

        // Hitung Statistik
        $statistik = [
            'total' => $tindakLanjutAwal->count(),
            'diproses' => $tindakLanjutAwal->where('status', 'diproses')->count(),
            'selesai' => $tindakLanjutAwal->where('status', 'selesai')->count(),
            'direkomendasi_bk' => $tindakLanjutAwal->where('status', 'direkomendasi_bk')->count(),
        ];

        // Generate PDF
        $periode = $this->getPeriodeText($request);
        
        $pdf = PDF::loadView('laporan.pdf.tindak-lanjut-awal', compact('tindakLanjutAwal', 'statistik', 'periode'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Tindak_Lanjut_Awal_' . date('Y-m-d_His') . '.pdf');
    }

     /*
    |--------------------------------------------------------------------------
    | Helper Get Periode Text
    |--------------------------------------------------------------------------
    */

    // Helper function untuk text periode
    private function getPeriodeText($request)
    {
        if (!$request->filled('periode')) {
            return 'Semua Periode';
        }

        // Array nama bulan 
        $bulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        switch ($request->periode) {
            case 'hari':
                $tanggal = $request->filled('tanggal') ? $request->tanggal : Carbon::today()->format('Y-m-d');
                $date = Carbon::parse($tanggal);
                return 'Tanggal ' . $date->day . ' ' . $bulanIndonesia[$date->month] . ' ' . $date->year;
            case 'bulan':
                $bulan = $request->filled('bulan') ? $request->bulan : Carbon::now()->month;
                $tahun = $request->filled('tahun') ? $request->tahun : Carbon::now()->year;
                return $bulanIndonesia[$bulan] . ' ' . $tahun;
            case 'tahun':
                $tahun = $request->filled('tahun') ? $request->tahun : Carbon::now()->year;
                return 'Tahun ' . $tahun;
            default:
                return 'Semua Periode';
        }
    }
}