<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use App\Models\TindakLanjutAwal;
use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Dashboard Controller
|--------------------------------------------------------------------------
*/

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();
        $role = $user->role;

        /*
        |--------------------------------------------------------------------------
        | Inisialisasi Data
        |--------------------------------------------------------------------------
        */

        // Data untuk Cards
        $data = [];
        
        if ($role === 'siswa') {
            /*
            |--------------------------------------------------------------------------
            | Dashboard Siswa
            |--------------------------------------------------------------------------
            */

            // Dashboard Siswa (status konsisten dengan status final)
            $allPengaduan = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])
                ->where('user_id', $user->id)
                ->get();

            $data['total_pengaduan'] = $allPengaduan->count();
            $data['menunggu'] = $allPengaduan->filter(function($p) {
                if ($p->status === 'ditolak') return false;
                if ($p->tindakLanjutAwal) return false;
                if ($p->tindakLanjut) return false;
                if ($p->status === 'disetujui') return false;
                return true;
            })->count();

            $data['diproses'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjut && $p->tindakLanjut->status === 'diproses') return true;
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'diproses') return true;
                return false;
            })->count();

            $data['selesai'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjut && $p->tindakLanjut->status === 'selesai') return true;
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'selesai') return true;
                return false;
            })->count();

            $data['ditolak'] = $allPengaduan->where('status', 'ditolak')->count();

            $data['pengaduan_terbaru'] = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $data['pengaduan_list'] = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $data['chart_data'] = $this->getChartDataSiswa($user->id);

        } elseif ($role === 'guru_bk') {
            /*
            |--------------------------------------------------------------------------
            | Dashboard Guru BK
            |--------------------------------------------------------------------------
            */

            // BASE QUERY PENGADUAN — satu source of truth untuk semua pengaduan BK
            $pengaduanBkQuery = Pengaduan::whereHas('tindakLanjutAwal', function($q) {
                $q->where('status', 'direkomendasi_bk');
            });

            // Ambil semua pengaduan dari base query beserta relasi
            $allPengaduan = (clone $pengaduanBkQuery)
                ->with(['tindakLanjut', 'tindakLanjutAwal', 'user'])
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Statistik Card
            |--------------------------------------------------------------------------
            */

            // --- Stat Cards ---
            $data['total_pengaduan'] = $allPengaduan->count();

            // Menunggu = direkomendasi ke BK tapi belum ada TindakLanjut dari BK
            $data['menunggu'] = $allPengaduan->filter(function($p) {
                return $p->tindakLanjut === null;
            })->count();

            // Ditolak = pengaduan yang statusnya ditolak
            $data['ditolak'] = $allPengaduan->filter(function($p) {
                return $p->status === 'ditolak';
            })->count();

            /*
            |--------------------------------------------------------------------------
            | Statistik Tindak Lanjut BK
            |--------------------------------------------------------------------------
            */

            $pengaduanIds = $allPengaduan->pluck('id');

            $data['total_tindak_lanjut'] = TindakLanjut::whereIn('pengaduan_id', $pengaduanIds)->count();
            $data['tl_direncanakan']     = TindakLanjut::whereIn('pengaduan_id', $pengaduanIds)->where('status', 'direncanakan')->count();
            $data['tl_diproses']         = TindakLanjut::whereIn('pengaduan_id', $pengaduanIds)->where('status', 'diproses')->count();
            $data['tl_selesai']          = TindakLanjut::whereIn('pengaduan_id', $pengaduanIds)->where('status', 'selesai')->count();

            /*
            |--------------------------------------------------------------------------
            | Data Pengaduan dan Tindak Lanjut
            |--------------------------------------------------------------------------
            */

            // Hanya pengaduan yang baru direkomendasi ke BK (status direkomendasi_bk, urut terbaru)
            $data['pengaduan_terbaru'] = Pengaduan::with(['user', 'tindakLanjut', 'tindakLanjutAwal'])
                ->whereHas('tindakLanjutAwal', function($q) {
                    $q->where('status', 'direkomendasi_bk');
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // --- Tabel Tindak Lanjut — scope dari pengaduan yang direkomendasi ---
            $data['tindak_lanjut_list'] = TindakLanjut::with(['pengaduan', 'pengaduan.user'])
                ->whereIn('pengaduan_id', $pengaduanIds)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            // --- Chart — hitung per bulan dari base query ---
            $data['chart_data'] = $this->getChartDataGuruBK();
            
        } elseif ($role === 'wali_kelas') {
            /*
            |--------------------------------------------------------------------------
            | Dashboard Wali Kelas
            |--------------------------------------------------------------------------
            */

            $kelasWali = $user->kelas;
            
            // Query pengaduan yang melibatkan siswa kelas wali kelas
            $pengaduanKelasQuery = Pengaduan::where(function($q) use ($kelasWali) {
                $q->whereHas('user', function($query) use ($kelasWali) {
                    $query->where('kelas', $kelasWali);
                })->orWhere('victim_class', $kelasWali)
                  ->orWhere('perpetrator_class', $kelasWali);
            });
            
            $allPengaduan = (clone $pengaduanKelasQuery)->with(['tindakLanjut', 'tindakLanjutAwal'])->get();

            /*
            |--------------------------------------------------------------------------
            | Statistik Pengaduan Kelas
            |--------------------------------------------------------------------------
            */

            $data['total_pengaduan'] = $allPengaduan->count();

            $data['pengaduan_baru'] = $allPengaduan->filter(function($p) {
                if ($p->status === 'ditolak') return false;
                if ($p->tindakLanjutAwal) return false;
                if ($p->tindakLanjut) return false;
                if ($p->status === 'disetujui') return false;
                return true;
            })->count();
            $data['pengaduan_diproses'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'diproses') return true;
                return false;
            })->count();
            $data['pengaduan_selesai'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'selesai') return true;
                return false;
            })->count();
            $data['pengaduan_direkomendasi_bk'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'direkomendasi_bk') return true;
                return false;
            })->count();
            $data['pengaduan_ditolak'] = $allPengaduan->where('status', 'ditolak')->count();

           /*
            |--------------------------------------------------------------------------
            | Statistik Tindak Lanjut Awal
            |--------------------------------------------------------------------------
            */

            $tlaQuery = TindakLanjutAwal::with('pengaduan')
                ->whereHas('pengaduan', function($q) use ($kelasWali) {
                    $q->where('status', 'disetujui')
                      ->where(function($q2) use ($kelasWali) {
                          $q2->where('victim_class', $kelasWali)
                             ->orWhere('perpetrator_class', $kelasWali);
                      });
                });

            $data['tla_total']          = (clone $tlaQuery)->count();
            $data['tla_diproses']       = (clone $tlaQuery)->where('status', 'diproses')->count();
            $data['tla_selesai']        = (clone $tlaQuery)->where('status', 'selesai')->count();
            $data['tla_direkomendasi']  = (clone $tlaQuery)->where('status', 'direkomendasi_bk')->count();

            $data['siswa_kelas'] = User::where('role', 'siswa')->where('kelas', $kelasWali)->count();

            /*
            |--------------------------------------------------------------------------
            | Data Pengaduan dan Tindak Lanjut Awal
            |--------------------------------------------------------------------------
            */

            // --- Pengaduan terbaru di kelas wali kelas ---
            $data['pengaduan_terbaru'] = Pengaduan::with(['user', 'tindakLanjut', 'tindakLanjutAwal'])
                ->where('status', '!=', 'draf')
                ->where(function($q) use ($kelasWali) {
                    $q->where('victim_class', $kelasWali)
                      ->orWhere('perpetrator_class', $kelasWali);
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $data['tindak_lanjut_awal_terbaru'] = (clone $tlaQuery)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $data['tindak_lanjut_awal_list'] = (clone $tlaQuery)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $data['chart_data'] = $this->getChartDataWaliKelas($kelasWali);
            
        } elseif ($role === 'kepala_sekolah' || $role === 'admin') {
            /*
            |--------------------------------------------------------------------------
            | Dashboard Kepala Sekolah / Admin
            |--------------------------------------------------------------------------
            */

            $allPengaduan = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])->get();

            /*
            |--------------------------------------------------------------------------
            | Statistik Pengaduan
            |--------------------------------------------------------------------------
            */

            $data['total_pengaduan'] = $allPengaduan->count();
            $data['menunggu'] = $allPengaduan->filter(function($p) {
                if ($p->status === 'ditolak') return false;
                if ($p->tindakLanjutAwal) return false;
                if ($p->tindakLanjut) return false;
                if ($p->status === 'disetujui') return false;
                return true;
            })->count();
            $data['diproses'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjut && $p->tindakLanjut->status === 'diproses') return true;
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'diproses') return true;
                return false;
            })->count();
            $data['selesai'] = $allPengaduan->filter(function($p) {
                if ($p->tindakLanjut && $p->tindakLanjut->status === 'selesai') return true;
                if ($p->tindakLanjutAwal && $p->tindakLanjutAwal->status === 'selesai') return true;
                return false;
            })->count();
            $data['ditolak'] = $allPengaduan->where('status', 'ditolak')->count();

            /*
            |--------------------------------------------------------------------------
            | Statistik Tindak Lanjut
            |--------------------------------------------------------------------------
            */
            
            $data['tl_diproses'] = TindakLanjut::where('status', 'diproses')->count();
            $data['tl_selesai'] = TindakLanjut::where('status', 'selesai')->count();
            $data['tla_total'] = TindakLanjutAwal::count();
            $data['tla_diproses'] = TindakLanjutAwal::where('status', 'diproses')->count();
            $data['tla_selesai'] = TindakLanjutAwal::where('status', 'selesai')->count();
            $data['tla_direkomendasi'] = TindakLanjutAwal::where('status', 'direkomendasi_bk')->count();

            /*
            |--------------------------------------------------------------------------
            | Statistik User
            |--------------------------------------------------------------------------
            */

            $data['total_siswa'] = User::where('role', 'siswa')->count();
            $data['total_guru'] = User::whereIn('role', ['guru_bk', 'wali_kelas'])->count();
            $data['total_users'] = User::count();

            /*
            |--------------------------------------------------------------------------
            | Data Pengaduan
            |--------------------------------------------------------------------------
            */

            $data['pengaduan_terbaru'] = Pengaduan::with(['user', 'tindakLanjut', 'tindakLanjutAwal'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $data['pengaduan_list'] = Pengaduan::with(['user', 'tindakLanjut', 'tindakLanjutAwal'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $data['chart_data'] = $this->getChartDataGuruBK();
        }

        $data['role'] = $role;
        return view('dashboard', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Chart Data Siswa
    |--------------------------------------------------------------------------
    */

    private function getChartDataSiswa($user_id)
    {
        $labels = [];
        $data = [];
        $year = 2026;

        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = $bulan_indonesia[$month] . ' ' . $year;

            $count = Pengaduan::where('user_id', $user_id)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $data[] = $count;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /*
    |--------------------------------------------------------------------------
    | Chart Data Guru BK
    |--------------------------------------------------------------------------
    */
    private function getChartDataGuruBK()
    {
        $labels = [];
        $data = [];
        $year = 2026;

        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = $bulan_indonesia[$month] . ' ' . $year;

            // Sama dengan base query di index(): pengaduan yang punya TLA status direkomendasi_bk
            $count = Pengaduan::whereHas('tindakLanjutAwal', function($q) {
                    $q->where('status', 'direkomendasi_bk');
                })
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $data[] = $count;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /*
    |--------------------------------------------------------------------------
    | Chart Data Guru (Referensi)
    |--------------------------------------------------------------------------
    */
    private function getChartDataGuru($user_id)
    {
        $labels = [];
        $data = [];
        $year = 2026;

        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = $bulan_indonesia[$month] . ' ' . $year;

            $count = TindakLanjut::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $data[] = $count;
        }

        return ['labels' => $labels, 'data' => $data];
    }

     /*
    |--------------------------------------------------------------------------
    | Chart Data Wali Kelas
    |--------------------------------------------------------------------------
    */
    private function getChartDataWaliKelas($kelasWali)
    {
        $labels = [];
        $data = [];
        $year = 2026;

        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = $bulan_indonesia[$month] . ' ' . $year;

            $count = TindakLanjutAwal::whereHas('pengaduan', function($q) use ($kelasWali) {
                    $q->where('status', 'disetujui')
                      ->where(function($q2) use ($kelasWali) {
                          $q2->where('victim_class', $kelasWali)
                             ->orWhere('perpetrator_class', $kelasWali);
                      });
                })
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $data[] = $count;
        }

        return ['labels' => $labels, 'data' => $data];
    }
}