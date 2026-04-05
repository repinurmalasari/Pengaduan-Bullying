<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use App\Notifications\PengaduanMasukNotification;
use App\Notifications\StatusPengaduanNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Pengaduan Controller
|--------------------------------------------------------------------------
*/

class PengaduanController extends Controller
{
        /*
    |--------------------------------------------------------------------------
    | Tampilkan Daftar Pengaduan
    |--------------------------------------------------------------------------
    */

    public function index()
{
    $user = auth()->user();

    // SISWA: hanya lihat pengaduan miliknya (bukan draf)
    if ($user->role == 'siswa') {
        $laporan = Pengaduan::with('tindakLanjut')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'draf')
            ->latest()
            ->get();
    }

    // WALI KELAS: hanya lihat pengaduan dimana korban ATAU pelaku dari kelasnya
    else if ($user->role == 'wali_kelas') {

        $kelasWali = $user->kelas; // Ambil kelas wali kelas
        $laporan = Pengaduan::with('tindakLanjut')
            ->where('status', '!=', 'draf')
            ->where(function($query) use ($kelasWali) {

                // Korban atau pelaku dari kelas wali
                $query->where('victim_class', $kelasWali)
                      ->orWhere('perpetrator_class', $kelasWali);
            })
            ->latest()
            ->get();
    }
    // GURU BK: hanya lihat pengaduan yang direkomendasikan ke BK oleh wali kelas
    else if ($user->role == 'guru_bk') {
        $laporan = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])
            ->where('status', '!=', 'draf')
            ->whereHas('tindakLanjutAwal', function($query) {
                $query->where('status', 'direkomendasi_bk');
        })
            ->latest()
            ->get();
    }
    // ADMIN: lihat SEMUA pengaduan (bukan draf)
    else if ($user->role == 'admin') {
        $laporan = Pengaduan::with(['tindakLanjut', 'tindakLanjutAwal'])
            ->where('status', '!=', 'draf')
            ->latest()
            ->get();
    } else {
        abort(403, 'Akses ditolak.');
    }

        /*
        |--------------------------------------------------------------------------
        | Mapping Data dengan Status Final
        |--------------------------------------------------------------------------
        */

    $laporan = $laporan->map(function ($item) {
        // LOGIC STATUS FINAL (PRIORITAS: Ditolak > Tindak Lanjut Awal > Tindak Lanjut > Status Pengaduan)
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

        return [
            'id' => $item->id,
            'nomor_laporan' => $item->nomor_laporan,
            'status' => $item->status, // Status asli pengaduan
            'tindak_lanjut_status' => $item->tindakLanjut?->status, // Status tindak lanjut BK
            'tindak_lanjut_awal_status' => $item->tindakLanjutAwal?->status, // Status tindak lanjut awal wali kelas
            'final_status' => $finalStatus, // ← STATUS FINAL UNTUK DISPLAY
            'prioritas' => $item->urgency,
            'pelapor' => $item->reporter_name,
            'korban' => $item->victim_name,
            'jenis' => $this->getJenisBullying($item->bullying_type),
            'tanggal' => Carbon::parse($item->created_at)->format('d-m-Y'),
            'lokasi' => $item->location,
            'deskripsi' => $item->description,
            'has_tindak_lanjut' => $item->tindakLanjut ? true : false,
            'has_tindak_lanjut_awal' => $item->tindakLanjutAwal ? true : false,
            'tindak_lanjut_id' => $item->tindakLanjut?->id,
            'tindak_lanjut_awal_id' => $item->tindakLanjutAwal?->id,
        ];
    });

    return view('pengaduan.index', [
        'laporan' => $laporan,
        'totalLaporan' => $laporan->count(),
        'menunggu' => $laporan->where('final_status', 'menunggu')->count(),
        'disetujui' => $laporan->where('final_status', 'disetujui')->count(),
        'ditolak' => $laporan->where('final_status', 'ditolak')->count(),
        'direncanakan' => $laporan->where('final_status', 'direncanakan')->count(),
        'diproses' => $laporan->where('final_status', 'diproses')->count(),
        'selesai' => $laporan->where('final_status', 'selesai')->count(),
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Draf Pengaduan
    |--------------------------------------------------------------------------
    */
    public function draf()
    {
        // Selain siswa tidak boleh akses
        if (auth()->user()->role != 'siswa') {
            abort(403, 'Anda tidak punya izin melihat draf.');
        }

        // Ambil pengaduan status draf milik siswa login
        $draf = Pengaduan::where('user_id', auth()->id())
                        ->where('status', 'draf')
                        ->latest()
                        ->get();

        // Format data untuk view (sesuai dengan view draf.blade.php)
        $draf = $draf->map(function ($item) {
            return [
                'id' => $item->id,
                'nomor_laporan' => $item->nomor_laporan,
                'status' => $item->status,
                'prioritas' => $item->urgency ?? 'rendah',
                'pelapor' => $item->reporter_name ?? '-',
                'korban' => $item->victim_name ?? '-',
                'jenis' => $item->bullying_type ? $this->getJenisBullying($item->bullying_type) : '-',
                'tanggal' => $item->incident_date ? Carbon::parse($item->incident_date)->format('d-m-Y') : '-',
            ];
        });

        return view('pengaduan.draf', [
            'draf' => $draf,
            'totalDraf' => $draf->count()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Riwayat Pengaduan (Khusus Siswa)
    |--------------------------------------------------------------------------
    */
    
    public function riwayat()
{
    // Selain siswa tidak boleh akses
    if (auth()->user()->role != 'siswa') {
        abort(403, 'Anda tidak punya izin melihat riwayat.');
    }

    // Ambil SEMUA pengaduan milik siswa (kecuali draf)
    $laporan = Pengaduan::with('tindakLanjut')
                    ->where('user_id', auth()->id())
                    ->where('status', '!=', 'draf')
                    ->latest()
                    ->get();

    // Format data untuk view (status final sama seperti index)
    $laporan = $laporan->map(function ($item) {
                // LOGIC STATUS FINAL (PRIORITAS: Ditolak > Tindak Lanjut Awal > Tindak Lanjut > Status Pengaduan)
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


        return [
            'id' => $item->id,
            'nomor_laporan' => $item->nomor_laporan,
            'status' => $item->status, // status asli
            'final_status' => $finalStatus, // status final untuk display
            'prioritas' => $item->urgency ?? 'rendah',
            'pelapor' => $item->reporter_name ?? '-',
            'korban' => $item->victim_name ?? '-',
            'jenis' => $item->bullying_type ? $this->getJenisBullying($item->bullying_type) : '-',
            'tanggal' => $item->incident_date ? Carbon::parse($item->incident_date)->format('d-m-Y') : '-',
        ];
    });

    return view('pengaduan.riwayat', [
        'laporan' => $laporan,
        'totalLaporan' => $laporan->count(),
        'menunggu' => $laporan->where('status', 'menunggu')->count(),
        'ditolak' => $laporan->where('status', 'ditolak')->count(),
        'disetujui' => $laporan->where('status', 'disetujui')->count(),
        'direncanakan' => $laporan->where('status', 'direncanakan')->count(),
        'diproses' => $laporan->where('status', 'diproses')->count(),
        'selesai' => $laporan->where('status', 'selesai')->count(),
        'draf' => Pengaduan::where('user_id', auth()->id())
                    ->where('status', 'draf')
                    ->count()
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Buat Pengaduan
    |--------------------------------------------------------------------------
    */
    
    public function create()
    {
        // Selain siswa tidak boleh buat
        if (auth()->user()->role != 'siswa') {
            abort(403, 'Anda tidak punya izin membuat pengaduan.');
        }

        return view('pengaduan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Pengaduan Baru
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Selain siswa tidak boleh kirim
        if (auth()->user()->role != 'siswa') {
            abort(403, 'Anda tidak punya izin mengirim pengaduan.');
        }

        // Validasi input
        $validated = $request->validate([
            'report_type' => 'required|in:korban,teman_korban,orang_tua,guru,lainnya',
            'reporter_name' => 'required|string|max:255',
            'reporter_class' => 'required|string|max:255',
            'victim_name' => 'required|string|max:255',
            'victim_class' => 'required|string|max:255',
            'perpetrator_name' => 'required|string|max:255',
            'perpetrator_class' => 'required|string|max:255',
            'incident_date' => 'required|date',
            'incident_time' => 'nullable',
            'location' => 'required|string|max:255',
            'bullying_type' => 'required|in:fisik,verbal,cyber,pengucilan,intimidasi,lainnya',
            'description' => 'required|string',
            'witnesses' => 'nullable|string|max:255',
            'urgency' => 'required|in:rendah,sedang,tinggi',
            'attachment' => 'nullable|' . upload_validation('pengaduan'),
        ]);

        // Siapkan data untuk disimpan
        $validated['user_id'] = Auth::id();
        $validated['nomor_laporan'] = 'BLY-' . now()->format('YmdHis') . '-' . Str::random(5);
        $validated['status'] = 'menunggu'; // Status awal: menunggu

        if ($request->incident_time) {
            $validated['incident_time'] = Carbon::parse($request->incident_time)->format('H:i:s');
        }

        // Handle file attachment jika ada  
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $validated['attachment'] = upload_store($file, 'pengaduan', $filename);
        }

        $pengaduan = Pengaduan::create($validated);

         /*
        |--------------------------------------------------------------------------
        | Kirim Notifikasi ke Wali Kelas
        |--------------------------------------------------------------------------
        */

        // Wali kelas yang menerima notifikasi: jika korban ATAU pelaku dari kelasnya
        $waliKelas = User::where('role', 'wali_kelas')
            ->where(function($query) use ($validated) {
                $query->where('kelas', $validated['victim_class'])
                      ->orWhere('kelas', $validated['perpetrator_class']);
            })
            ->get();

        // Kirim notifikasi hanya ke wali kelas
        Notification::send($waliKelas, new PengaduanMasukNotification($pengaduan));

        return redirect()->route('buat-pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Draft
    |--------------------------------------------------------------------------
    */
    public function saveDraft(Request $request)
    {
        // Selain siswa tidak boleh simpan draft
        if (auth()->user()->role != 'siswa') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak punya izin menyimpan draft.'
            ], 403);
        }

        // Validasi lebih fleksibel untuk draft (tidak semua required)
        $validated = $request->validate([
            'report_type' => 'nullable|in:korban,teman_korban,orang_tua,guru,lainnya',
            'reporter_name' => 'nullable|string|max:255',
            'reporter_class' => 'nullable|string|max:255',
            'victim_name' => 'nullable|string|max:255',
            'victim_class' => 'nullable|string|max:255',
            'perpetrator_name' => 'nullable|string|max:255',
            'perpetrator_class' => 'nullable|string|max:255',
            'incident_date' => 'nullable|date',
            'incident_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'bullying_type' => 'nullable|in:fisik,verbal,cyber,pengucilan,intimidasi,lainnya',
            'description' => 'nullable|string',
            'witnesses' => 'nullable|string|max:255',
            'urgency' => 'nullable|in:rendah,sedang,tinggi',
            'attachment' => 'nullable|file|mimes:png,jpg,jpeg,mp4|max:10240',
        ]);

        // Siapkan data untuk disimpan
        $validated['user_id'] = Auth::id();
        $validated['nomor_laporan'] = 'DRAFT-' . now()->format('YmdHis') . '-' . Str::random(5);
        $validated['status'] = 'draf'; // Status DRAF

        if ($request->incident_time) {
            $validated['incident_time'] = Carbon::parse($request->incident_time)->format('H:i:s');
        }

        // Handle file attachment jika ada
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $validated['attachment'] = upload_store($file, 'pengaduan', $filename);
        }

        // Simpan draft dan tangani error jika ada
        try {
            $pengaduan = Pengaduan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Draft berhasil disimpan!',
                'data' => [
                    'id' => $pengaduan->id,
                    'nomor_laporan' => $pengaduan->nomor_laporan
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving draft: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan draft: ' . $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Detail Pengaduan
    |--------------------------------------------------------------------------
    */
    public function show($id)
{
    $pengaduan = Pengaduan::findOrFail($id);
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | Validasi Akses
    |--------------------------------------------------------------------------
    */
    // ADMIN, GURU BK, WALI KELAS → BOLEH
    if (in_array($user->role, ['admin', 'guru_bk', 'wali_kelas'])) {
        // WALI KELAS → CUMA BOLEH LIHAT JIKA KORBAN/PELAKU DARI KELASNYA
        if ($user->role === 'wali_kelas') {
            $kelasWali = $user->kelas;
            if (
                $pengaduan->victim_class != $kelasWali &&
                $pengaduan->perpetrator_class != $kelasWali
            ) {
                abort(403, 'Anda tidak memiliki akses melihat detail pengaduan ini.');
            }
        }
    }

    // SISWA
    else if ($user->role === 'siswa') {

        // KORBAN ATAU PELAKU → TIDAK BOLEH
        if (
            $pengaduan->korban_id == $user->id ||
            $pengaduan->pelaku_id == $user->id
        ) {
            abort(403, 'Anda tidak memiliki akses melihat detail pengaduan ini.');
        }

        // BUKAN PEMILIK LAPORAN
        if ($pengaduan->user_id != $user->id) {
            abort(403, 'Ini bukan pengaduan milik Anda.');
        }
    }

    // ROLE LAIN → TOLAK
    else {
        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Tandai Notifikasi Sebagai Dibaca
    |--------------------------------------------------------------------------
    */
    $user->unreadNotifications()
        ->where('data->pengaduan_id', $pengaduan->id)
        ->update(['read_at' => now()]);

    $pengaduan->jenis_bullying = $this->getJenisBullying($pengaduan->bullying_type);

    return view('pengaduan.show', compact('pengaduan'));
}

/*
|--------------------------------------------------------------------------
| Tampilkan Detail Pengaduan Khusus Siswa
|--------------------------------------------------------------------------
*/
public function showSiswa($id)
{
    $pengaduan = Pengaduan::findOrFail($id);
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | Validasi Akses Siswa
    |--------------------------------------------------------------------------
    */
        
    // pastikan role siswa
    if ($user->role !== 'siswa') {
        abort(403);
    }

    // KORBAN ATAU PELAKU → TIDAK BOLEH
    if (
        $pengaduan->korban_id == $user->id ||
        $pengaduan->pelaku_id == $user->id
    ) {
        abort(403, 'Anda tidak memiliki akses melihat detail pengaduan ini.');
    }

    // BUKAN PEMILIK LAPORAN
    if ($pengaduan->user_id != $user->id) {
        abort(403, 'Ini bukan pengaduan milik Anda.');
    }

    /*
    |--------------------------------------------------------------------------
    | Tandai Notifikasi Sebagai Dibaca
    |--------------------------------------------------------------------------
    */
    $user->unreadNotifications()
        ->where('data->pengaduan_id', $pengaduan->id)
        ->update(['read_at' => now()]);

    // helper jenis bullying
    $pengaduan->jenis_bullying = $this->getJenisBullying($pengaduan->bullying_type);

    return view('pengaduan.show', compact('pengaduan'));
}


    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Edit Pengaduan (Hanya Siswa Pemilik)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validasi Akses Edit
        |--------------------------------------------------------------------------
        */

        // Selain siswa tidak boleh edit
        if (auth()->user()->role != 'siswa') {
            abort(403, 'Anda tidak punya izin mengedit pengaduan.');
        }

        // Siswa tidak boleh edit milik orang lain
        if ($pengaduan->user_id != auth()->id()) {
            abort(403, 'Ini bukan pengaduan milik Anda.');
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

/*
|--------------------------------------------------------------------------
| Update Pengaduan (Hanya Siswa Pemilik)
|--------------------------------------------------------------------------
*/
public function update(Request $request, $id)
{
    $pengaduan = Pengaduan::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Validasi Akses
    |--------------------------------------------------------------------------
    */
    // hanya siswa pemilik
    if (auth()->user()->role != 'siswa' || $pengaduan->user_id != auth()->id()) {
        abort(403);
    }

    //  SIMPAN STATUS SEBELUM UPDATE
    $oldStatus = $pengaduan->status;

    /*
    |--------------------------------------------------------------------------
    | Validasi Input
    |--------------------------------------------------------------------------
    */
    $validated = $request->validate([
        'report_type' => 'required|in:korban,teman_korban,orang_tua,guru,lainnya',
        'reporter_name' => 'required|string|max:255',
        'reporter_class' => 'required|string|max:255',
        'victim_name' => 'required|string|max:255',
        'victim_class' => 'required|string|max:255',
        'perpetrator_name' => 'required|string|max:255',
        'perpetrator_class' => 'required|string|max:255',
        'incident_date' => 'required|date',
        'incident_time' => 'nullable',
        'location' => 'required|string|max:255',
        'bullying_type' => 'required|in:fisik,verbal,cyber,pengucilan,intimidasi,lainnya',
        'description' => 'required|string',
        'witnesses' => 'nullable|string|max:255',
        'urgency' => 'required|in:rendah,sedang,tinggi',
        'attachment' => 'nullable|' . upload_validation('pengaduan'),
    ]);

    if ($request->incident_time) {
        $validated['incident_time'] = Carbon::parse($request->incident_time)->format('H:i:s');
    }

    // Upload ulang lampiran jika ada
    if ($request->hasFile('attachment')) {
        upload_delete($pengaduan->attachment);

        $file = $request->file('attachment');
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $validated['attachment'] = upload_store($file, 'pengaduan', $filename);
    }

    /*
    |--------------------------------------------------------------------------
    | Kirim Notifikasi Jika Di Ditolak -> kirim ulang
    |--------------------------------------------------------------------------
    */
    if ($oldStatus === 'ditolak') {
        $validated['status'] = 'menunggu';
    }

    // update data
    $pengaduan->update($validated);

    // KIRIM NOTIFIKASI HANYA JIKA DARI DITOLAK
    if ($oldStatus === 'ditolak') {
        $guruBk = User::where('role', 'guru_bk')->get();

        $waliKelas = User::where('role', 'wali_kelas')
            ->where('kelas', $pengaduan->victim_class)
            ->get();

        $penerima = $guruBk->merge($waliKelas);

        Notification::send(
            $penerima,
            new PengaduanMasukNotification($pengaduan)
        );
    }

    //  PESAN SESUAI AKSI
    $message = $oldStatus === 'ditolak'
        ? 'Pengaduan berhasil diperbarui dan dikirim ulang!'
        : 'Perubahan pengaduan berhasil disimpan.';

    return redirect()
        ->route('riwayat-pengaduan')
        ->with('success', $message);
}

    /*
    |--------------------------------------------------------------------------
    | Hapus Pengaduan (Hanya Siswa Pemilik dengan status draf)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validasi Akses Hapus
        |--------------------------------------------------------------------------
        */

        // Selain siswa tidak boleh hapus
        if (auth()->user()->role != 'siswa') {
            abort(403, 'Anda tidak punya izin menghapus pengaduan.');
        }

        // Siswa tidak boleh hapus milik orang lain
        if ($pengaduan->user_id != auth()->id()) {
            abort(403, 'Ini bukan pengaduan milik Anda.');
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus File
        |--------------------------------------------------------------------------
        */
        
        upload_delete($pengaduan->attachment);

        $pengaduan->delete();

        return redirect()->route('draf-pengaduan')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }

/*
|--------------------------------------------------------------------------
| Kirim Draft Menjadi Pengaduan
|--------------------------------------------------------------------------
*/

public function kirim($id)
{
    $pengaduan = Pengaduan::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Validasi Akses
    |--------------------------------------------------------------------------
    */

    // hanya siswa pemilik
    if (auth()->user()->role != 'siswa' || $pengaduan->user_id != auth()->id()) {
        abort(403);
    }

    // pastikan masih draf
    if ($pengaduan->status !== 'draf') {
        return back()->with('error', 'Pengaduan sudah dikirim.');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */
    $pengaduan->update([
        'status' => 'menunggu'
    ]);

    // guru BK
    $guruBk = User::where('role', 'guru_bk')->get();

    // wali kelas korban
    $waliKelas = User::where('role', 'wali_kelas')
        ->where('kelas', $pengaduan->victim_class)
        ->get();

    $penerima = $guruBk->merge($waliKelas);

    /*
    |--------------------------------------------------------------------------
    | Kirim Notifikasi
    |--------------------------------------------------------------------------
    */
        
    Notification::send($penerima, new PengaduanMasukNotification($pengaduan));

    return redirect()
        ->route('riwayat-pengaduan')
        ->with('success', 'Pengaduan berhasil dikirim!');
}


/*
|--------------------------------------------------------------------------
| Helper Jenis Bullying
|--------------------------------------------------------------------------
*/
    private function getJenisBullying($type)
    {
        return [
            'fisik' => 'Fisik (Kekerasan/Pukulan)',
            'verbal' => 'Verbal (Ejekan/Umpatan)',
            'cyber' => 'Cyber (Media Sosial/Chat)',
            'pengucilan' => 'Pengucilan',
            'intimidasi' => 'Intimidasi',
            'lainnya' => 'Lainnya',
        ][$type] ?? $type;
    }

    /*
    |--------------------------------------------------------------------------
    | Setujui Pengaduan (dari detail pengaduan)
    |--------------------------------------------------------------------------
    */
    public function approve($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validasi Akses
        |--------------------------------------------------------------------------
        */

        // Hanya admin, guru_bk, wali_kelas yang bisa approve
        if (!in_array(auth()->user()->role, ['admin', 'guru_bk', 'wali_kelas'])) {
            abort(403, 'Anda tidak memiliki akses untuk menyetujui pengaduan.');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Status
        |--------------------------------------------------------------------------
        */
        $pengaduan->update([
            'status' => 'disetujui',
            'alasan_penolakan' => null,
            'rejected_at' => null,
            'rejected_by' => null
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kirim Notifikasi ke Siswa
        |--------------------------------------------------------------------------
        */
        $siswa = $pengaduan->user;
        if ($siswa) {
            $siswa->notify(new StatusPengaduanNotification($pengaduan));
        }

        return redirect()
            ->route('pengaduan.show', $pengaduan->id)
            ->with('success', 'Pengaduan berhasil disetujui!');
    }

    /*
    |--------------------------------------------------------------------------
    | Tolak Pengaduan (dari detail pengaduan)
    |--------------------------------------------------------------------------
    */

    public function reject(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validasi Akses
        |--------------------------------------------------------------------------
        */
        // Hanya admin, guru_bk, wali_kelas yang bisa reject
        if (!in_array(auth()->user()->role, ['admin', 'guru_bk', 'wali_kelas'])) {
            abort(403, 'Anda tidak memiliki akses untuk menolak pengaduan.');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Status
        |--------------------------------------------------------------------------
        */
        $pengaduan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->reason,
            'rejected_at' => now(),
            'rejected_by' => Auth::id()
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kirim Notifikasi ke Siswa
        |--------------------------------------------------------------------------
        */
        $siswa = $pengaduan->user;
        if ($siswa) {
            $siswa->notify(new StatusPengaduanNotification($pengaduan));
        }

        return redirect()
            ->route('pengaduan.show', $pengaduan->id)
            ->with('error', 'Pengaduan berhasil ditolak!');
    }

    /*
    |--------------------------------------------------------------------------
    | Download Lampiran Pengaduan
    |--------------------------------------------------------------------------
    */
    public function downloadLampiran($id)
    {

    $pengaduan = Pengaduan::findOrFail($id);

    if (!$pengaduan->attachment || !upload_exists($pengaduan->attachment)) {
        abort(404);
    }

    return upload_download($pengaduan->attachment);
}

}