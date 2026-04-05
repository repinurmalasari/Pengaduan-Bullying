<?php

namespace App\Http\Controllers;

use App\Notifications\StatusPengaduanNotification;
use App\Models\TindakLanjut;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Tindak Lanjut Controller
|--------------------------------------------------------------------------
*/
class TindakLanjutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Index Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Ambil user yang login
        $user = auth()->user();
        
        // Basis query tindak lanjut dengan relasi pengaduan
        $query = TindakLanjut::with('pengaduan')->latest('created_at');
        
        // Filter untuk wali kelas: hanya tindak lanjut dimana korban ATAU pelaku dari kelasnya
        if ($user->role === 'wali_kelas') {
            $kelasWali = $user->kelas;
            $query->whereHas('pengaduan', function($q) use ($kelasWali) {
                $q->where('victim_class', $kelasWali)
                  ->orWhere('perpetrator_class', $kelasWali);
            });
        }
        
        // Ambil data dan map ke format yang diinginkan
        $tindakLanjut = $query->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nomor_tindakan' => $item->nomor_tindakan,
                    'nomor_laporan' => $item->pengaduan->nomor_laporan ?? '-',
                    'pelapor' => $item->pengaduan->reporter_name ?? '-',
                    'korban' => $item->pengaduan->victim_name ?? '-',
                    'jenis_tindakan' => $this->getJenisTindakan($item->jenis_tindakan),
                    'deskripsi' => $item->deskripsi,
                    'tanggal_tindakan' => $item->tanggal_tindakan->format('d-m-Y'),
                    'status' => $item->status,
                    'pengaduan_id' => $item->pengaduan_id,
                ];
            });

        // Statistik status tindak lanjut
        $total = $tindakLanjut->count();
        $direncanakan = $tindakLanjut->where('status', 'direncanakan')->count();
        $diproses = $tindakLanjut->where('status', 'diproses')->count();
        $selesai = $tindakLanjut->where('status', 'selesai')->count();

        return view('tindak-lanjut.index', compact('tindakLanjut', 'total', 'direncanakan', 'diproses', 'selesai'));
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Create Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        // Pastikan ada pengaduan_id
        if (!$request->pengaduan_id) {
            return redirect()->route('pengaduan.index');
        }

        // Ambil data pengaduan beserta tindak lanjut jika ada
        $pengaduan = Pengaduan::with('tindakLanjut')
            ->findOrFail($request->pengaduan_id);

        // Ambil 1 tindak lanjut jika sudah ada
        $tindakLanjut = TindakLanjut::where('pengaduan_id', $pengaduan->id)->first();

        return view('tindak-lanjut.create', compact('pengaduan', 'tindakLanjut'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'jenis_tindakan' => 'required|in:pembinaan,konseling,skorsing,peringatan,lainnya',
            'deskripsi' => 'required|string',
            'tanggal_tindakan' => 'required|date',
        ]);

        // Tambahkan user_id dari yang login
        $validated['user_id'] = Auth::id();

        // Cek apakah sudah ada tindak lanjut untuk pengaduan ini
        $tindakLanjut = TindakLanjut::where('pengaduan_id', $validated['pengaduan_id'])->first();

        // Jika sudah ada, update. Jika belum, create baru
        if ($tindakLanjut) {
            // Update jika sudah ada
            $tindakLanjut->update($validated);
        } else {
            // Create baru
            $validated['nomor_tindakan'] = 'TL-' . now()->format('YmdHis') . '-' . Str::random(5);
            $validated['status'] = 'direncanakan';

            // Simpan ke database
            $tindak = TindakLanjut::create($validated);

            // Kirim notifikasi ke siswa
            $pengaduan = Pengaduan::find($validated['pengaduan_id']);
            $pengaduan->user->notify(new StatusPengaduanNotification($pengaduan));


        }

        // Redirect ke index
        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Tindak lanjut berhasil disimpan');
    }

   /*
    |--------------------------------------------------------------------------
    | Halaman Detail Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        $tindakLanjut->jenis_tindakan_label = $this->getJenisTindakan($tindakLanjut->jenis_tindakan);
    
    // Redirect ke halaman detail sesuai status
    switch($tindakLanjut->status) {
        case 'direncanakan':
            // Gunakan show.blade.php untuk status direncanakan
            return view('tindak-lanjut.show', compact('tindakLanjut'));
            
        case 'diproses':
            // Gunakan show-proses.blade.php untuk status diproses
            return view('tindak-lanjut.proses.show-proses', compact('tindakLanjut'));
            
        case 'selesai':
            // Gunakan show-selesai.blade.php untuk status selesai
            return view('tindak-lanjut.selesai.show-selesai', compact('tindakLanjut'));
            
        default:
            // Fallback ke show.blade.php jika status tidak dikenali
            return view('tindak-lanjut.show', compact('tindakLanjut'));
    }
}

    /*
    |--------------------------------------------------------------------------
    | Halaman Edit Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);

    // Cegah admin mengedit
    if (Auth::user()->role === 'admin') {
        return redirect()->route('tindak-lanjut.show', $id)
            ->with('error', 'Admin hanya dapat melihat data, tidak dapat mengedit.');
    }

    // Redirect ke halaman edit sesuai status
    if ($tindakLanjut->status === 'direncanakan') {
        return view('tindak-lanjut.edit', compact('tindakLanjut'));
    }

    // Redirect ke halaman edit proses atau selesai jika statusnya sudah berubah
    if ($tindakLanjut->status === 'diproses') {
        return redirect()->route('tindak-lanjut.edit-proses', $id);
    }

    // Redirect ke halaman edit selesai jika statusnya sudah selesai
    if ($tindakLanjut->status === 'selesai') {
        return redirect()->route('tindak-lanjut.edit-selesai', $id);
    }

    // Fallback ke index
    return redirect()->route('tindak-lanjut.index');
}

    /*
    |--------------------------------------------------------------------------
    | Update Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // Ambil data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'jenis_tindakan' => 'required|in:pembinaan,konseling,skorsing,peringatan,lainnya',
            'deskripsi' => 'required|string',
            'tanggal_tindakan' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_tindakan',
            'status' => 'required|in:direncanakan,diproses,selesai',
            'hasil' => 'nullable|string',
            'attachment' => 'nullable|' . upload_validation('tindak_lanjut'),
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('attachment')) {
            // Hapus file lama jika ada
            upload_delete($tindakLanjut->attachment);

            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $validated['attachment'] = upload_store($file, 'tindak_lanjut', $filename);
        }

        // Update data
        $tindakLanjut->update($validated);

        // Redirect ke index
        return redirect()
            ->route('tindak-lanjut.index')
            ->with('success', 'Tindak lanjut berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        // Hapus data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);
        $tindakLanjut->delete();
        
        // Redirect ke index
        return redirect()
            ->route('tindak-lanjut.index')
            ->with('success', 'Tindak lanjut berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Get Label Jenis Tindakan
    |--------------------------------------------------------------------------
    */
    private function getJenisTindakan($type)
    {
        // Daftar jenis tindakan
        $jenis = [
            'pembinaan' => 'Pembinaan',
            'konseling' => 'Konseling',
            'skorsing' => 'Skorsing',
            'peringatan' => 'Peringatan',
            'lainnya' => 'Lainnya',
        ];
        return $jenis[$type] ?? $type;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Label Jenis Bullying
    |--------------------------------------------------------------------------
    */
    private function getJenisBullying($type)
    {
        $jenis = [
            'fisik' => 'Fisik (Kekerasan/Pukulan)',
            'verbal' => 'Verbal (Ejekan/Umpatan)',
            'cyber' => 'Cyber (Media Sosial/Chat)',
            'pengucilan' => 'Pengucilan',
            'intimidasi' => 'Intimidasi',
            'lainnya' => 'Lainnya',
        ];
        return $jenis[$type] ?? $type;
    }

    /*
    |--------------------------------------------------------------------------
    | API & AJAX METHODS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Cek Status Pengaduan (AJAX)
    |--------------------------------------------------------------------------
    */
    public function checkStatus(Request $request)
    {
        // Pastikan ada pengaduan_id
        $pengaduanId = $request->pengaduan_id;
        
        // Cek apakah ada tindak lanjut untuk pengaduan ini
        $tindakLanjut = TindakLanjut::where('pengaduan_id', $pengaduanId)->first();
        
        // Jika ada, kembalikan data tindak lanjut
        if ($tindakLanjut) {
            return response()->json([
                'exists' => true,
                'has_tindak_lanjut' => true,
                'tindak_lanjut_id' => $tindakLanjut->id,
                'status' => $tindakLanjut->status,
                'data' => [
                    'jenis_tindakan' => $tindakLanjut->jenis_tindakan,
                    'deskripsi' => $tindakLanjut->deskripsi,
                    'tanggal_tindakan' => $tindakLanjut->tanggal_tindakan->format('Y-m-d'),
                    'tanggal_selesai' => $tindakLanjut->tanggal_selesai ? $tindakLanjut->tanggal_selesai->format('Y-m-d') : null,
                    'hasil' => $tindakLanjut->hasil,
                    'status_value' => $tindakLanjut->status
                ]
            ]);
        }
        
        // Jika tidak ada tindak lanjut
        return response()->json([
            'exists' => false,
            'has_tindak_lanjut' => false
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FLOW 3 STEP: DIRENCANAKAN → PROSES → SELESAI
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | STEP 2: Halaman Proses Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function proses($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        
        // Pastikan statusnya direncanakan atau diproses
        if (!in_array($tindakLanjut->status, ['direncanakan', 'diproses'])) {
            return redirect()
                ->route('tindak-lanjut.index')
                ->with('error', 'Tindak lanjut ini sudah selesai');
        }
        
        // Tampilkan halaman proses
        return view('tindak-lanjut.proses.proses', compact('tindakLanjut'));
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2: Update Proses
    |--------------------------------------------------------------------------
    */
    public function updateProses(Request $request, $id)
    {
        // Ambil data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'tanggal_mulai_proses' => 'required|date',
            'catatan_proses' => 'required|string|min:10',
            'pihak_terlibat' => 'nullable|string|max:255',
            'kendala' => 'nullable|string',
        ], [
            'tanggal_mulai_proses.required' => 'Tanggal mulai proses harus diisi',
            'catatan_proses.required' => 'Catatan proses harus diisi',
            'catatan_proses.min' => 'Catatan proses minimal 10 karakter',
        ]);

        // Update status ke diproses jika masih direncanakan
        if ($tindakLanjut->status === 'direncanakan') {
            $validated['status'] = 'diproses';
        }

        // Update data
        $tindakLanjut->update($validated);

        // Kirim notifikasi ke siswa
        $pengaduan = $tindakLanjut->pengaduan;
        $pengaduan->user->notify(new StatusPengaduanNotification($pengaduan));


        // REDIRECT LANGSUNG KE INDEX
        return redirect()
            ->route('tindak-lanjut.index')
            ->with('success', 'Data proses berhasil disimpan!');
    }
    /*
    |--------------------------------------------------------------------------
    | STEP 2: Halaman Edit Proses
    |--------------------------------------------------------------------------
    */
    public function editProses($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        
        // Pastikan statusnya diproses
        if ($tindakLanjut->status !== 'diproses') {
            return redirect()
                ->route('tindak-lanjut.index')
                ->with('error', 'Hanya tindak lanjut yang sedang diproses yang bisa diedit');
        }
        
        // Tampilkan halaman edit proses
        return view('tindak-lanjut.proses.edit-proses', compact('tindakLanjut'));
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2: Update dari Edit Proses
    |--------------------------------------------------------------------------
    */
    public function updateProsesEdit(Request $request, $id)
    {
        // Ambil data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'tanggal_mulai_proses' => 'required|date',
            'catatan_proses' => 'required|string|min:10',
            'pihak_terlibat' => 'nullable|string|max:255',
            'kendala' => 'nullable|string',
        ], [
            'tanggal_mulai_proses.required' => 'Tanggal mulai proses harus diisi',
            'catatan_proses.required' => 'Catatan proses harus diisi',
            'catatan_proses.min' => 'Catatan proses minimal 10 karakter',
        ]);

        // Update data
        $tindakLanjut->update($validated);

        return redirect()
            ->route('tindak-lanjut.index')
            ->with('success', 'Data proses berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2: Detail Proses (READ ONLY)
    |--------------------------------------------------------------------------
    */
    public function showProses($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);

    // Pastikan statusnya diproses atau selesai
    if (!in_array($tindakLanjut->status, ['diproses','selesai'])) {
        return redirect()->route('tindak-lanjut.index');
    }

    // Tampilkan halaman detail proses
    return view('tindak-lanjut.proses.show-proses', compact('tindakLanjut'));
}

    /*
    |--------------------------------------------------------------------------
    | STEP 3: Halaman Selesai
    |--------------------------------------------------------------------------
    */
    public function selesai($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        
        // Pastikan statusnya diproses
        if ($tindakLanjut->status !== 'diproses') {
            return redirect()
                ->route('tindak-lanjut.index')
                ->with('error', 'Hanya tindak lanjut yang sedang diproses yang bisa diselesaikan');
        }
        
        // Tampilkan halaman selesai
        return view('tindak-lanjut.selesai.selesai', compact('tindakLanjut'));
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 3: Update Status Selesai
    |--------------------------------------------------------------------------
    */
    public function updateSelesai(Request $request, $id)
    {
        // Ambil data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'tanggal_selesai' => [
            'required',
            'date',
            'after_or_equal:' . ($tindakLanjut->tanggal_mulai_proses ? $tindakLanjut->tanggal_mulai_proses->format('Y-m-d') : $tindakLanjut->tanggal_tindakan->format('Y-m-d'))
        ],
        'hasil' => 'required|string|min:5',
        'evaluasi' => 'nullable|string',
        'status_hasil' => 'required|in:berhasil,cukup_berhasil,perlu_tindak_lanjut',

    ], [
        'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai proses',
        'hasil.required' => 'Hasil tindakan harus diisi',
        'status_hasil.required' => 'Status hasil harus dipilih',
    ]);

    // Update data
    $tindakLanjut->update([
        'status' => 'selesai',
        'tanggal_selesai' => $validated['tanggal_selesai'],
        'hasil' => $validated['hasil'],
        'evaluasi' => $validated['evaluasi'] ?? null,
        'status_hasil' => $validated['status_hasil'], // Update status_hasil

    ]);

    // Kirim notifikasi ke siswa
    $pengaduan = $tindakLanjut->pengaduan;
    $pengaduan->user->notify(new StatusPengaduanNotification($pengaduan));


    // Redirect ke index
    return redirect()
        ->route('tindak-lanjut.index')
        ->with('success', 'Tindak lanjut berhasil diselesaikan!');
}


    /*
    |--------------------------------------------------------------------------
    | STEP 3: Halaman Edit Selesai
    |--------------------------------------------------------------------------
    */
    public function editSelesai($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        
        // Pastikan statusnya selesai
        if ($tindakLanjut->status !== 'selesai') {
            return redirect()
                ->route('tindak-lanjut.index')
                ->with('error', 'Hanya tindak lanjut yang sudah selesai yang bisa diedit');
        }
        
        // Tampilkan halaman edit selesai
        return view('tindak-lanjut.selesai.edit-selesai', compact('tindakLanjut'));
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 3: Update dari Edit Selesai
    |--------------------------------------------------------------------------
    */
    public function updateSelesaiEdit(Request $request, $id)
    {
        // Ambil data tindak lanjut
        $tindakLanjut = TindakLanjut::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai_proses',
        'hasil' => 'required|string|min:5',
        'evaluasi' => 'nullable|string',
        'status_hasil' => 'required|in:berhasil,cukup_berhasil,perlu_tindak_lanjut',

    ], [
        'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
        'hasil.required' => 'Hasil tindakan harus diisi',
    ]);

    // Update data
    $tindakLanjut->update([
        'tanggal_selesai' => $validated['tanggal_selesai'],
        'hasil' => $validated['hasil'],
        'evaluasi' => $validated['evaluasi'] ?? null,
        'status_hasil' => $validated['status_hasil'], // Update status_hasil

    ]);

    // Redirect ke index
    return redirect()
        ->route('tindak-lanjut.index')
        ->with('success', 'Data selesai berhasil diperbarui!');
}

    /*
    |--------------------------------------------------------------------------
    | STEP 3: Detail Selesai (READ ONLY)
    |--------------------------------------------------------------------------
    */
    public function showSelesai($id)
    {
        // Ambil data tindak lanjut beserta relasi
        $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
        
        // Pastikan statusnya selesai
        if ($tindakLanjut->status !== 'selesai') {
            return redirect()
                ->route('tindak-lanjut.index')
                ->with('error', 'Hanya tindak lanjut yang sudah selesai yang dapat dilihat detailnya');
        }
        
        // Tampilkan halaman detail selesai
        return view('tindak-lanjut.selesai.show-selesai', compact('tindakLanjut'));
    }

/*
|--------------------------------------------------------------------------
| Detail Default Tanpa Redirect
|--------------------------------------------------------------------------
*/
public function showDetail($id)
{
    // Ambil data tindak lanjut beserta relasi
    $tindakLanjut = TindakLanjut::with('pengaduan')->findOrFail($id);
    $tindakLanjut->jenis_tindakan_label = $this->getJenisTindakan($tindakLanjut->jenis_tindakan);
    
    // Selalu tampilkan show.blade.php tanpa redirect berdasarkan status
    return view('tindak-lanjut.show', compact('tindakLanjut'));
}

}