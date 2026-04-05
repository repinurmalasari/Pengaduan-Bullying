<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Search Controller
|--------------------------------------------------------------------------
*/

class SearchController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pencarian Global Berdasarkan Role User
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $user = Auth::user();
        $results = [];
        
        /*
        |--------------------------------------------------------------------------
        | Log Pencarian
        |--------------------------------------------------------------------------
        */
        Log::info('Search Request', [
            'query' => $query,
            'user_id' => $user->id,
            'user_role' => $user->role
        ]);
        
        /*
        |--------------------------------------------------------------------------
        | Validasi Panjang Query
        |--------------------------------------------------------------------------
        */

        // Ubah dari 2 jadi 1 untuk lebih fleksibel
        if (strlen($query) < 1) {
            Log::info('Query too short');
            return response()->json(['results' => []]);
        }
        
        /*
        |--------------------------------------------------------------------------
        | Pencarian Menu
        |--------------------------------------------------------------------------
        */

        $menuItems = $this->searchMenuItems($query, $user);
        Log::info('Menu Items Found', ['count' => count($menuItems)]);
        
        if (!empty($menuItems)) {
            $results['menu'] = [
                'label' => 'Menu',
                'items' => $menuItems
            ];
        }
        
        /*
        |--------------------------------------------------------------------------
        | Pencarian Berdasarkan Role
        |--------------------------------------------------------------------------
        */
        // Sesuaikan hasil pencarian berdasarkan role user
        switch ($user->role) {
            case 'siswa':
                $pengaduanResults = $this->searchPengaduanSiswa($query, $user);
                if (!empty($pengaduanResults)) {
                    $results['pengaduan'] = [
                        'label' => 'Pengaduan Saya',
                        'items' => $pengaduanResults
                    ];
                }
                break;

            case 'wali_kelas':
                $pengaduanResults = $this->searchPengaduanWaliKelas($query, $user);
                if (!empty($pengaduanResults)) {
                    $results['pengaduan'] = [
                        'label' => 'Data Pengaduan',
                        'items' => $pengaduanResults
                    ];
                }
                
                // Siswa dari kelas wali kelas tersebut
                $siswaResults = $this->searchSiswaWaliKelas($query, $user);
                if (!empty($siswaResults)) {
                    $results['siswa'] = [
                        'label' => 'Data Siswa',
                        'items' => $siswaResults
                    ];
                }
                
                // Tindak lanjut dari pengaduan di kelas wali kelas tersebut
                $tindakLanjutResults = $this->searchTindakLanjut($query, $user);
                if (!empty($tindakLanjutResults)) {
                    $results['tindak_lanjut'] = [
                        'label' => 'Tindak Lanjut',
                        'items' => $tindakLanjutResults
                    ];
                }
                break;
            
            case 'guru_bk':
                $pengaduanResults = $this->searchPengaduanGuruBK($query);
                if (!empty($pengaduanResults)) {
                    $results['pengaduan'] = [
                        'label' => 'Data Pengaduan',
                        'items' => $pengaduanResults
                    ];
                }
                
                // Siswa secara umum
                $siswaResults = $this->searchAllSiswa($query);
                if (!empty($siswaResults)) {
                    $results['siswa'] = [
                        'label' => 'Data Siswa',
                        'items' => $siswaResults
                    ];
                }
                
                // Tindak lanjut secara umum
                $tindakLanjutResults = $this->searchTindakLanjut($query);
                if (!empty($tindakLanjutResults)) {
                    $results['tindak_lanjut'] = [
                        'label' => 'Tindak Lanjut',
                        'items' => $tindakLanjutResults
                    ];
                }
                break;
                
            case 'admin':
                $pengaduanResults = $this->searchAllPengaduan($query);
                if (!empty($pengaduanResults)) {
                    $results['pengaduan'] = [
                        'label' => 'Data Pengaduan',
                        'items' => $pengaduanResults
                    ];
                }
                
                // Siswa secara umum
                $siswaResults = $this->searchAllSiswa($query);
                if (!empty($siswaResults)) {
                    $results['siswa'] = [
                        'label' => 'Data Siswa',
                        'items' => $siswaResults
                    ];
                }
                
                // Guru BK dan Wali Kelas
                $guruResults = $this->searchGuru($query);
                if (!empty($guruResults)) {
                    $results['guru'] = [
                        'label' => 'Data Guru',
                        'items' => $guruResults
                    ];
                }
                
                // Users secara umum
                $userResults = $this->searchUsers($query);
                if (!empty($userResults)) {
                    $results['users'] = [
                        'label' => 'Data User',
                        'items' => $userResults
                    ];
                }
                break;
                
            case 'kepala_sekolah':
                $pengaduanResults = $this->searchAllPengaduan($query);
                if (!empty($pengaduanResults)) {
                    $results['pengaduan'] = [
                        'label' => 'Data Pengaduan',
                        'items' => $pengaduanResults
                    ];
                }
                break;
        }
        
        Log::info('Search Results', [
            'total_categories' => count($results),
            'categories' => array_keys($results)
        ]);
        
        return response()->json(['results' => $results]);
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Menu
    |--------------------------------------------------------------------------
    */
    private function searchMenuItems($query, $user)
    {
        $menus = [];
        
        /*
        |--------------------------------------------------------------------------
        | Menu Umum untuk Semua Role
        |--------------------------------------------------------------------------
        */
        $menus[] = ['name' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'home', 'keywords' => 'dashboard beranda home'];
        $menus[] = ['name' => 'Profile', 'url' => route('profile.index'), 'icon' => 'user', 'keywords' => 'profile profil akun account'];
        $menus[] = ['name' => 'Bantuan', 'url' => route('bantuan.index'), 'icon' => 'question-circle', 'keywords' => 'bantuan help faq'];
        
       /*
        |--------------------------------------------------------------------------
        | Menu Berdasarkan Role
        |--------------------------------------------------------------------------
        */
        switch ($user->role) {
            case 'siswa':
                $menus[] = ['name' => 'Data Pengaduan', 'url' => route('buat-pengaduan.index'), 'icon' => 'file-alt', 'keywords' => 'pengaduan laporan data buat'];
                $menus[] = ['name' => 'Riwayat Pengaduan', 'url' => route('riwayat-pengaduan'), 'icon' => 'history', 'keywords' => 'riwayat history pengaduan'];
                break;
                
            case 'wali_kelas':
                $menus[] = ['name' => 'Data Pengaduan', 'url' => route('pengaduan.index'), 'icon' => 'file-alt', 'keywords' => 'pengaduan laporan bullying data'];
                $menus[] = ['name' => 'Data Tindak Lanjut Awal', 'url' => route('tindak-lanjut-awal.index'), 'icon' => 'clipboard-check', 'keywords' => 'tindak lanjut awal wali'];
                $menus[] = ['name' => 'Data Tindak Lanjut', 'url' => route('tindak-lanjut.index'), 'icon' => 'tasks', 'keywords' => 'tindak lanjut follow up'];
                $menus[] = ['name' => 'Data Siswa', 'url' => route('siswa.index'), 'icon' => 'users', 'keywords' => 'siswa murid student'];
                break;
                
            case 'guru_bk':
                $menus[] = ['name' => 'Data Pengaduan', 'url' => route('pengaduan.index'), 'icon' => 'file-alt', 'keywords' => 'pengaduan laporan bullying data'];
                $menus[] = ['name' => 'Data Tindak Lanjut', 'url' => route('tindak-lanjut.index'), 'icon' => 'tasks', 'keywords' => 'tindak lanjut follow up'];
                $menus[] = ['name' => 'Data Siswa', 'url' => route('siswa.index'), 'icon' => 'users', 'keywords' => 'siswa murid student'];
                break;
                
            case 'admin':
                $menus[] = ['name' => 'Data Pengaduan', 'url' => route('pengaduan.index'), 'icon' => 'file-alt', 'keywords' => 'pengaduan laporan bullying data'];
                $menus[] = ['name' => 'Data Siswa', 'url' => route('siswa.index'), 'icon' => 'users', 'keywords' => 'siswa murid student'];
                $menus[] = ['name' => 'Data Guru BK', 'url' => route('guru.index'), 'icon' => 'chalkboard-teacher', 'keywords' => 'guru bk konseling'];
                $menus[] = ['name' => 'Data Wali Kelas', 'url' => route('wali-kelas.index'), 'icon' => 'user-tie', 'keywords' => 'wali kelas homeroom'];
                $menus[] = ['name' => 'Laporan', 'url' => route('laporan.index'), 'icon' => 'chart-bar', 'keywords' => 'laporan report statistik'];
                $menus[] = ['name' => 'Manajemen User', 'url' => route('users.index'), 'icon' => 'users-cog', 'keywords' => 'user manajemen pengguna'];
                $menus[] = ['name' => 'Dokumentasi', 'url' => route('dokumentasi.index'), 'icon' => 'book', 'keywords' => 'dokumentasi docs'];
                break;
                
            case 'kepala_sekolah':
                $menus[] = ['name' => 'Data Pengaduan', 'url' => route('pengaduan.index'), 'icon' => 'file-alt', 'keywords' => 'pengaduan laporan bullying data'];
                $menus[] = ['name' => 'Laporan', 'url' => route('laporan.index'), 'icon' => 'chart-bar', 'keywords' => 'laporan report statistik'];
                break;
        }
        
        /*
        |--------------------------------------------------------------------------
        | Filter Menu Berdasarkan Query 
        |--------------------------------------------------------------------------
        */

        $query = strtolower($query);
        $filtered = array_values(array_filter($menus, function($menu) use ($query) {
            return str_contains(strtolower($menu['name']), $query) || 
                   str_contains(strtolower($menu['keywords']), $query);
        }));
        
        Log::info('Menu Filter', [
            'query' => $query,
            'total_menus' => count($menus),
            'filtered_count' => count($filtered)
        ]);
        
        return $filtered;
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Pengaduan Siswa
    |--------------------------------------------------------------------------
    */
    private function searchPengaduanSiswa($query, $user)
    {
        try {
            return Pengaduan::where('user_id', $user->id)
                ->where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                      ->orWhere('deskripsi', 'like', "%{$query}%")
                      ->orWhere('lokasi', 'like', "%{$query}%");
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->judul ?? 'Pengaduan #' . $item->id,
                        'url' => route('buat-pengaduan.show', $item->id),
                        'icon' => 'file-alt',
                        'subtitle' => ucfirst($item->status) . ' - ' . $item->created_at->format('d/m/Y')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching pengaduan siswa', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Pengaduan Wali Kelas
    |--------------------------------------------------------------------------
    */  
    private function searchPengaduanWaliKelas($query, $user)
    {
        try {
            return Pengaduan::where('status', 'disetujui')
                ->where(function($q) use ($user) {
                    $q->whereHas('korban', function($sq) use ($user) {
                        $sq->where('kelas', $user->kelas);
                    })->orWhereHas('pelaku', function($sq) use ($user) {
                        $sq->where('kelas', $user->kelas);
                    });
                })
                ->where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                      ->orWhere('deskripsi', 'like', "%{$query}%")
                      ->orWhereHas('korban', function($sq) use ($query) {
                          $sq->where('name', 'like', "%{$query}%");
                      })
                      ->orWhereHas('pelaku', function($sq) use ($query) {
                          $sq->where('name', 'like', "%{$query}%");
                      });
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->judul ?? 'Pengaduan #' . $item->id,
                        'url' => route('pengaduan.show', $item->id),
                        'icon' => 'file-alt',
                        'subtitle' => 'Korban: ' . ($item->korban->name ?? '-')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching pengaduan wali kelas', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Pengaduan Guru BK
    |--------------------------------------------------------------------------
    */
    private function searchPengaduanGuruBK($query)
    {
        try {
            return Pengaduan::whereHas('tindakLanjutAwal', function($q) {
                    $q->where('status', 'direkomendasi_bk');
                })
                ->where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                      ->orWhere('deskripsi', 'like', "%{$query}%")
                      ->orWhereHas('korban', function($sq) use ($query) {
                          $sq->where('name', 'like', "%{$query}%");
                      });
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->judul ?? 'Pengaduan #' . $item->id,
                        'url' => route('pengaduan.show', $item->id),
                        'icon' => 'file-alt',
                        'subtitle' => 'Korban: ' . ($item->korban->name ?? '-')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching pengaduan guru BK', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Semua Pengaduan
    |--------------------------------------------------------------------------
    */
    private function searchAllPengaduan($query)
    {
        try {
            return Pengaduan::where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                      ->orWhere('deskripsi', 'like', "%{$query}%")
                      ->orWhereHas('korban', function($sq) use ($query) {
                          $sq->where('name', 'like', "%{$query}%");
                      })
                      ->orWhereHas('pelaku', function($sq) use ($query) {
                          $sq->where('name', 'like', "%{$query}%");
                      });
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->judul ?? 'Pengaduan #' . $item->id,
                        'url' => route('pengaduan.show', $item->id),
                        'icon' => 'file-alt',
                        'subtitle' => ucfirst($item->status) . ' - ' . $item->created_at->format('d/m/Y')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching all pengaduan', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Siswa Wali Kelas
    |--------------------------------------------------------------------------
    */
    private function searchSiswaWaliKelas($query, $user)
    {
        try {
            return User::where('role', 'siswa')
                ->where('kelas', $user->kelas)
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('email', 'like', "%{$query}%")
                      ->orWhere('nip', 'like', "%{$query}%");
                })
                ->orderBy('name', 'asc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->name,
                        'url' => route('siswa.show', $item->id),
                        'icon' => 'user-graduate',
                        'subtitle' => 'NIS: ' . ($item->nip ?? '-') . ' | ' . ($item->kelas ?? '-')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching siswa wali kelas', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Semua Siswa
    |--------------------------------------------------------------------------
    */
    private function searchAllSiswa($query)
    {
        try {
            return User::where('role', 'siswa')
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('email', 'like', "%{$query}%")
                      ->orWhere('nip', 'like', "%{$query}%")
                      ->orWhere('kelas', 'like', "%{$query}%");
                })
                ->orderBy('name', 'asc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->name,
                        'url' => route('siswa.show', $item->id),
                        'icon' => 'user-graduate',
                        'subtitle' => 'NIS: ' . ($item->nip ?? '-') . ' | ' . ($item->kelas ?? '-')
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching all siswa', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Guru
    |--------------------------------------------------------------------------
    */
    private function searchGuru($query)
    {
        try {
            return User::whereIn('role', ['guru_bk', 'wali_kelas'])
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('email', 'like', "%{$query}%")
                      ->orWhere('nip', 'like', "%{$query}%");
                })
                ->orderBy('name', 'asc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->name,
                        'url' => route('guru.show', $item->id),
                        'icon' => 'chalkboard-teacher',
                        'subtitle' => 'NIP: ' . ($item->nip ?? '-') . ' | ' . ucfirst(str_replace('_', ' ', $item->role))
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching guru', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
     /*
    |--------------------------------------------------------------------------
    | Pencarian Users
    |--------------------------------------------------------------------------
    */
    private function searchUsers($query)
    {
        try {
            return User::where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('email', 'like', "%{$query}%")
                      ->orWhere('role', 'like', "%{$query}%");
                })
                ->orderBy('name', 'asc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => $item->name,
                        'url' => route('users.edit', $item->id),
                        'icon' => 'user',
                        'subtitle' => ucfirst(str_replace('_', ' ', $item->role)) . ' - ' . $item->email
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching users', ['error' => $e->getMessage()]);
            return [];
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pencarian Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    private function searchTindakLanjut($query, $user = null)
    {
        try {
            $queryBuilder = TindakLanjut::where(function($q) use ($query) {
                    $q->where('jenis_tindakan', 'like', "%{$query}%")
                      ->orWhere('deskripsi_rencana', 'like', "%{$query}%")
                      ->orWhereHas('pengaduan', function($sq) use ($query) {
                          $sq->where('judul', 'like', "%{$query}%");
                      });
                });
            
            /*
            |--------------------------------------------------------------------------
            | Filter untuk Wali Kelas hanya kelasnya sendiri
            |--------------------------------------------------------------------------
            */
            if ($user && $user->role === 'wali_kelas') {
                $queryBuilder->whereHas('pengaduan', function($q) use ($user) {
                    $q->where(function($sq) use ($user) {
                        $sq->whereHas('korban', function($subq) use ($user) {
                            $subq->where('kelas', $user->kelas);
                        })->orWhereHas('pelaku', function($subq) use ($user) {
                            $subq->where('kelas', $user->kelas);
                        });
                    });
                });
            }
            
            return $queryBuilder->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($item) {
                    return [
                        'name' => ucfirst($item->jenis_tindakan) . ' - Pengaduan #' . $item->pengaduan_id,
                        'url' => route('tindak-lanjut.show', $item->id),
                        'icon' => 'tasks',
                        'subtitle' => 'Status: ' . ucfirst($item->status)
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error searching tindak lanjut', ['error' => $e->getMessage()]);
            return [];
        }
    }
}