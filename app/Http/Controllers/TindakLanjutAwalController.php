<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjutAwal;
use App\Models\Pengaduan;
use App\Models\User;
use App\Notifications\TindakLanjutAwalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Controller Tindak Lanjut Awal
|--------------------------------------------------------------------------
*/
class TindakLanjutAwalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Index Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }
        
        // Ambil kelas wali kelas
        $kelasWali = $user->kelas;
        
        // Ambil pengaduan yang sudah disetujui dari kelas wali kelas ini
        $query = TindakLanjutAwal::with('pengaduan')
            ->whereHas('pengaduan', function($q) use ($kelasWali) {
                $q->where('status', 'disetujui')
                  ->where(function($q2) use ($kelasWali) {
                      $q2->where('victim_class', $kelasWali)
                         ->orWhere('perpetrator_class', $kelasWali);
                  });
            })
            ->latest('created_at');
        
        // Mapping data untuk tampilan
        $tindakLanjutAwal = $query->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nomor_laporan' => $item->pengaduan->nomor_laporan ?? '-',
                    'tanggal_laporan' => $item->pengaduan->created_at
                                        ? $item->pengaduan->created_at->format('d-m-Y')
                                        : '-',
                    'tanggal_tindak_lanjut' => $item->tanggal_tindak_lanjut_awal 
                        ? \Carbon\Carbon::parse($item->tanggal_tindak_lanjut_awal)->format('d-m-Y') 
                        : '-',
                    'pelapor' => $item->pengaduan->reporter_name ?? '-',
                    'korban' => $item->pengaduan->victim_name ?? '-',
                    'status' => $item->status,
                    'pengaduan_id' => $item->pengaduan_id,
                    'created_at' => $item->created_at->format('d-m-Y H:i'),
                ];
            });

        // Hitung statistik
        $total = $tindakLanjutAwal->count();
        $diproses = $tindakLanjutAwal->where('status', 'diproses')->count();
        $selesai = $tindakLanjutAwal->where('status', 'selesai')->count();
        $direkomendasi = $tindakLanjutAwal->where('status', 'direkomendasi_bk')->count();

        return view('tindak-lanjut-awal.index', compact('tindakLanjutAwal', 'total', 'diproses', 'selesai', 'direkomendasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Create Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Jika tidak ada pengaduan_id, redirect ke index
        if (!$request->pengaduan_id) {
            return redirect()->route('tindak-lanjut-awal.index');
        }

        // Ambil data pengaduan beserta tindak lanjut awal jika ada
        $pengaduan = Pengaduan::with('tindakLanjutAwal')
            ->findOrFail($request->pengaduan_id);

        // Cek apakah sudah ada tindak lanjut awal dan load relationships
        $tindakLanjutAwal = TindakLanjutAwal::with(['korban', 'pelaku'])
            ->where('pengaduan_id', $pengaduan->id)
            ->first();

        return view('tindak-lanjut-awal.create', compact('pengaduan', 'tindakLanjutAwal'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Validasi input
        $validated = $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'tanggal_tindak_lanjut_awal' => 'required|date', 
            'catatan' => 'nullable|string',
            'panggil_korban_id' => 'nullable|exists:users,id',
            'panggil_pelaku_id' => 'nullable|exists:users,id|different:panggil_korban_id',
            'status' => 'required|in:diproses,selesai,direkomendasi_bk',
        ], [
            'panggil_pelaku_id.different' => 'Pelaku dan korban tidak boleh sama.',
            'tanggal_tindak_lanjut_awal.required' => 'Tanggal tindak lanjut awal harus diisi.',
        ]);

        // Validasi tambahan: pelaku dan korban tidak boleh sama
        if ($request->panggil_korban_id && $request->panggil_pelaku_id && $request->panggil_korban_id === $request->panggil_pelaku_id) {
            return back()->withErrors(['panggil_pelaku_id' => 'Pelaku dan korban tidak boleh sama.'])->withInput();
        }

        // Cek apakah sudah ada tindak lanjut awal untuk pengaduan ini
        $tindakLanjutAwal = TindakLanjutAwal::where('pengaduan_id', $request->pengaduan_id)->first();

        // Tentukan status berdasarkan flow: pertama kali harus 'diproses'
        $status = $request->status;
        if (!$tindakLanjutAwal) {
            // Baru pertama kali, set status ke diproses (kecuali direkomendasi ke BK)
            if ($status !== 'direkomendasi_bk') {
                $status = 'diproses';
            }
        }

        // Set rekomendasi_bk berdasarkan status
        $rekomendasiBk = ($status === 'direkomendasi_bk');

        // Data untuk simpan
        $data = [
            'pengaduan_id' => $request->pengaduan_id,
            'user_id' => $user->id,
            'tanggal_tindak_lanjut_awal' => $request->tanggal_tindak_lanjut_awal, 
            'catatan' => $request->catatan,
            'panggil_korban_id' => $request->panggil_korban_id,
            'panggil_pelaku_id' => $request->panggil_pelaku_id,
            'rekomendasi_bk' => $rekomendasiBk,
            'status' => $status,
        ];

        // Ambil data pengaduan
        $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);
        $isNewRecord = !$tindakLanjutAwal;

        // Simpan atau update data
        if ($tindakLanjutAwal) {
            // Update
            $tindakLanjutAwal->update($data);
            $message = 'Data tindak lanjut awal berhasil diperbarui!';
        } else {
            // Create
            $tindakLanjutAwal = TindakLanjutAwal::create($data);
            $message = 'Data tindak lanjut awal berhasil disimpan!';
        }

        // Kirim notifikasi ke korban dan pelaku jika status diproses
        if ($status === 'diproses') {
            // Kirim notifikasi ke korban
            if ($request->panggil_korban_id) {
                $korban = User::find($request->panggil_korban_id);
                if ($korban) {
                    $korban->notify(new TindakLanjutAwalNotification(
                        $tindakLanjutAwal,
                        $pengaduan,
                        'korban',
                        $request->catatan
                    ));
                }
            }

            // Kirim notifikasi ke pelaku
            if ($request->panggil_pelaku_id) {
                $pelaku = User::find($request->panggil_pelaku_id);
                if ($pelaku) {
                    $pelaku->notify(new TindakLanjutAwalNotification(
                        $tindakLanjutAwal,
                        $pengaduan,
                        'pelaku',
                        $request->catatan
                    ));
                }
            }
        }

        // Kirim notifikasi ke guru BK jika direkomendasi ke BK
        if ($status === 'direkomendasi_bk') {
            $guruBk = User::where('role', 'guru_bk')->get();
            \Illuminate\Support\Facades\Notification::send($guruBk, new \App\Notifications\PengaduanDirekomendasiNotification(
                $tindakLanjutAwal,
                $pengaduan,
                $request->catatan
            ));
        }

        return redirect()->route('tindak-lanjut-awal.index')->with('success', $message);
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Detail Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Ambil data tindak lanjut awal beserta relasi
        $tindakLanjutAwal = TindakLanjutAwal::with(['pengaduan', 'korban', 'pelaku'])->findOrFail($id);

        return view('tindak-lanjut-awal.show', compact('tindakLanjutAwal'));
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Edit Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Ambil data tindak lanjut awal beserta relasi
        $tindakLanjutAwal = TindakLanjutAwal::with(['pengaduan', 'korban', 'pelaku'])->findOrFail($id);
        $pengaduan = $tindakLanjutAwal->pengaduan;

        // Ambil daftar siswa untuk dropdown
        $siswaList = User::where('role', 'siswa')->get();

        return view('tindak-lanjut-awal.edit', compact('tindakLanjutAwal', 'pengaduan', 'siswaList'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Validasi input
        $validated = $request->validate([
            'tanggal_tindak_lanjut_awal' => 'required|date',
            'catatan' => 'nullable|string',
            'panggil_korban_id' => 'nullable|exists:users,id',
            'panggil_pelaku_id' => 'nullable|exists:users,id|different:panggil_korban_id',
            'status' => 'required|in:diproses,selesai,direkomendasi_bk',
        ], [
            'panggil_pelaku_id.different' => 'Pelaku dan korban tidak boleh sama.',
            'tanggal_tindak_lanjut_awal.required' => 'Tanggal tindak lanjut awal harus diisi.',
        ]);

        // Validasi tambahan: pelaku dan korban tidak boleh sama
        $tindakLanjutAwal = TindakLanjutAwal::findOrFail($id);
        $pengaduan = $tindakLanjutAwal->pengaduan;

        // Set rekomendasi_bk berdasarkan status
        $rekomendasiBk = ($request->status === 'direkomendasi_bk');

        // Data untuk update
        $data = [
            'tanggal_tindak_lanjut_awal' => $request->tanggal_tindak_lanjut_awal,
            'catatan' => $request->catatan,
            'panggil_korban_id' => $request->panggil_korban_id,
            'panggil_pelaku_id' => $request->panggil_pelaku_id,
            'rekomendasi_bk' => $rekomendasiBk,
            'status' => $request->status,
        ];

        // Update data
        $tindakLanjutAwal->update($data);

        // Kirim notifikasi ke korban dan pelaku jika status diproses
        if ($request->status === 'diproses') {
            // Kirim notifikasi ke korban (jika baru dipilih)
            if ($request->panggil_korban_id) {
                $korban = User::find($request->panggil_korban_id);
                if ($korban) {
                    $korban->notify(new TindakLanjutAwalNotification(
                        $tindakLanjutAwal,
                        $pengaduan,
                        'korban',
                        $request->catatan
                    ));
                }
            }

            // Kirim notifikasi ke pelaku (jika baru dipilih)
            if ($request->panggil_pelaku_id) {
                $pelaku = User::find($request->panggil_pelaku_id);
                if ($pelaku) {
                    $pelaku->notify(new TindakLanjutAwalNotification(
                        $tindakLanjutAwal,
                        $pengaduan,
                        'pelaku',
                        $request->catatan
                    ));
                }
            }
        }

        // Kirim notifikasi ke guru BK jika direkomendasi ke BK
        if ($request->status === 'direkomendasi_bk') {
            $guruBk = User::where('role', 'guru_bk')->get();
            \Illuminate\Support\Facades\Notification::send($guruBk, new \App\Notifications\PengaduanDirekomendasiNotification(
                $tindakLanjutAwal,
                $pengaduan,
                $request->catatan
            ));
        }

        return redirect()->route('tindak-lanjut-awal.show', $id)->with('success', 'Data tindak lanjut awal berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Tindak Lanjut Awal
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        //  Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Hapus data tindak lanjut awal
        $tindakLanjutAwal = TindakLanjutAwal::findOrFail($id);
        $tindakLanjutAwal->delete();

        return redirect()->route('tindak-lanjut-awal.index')->with('success', 'Data tindak lanjut awal berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Selesaikan Kasus
    |--------------------------------------------------------------------------
    */
    public function selesai($id)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Ambil data tindak lanjut awal beserta relasi
        $tindakLanjutAwal = TindakLanjutAwal::with(['pengaduan', 'korban', 'pelaku'])->findOrFail($id);
        
        // Hanya bisa diselesaikan jika statusnya masih diproses
        if ($tindakLanjutAwal->status !== 'diproses') {
            return redirect()->route('tindak-lanjut-awal.index')->with('error', 'Kasus ini tidak bisa diselesaikan karena statusnya sudah ' . $tindakLanjutAwal->status);
        }

        // Ambil data pengaduan
        $pengaduan = $tindakLanjutAwal->pengaduan;

        return view('tindak-lanjut-awal.selesai', compact('tindakLanjutAwal', 'pengaduan'));
    }

    /*
    |--------------------------------------------------------------------------
    | Proses Selesaikan Kasus
    |--------------------------------------------------------------------------
    */
    public function selesaikan(Request $request, $id)
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Hanya wali kelas yang bisa akses
        if ($user->role !== 'wali_kelas') {
            abort(403, 'Unauthorized');
        }

        // Validasi input
        $validated = $request->validate([
            'catatan_penyelesaian' => 'required|string|min:10',
        ], [
            'catatan_penyelesaian.required' => 'Catatan penyelesaian harus diisi.',
            'catatan_penyelesaian.min' => 'Catatan penyelesaian minimal 10 karakter.',
        ]);

        // Ambil data tindak lanjut awal
        $tindakLanjutAwal = TindakLanjutAwal::findOrFail($id);
        
        // Update status dan catatan
        $tindakLanjutAwal->update([
            'status' => 'selesai',
            'catatan' => $tindakLanjutAwal->catatan . "\n\n=== PENYELESAIAN KASUS ===\n" . $validated['catatan_penyelesaian'],
        ]);

        return redirect()->route('tindak-lanjut-awal.index')->with('success', 'Kasus berhasil diselesaikan!');
    }
}