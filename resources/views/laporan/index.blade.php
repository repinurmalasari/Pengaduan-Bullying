@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-header">
                <h1>
                    <i class="fas fa-file-chart-line me-2"></i>Laporan Pengaduan Bullying
                </h1>
                <p>Kelola dan cetak berbagai jenis laporan sistem</p>
            </div>
        </div> 
    </div>

    <!-- Row 1: Pengaduan, Tindak Lanjut, Tindak Lanjut Awal -->
    <div class="row">

        <!-- Laporan Data Pengaduan -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-file-alt me-2"></i> Laporan Data Pengaduan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan data pengaduan bullying yang masuk</p>
                    
                    <form method="GET" action="{{ route('laporan.pengaduan') }}" target="_blank">
                        <div class="mb-3">
                            <label for="periode_pengaduan" class="form-label">Periode <span class="text-danger"></span></label>
                            <select name="periode" id="periode_pengaduan" class="form-select form-select-custom periode-select" required>
                                <option value="">-- Pilih Periode --</option>
                                <option value="hari">Per Hari</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </div>

                        <!-- Field Tanggal -->
                        <div class="mb-3 field-tanggal" style="display: none;">
                            <label for="tanggal_pengaduan" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal_pengaduan" class="form-control form-control-custom" value="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Field Bulan -->
                        <div class="mb-3 field-bulan" style="display: none;">
                            <label for="bulan_pengaduan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan_pengaduan" class="form-select form-select-custom">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>

                        <!-- Field Tahun untuk bulan -->
                        <div class="mb-3 field-tahun-bulan" style="display: none;">
                            <label for="tahun_pengaduan" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_pengaduan" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Field Tahun Only -->
                        <div class="mb-3 field-tahun-only" style="display: none;">
                            <label for="tahun_pengaduan_only" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_pengaduan_only" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                    <div class="mb-3">
                            <label for="status_pengaduan" class="form-label">Status</label>
                        <select name="status" id="status_pengaduan" class="form-select form-select-custom">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu Verifikasi</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="direncanakan">Direncanakan</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="direkomendasi_bk">Direkomendasi ke BK</option>
                        </select>
                    </div>
                        
                        <button type="submit" name="cetak" value="1" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Laporan Tindak Lanjut Awal -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-clipboard-check me-2"></i> Laporan Tindak Lanjut Awal
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan tindak lanjut awal oleh wali kelas</p>
                    
                    <form method="GET" action="{{ route('laporan.tindak-lanjut-awal') }}" target="_blank">
                        <div class="mb-3">
                            <label for="periode_tla" class="form-label">Periode <span class="text-danger"></span></label>
                            <select name="periode" id="periode_tla" class="form-select form-select-custom periode-select-tla" required>
                                <option value="">-- Pilih Periode --</option>
                                <option value="hari">Per Hari</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </div>

                        <!-- Field Tanggal -->
                        <div class="mb-3 field-tanggal-tla" style="display: none;">
                            <label for="tanggal_tla" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal_tla" class="form-control form-control-custom" value="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Field Bulan -->
                        <div class="mb-3 field-bulan-tla" style="display: none;">
                            <label for="bulan_tla" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan_tla" class="form-select form-select-custom">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>

                        <!-- Field Tahun untuk bulan -->
                        <div class="mb-3 field-tahun-tla-bulan" style="display: none;">
                            <label for="tahun_tla" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_tla" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Field Tahun Only -->
                        <div class="mb-3 field-tahun-tla-only" style="display: none;">
                            <label for="tahun_tla_only" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_tla_only" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status_tla" class="form-label">Status</label>
                            <select name="status" id="status_tla" class="form-select form-select-custom">
                                <option value="">Semua Status</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai (Kasus Ringan)</option>
                                <option value="direkomendasi_bk">Direkomendasi ke BK</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="cetak" value="1" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

    <!-- Laporan Tindak Lanjut -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-tasks me-2"></i> Laporan Tindak Lanjut
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan tindak lanjut penanganan kasus</p>
                    
                    <form method="GET" action="{{ route('laporan.tindak-lanjut') }}" target="_blank">
                        <div class="mb-3">
                            <label for="periode_tindak" class="form-label">Periode <span class="text-danger"></span></label>
                            <select name="periode" id="periode_tindak" class="form-select form-select-custom periode-select" required>
                                <option value="">-- Pilih Periode --</option>
                                <option value="hari">Per Hari</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </div>

                        <!-- Field Tanggal -->
                        <div class="mb-3 field-tanggal-tindak" style="display: none;">
                            <label for="tanggal_tindak" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal_tindak" class="form-control form-control-custom" value="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Field Bulan -->
                        <div class="mb-3 field-bulan-tindak" style="display: none;">
                            <label for="bulan_tindak" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan_tindak" class="form-select form-select-custom">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>

                        <!-- Field Tahun untuk bulan -->
                        <div class="mb-3 field-tahun-tindak-bulan" style="display: none;">
                            <label for="tahun_tindak" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_tindak" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Field Tahun Only -->
                        <div class="mb-3 field-tahun-tindak-only" style="display: none;">
                            <label for="tahun_tindak_only" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_tindak_only" class="form-select form-select-custom">
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_tindakan" class="form-label">Jenis Tindakan</label>
                            <select name="jenis_tindakan" id="jenis_tindakan" class="form-select form-select-custom">
                                <option value="">Semua Jenis</option>
                                <option value="konseling">Konseling</option>
                                <option value="sanksi">Sanksi</option>
                                <option value="mediasi">Mediasi</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="cetak" value="1" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Siswa, Guru BK, Wali Kelas -->
    <div class="row">

        <!-- Laporan Data Siswa -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-users me-2"></i> Laporan Data Siswa
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan keterlibatan siswa dalam kasus</p>
                    
                    <form method="GET" action="{{ route('laporan.siswa') }}" target="_blank">
                        <div class="mb-3">
                            <label for="kelas_siswa" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas_siswa" class="form-select form-select-custom">
                                <option value="">Semua Kelas</option>
                                @php
                                    $kelasWaliList = \App\Models\User::where('role', 'wali_kelas')
                                        ->whereNotNull('kelas')
                                        ->distinct()
                                        ->orderBy('kelas')
                                        ->pluck('kelas');
                                @endphp
                                @foreach($kelasWaliList as $kelas)
                                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_siswa" class="form-label">Tahun Registrasi</label>
                            <select name="tahun" id="tahun_siswa" class="form-select form-select-custom">
                                <option value="">Semua Tahun</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Laporan Data Guru BK -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-chalkboard-teacher me-2"></i> Laporan Data Guru BK
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan aktivitas guru BK dalam penanganan</p>
                    
                    <form method="GET" action="{{ route('laporan.guru') }}" target="_blank">
                        <div class="mb-3">
                            <label for="tahun_guru" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun_guru" class="form-select form-select-custom" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <button type="submit" name="cetak" value="1" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Laporan Data Wali Kelas -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-user-tie me-2"></i> Laporan Data Wali Kelas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan data wali kelas berdasarkan kelas</p>
                    
                    <form method="GET" action="{{ route('laporan.wali-kelas') }}" target="_blank">
                        <div class="mb-3">
                            <label for="kelas_wali" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas_wali" class="form-select form-select-custom">
                                <option value="">Semua Kelas</option>
                                @php
                                    $kelasWaliList = \App\Models\User::where('role', 'wali_kelas')
                                        ->whereNotNull('kelas')
                                        ->distinct()
                                        ->orderBy('kelas')
                                        ->pluck('kelas');
                                @endphp
                                @foreach($kelasWaliList as $kelas)
                                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Manajemen User -->
    <div class="row">

        <!-- Laporan Manajemen User -->
        <div class="col-md-4 mb-4">
            <div class="card report-card shadow-sm border-0">
                <div class="card-header bg-gradient-blue">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-users-cog me-2"></i> Laporan Manajemen User
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3"><i class="fas fa-info-circle me-1"></i> Cetak laporan data user berdasarkan role</p>
                    
                    <form method="GET" action="{{ route('laporan.user') }}" target="_blank">
                        <div class="mb-3">
                            <label for="role_user" class="form-label">Role</label>
                            <select name="role" id="role_user" class="form-select form-select-custom">
                                <option value="">Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru_bk">Guru BK</option>
                                <option value="wali_kelas">Wali Kelas</option>
                                <option value="kepala_sekolah">Kepala Sekolah</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-blue-custom w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Header Style - matching exactly with dashboard */
.dashboard-header {
    background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.dashboard-header h1 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 3px;
}

.dashboard-header p {
    font-size: 0.8rem;
    opacity: 0.9;
    margin-bottom: 0;
}

/* Card Styling */
.report-card {
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

.report-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important;
}

.card-header {
    border-bottom: none;
    padding: 12px 18px;
}

/* Gradient Header - exact match with dashboard */
.bg-gradient-blue {
    background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%) !important;
    color: white;
}

.bg-gradient-purple {
    background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%) !important;
    color: white;
}

.card-header h5 {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
}

.card-body {
    padding: 20px;
}

/* Form Elements */
.form-label {
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.75rem;
    color: #5a6c7d;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.form-select-custom, .form-control-custom {
    border-radius: 6px;
    border: 1px solid #e3e6f0;
    padding: 10px 12px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    color: #495057;
}

.form-select-custom:focus, .form-control-custom:focus {
    border-color: #5B8BC5;
    box-shadow: 0 0 0 0.2rem rgba(91, 139, 197, 0.25);
    outline: none;
}

/* Custom Button - Blue Style - MATCHING EXACTLY */
.btn-blue-custom {
    background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%) !important;
    border: none !important;
    color: white !important;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    text-transform: none;
}

.btn-blue-custom:hover {
    background: linear-gradient(135deg, #4A7AB5 0%, #3A6A9F 100%) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(91, 139, 197, 0.3);
    color: white !important;
}

.btn-blue-custom:active {
    transform: translateY(0);
}

/* Custom Button - Purple Style */
.btn-purple-custom {
    background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%) !important;
    border: none !important;
    color: white !important;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    text-transform: none;
}

.btn-purple-custom:hover {
    background: linear-gradient(135deg, #7e22ce 0%, #6b21a8 100%) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(147, 51, 234, 0.3);
    color: white !important;
}

.btn-purple-custom:active {
    transform: translateY(0);
}

/* Shadow Effects */
.shadow-sm {
    box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
}

/* Text Colors */
.text-muted {
    color: #5a6c7d !important;
    font-size: 0.8rem;
}

.text-danger {
    color: #e74c3c !important;
}

/* Animation for form fields */
.field-tanggal, .field-bulan, .field-tahun-bulan, .field-tahun-only,
.field-tanggal-tindak, .field-bulan-tindak, .field-tahun-tindak-bulan, .field-tahun-tindak-only,
.field-tanggal-tla, .field-bulan-tla, .field-tahun-tla-bulan, .field-tahun-tla-only,
.field-bulan-user, .field-tahun-user-bulan, .field-tahun-user-only {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }
    
    .dashboard-header {
        padding: 12px 15px;
    }
    
    .dashboard-header h1 {
        font-size: 1.1rem;
    }
    
    .dashboard-header p {
        font-size: 0.75rem;
    }
    
    .card-body {
        padding: 15px !important;
    }
    
    .card-header h5 {
        font-size: 0.85rem;
    }
    
    .form-label {
        font-size: 0.7rem;
    }
    
    .form-select-custom, .form-control-custom {
        font-size: 0.8rem;
        padding: 8px 10px;
    }
    
    .btn-blue-custom {
        font-size: 0.8rem;
        padding: 8px 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // Handler untuk Laporan Pengaduan
    // ============================================
    const periodePengaduan = document.getElementById('periode_pengaduan');
    if (periodePengaduan) {
        periodePengaduan.addEventListener('change', function() {
            const periode = this.value;
            const cardBody = this.closest('.card-body');
            
            // Hide semua field dulu
            cardBody.querySelector('.field-tanggal').style.display = 'none';
            cardBody.querySelector('.field-bulan').style.display = 'none';
            cardBody.querySelector('.field-tahun-bulan').style.display = 'none';
            cardBody.querySelector('.field-tahun-only').style.display = 'none';
            
            // Tampilkan sesuai pilihan
            if (periode === 'hari') {
                cardBody.querySelector('.field-tanggal').style.display = 'block';
            } else if (periode === 'bulan') {
                cardBody.querySelector('.field-bulan').style.display = 'block';
                cardBody.querySelector('.field-tahun-bulan').style.display = 'block';
            } else if (periode === 'tahun') {
                cardBody.querySelector('.field-tahun-only').style.display = 'block';
            }
        });
    }

    // ============================================
    // Handler untuk Laporan Tindak Lanjut
    // ============================================
    const periodeTindak = document.getElementById('periode_tindak');
    if (periodeTindak) {
        periodeTindak.addEventListener('change', function() {
            const periode = this.value;
            const cardBody = this.closest('.card-body');
            
            // Hide semua field dulu
            cardBody.querySelector('.field-tanggal-tindak').style.display = 'none';
            cardBody.querySelector('.field-bulan-tindak').style.display = 'none';
            cardBody.querySelector('.field-tahun-tindak-bulan').style.display = 'none';
            cardBody.querySelector('.field-tahun-tindak-only').style.display = 'none';
            
            // Tampilkan sesuai pilihan
            if (periode === 'hari') {
                cardBody.querySelector('.field-tanggal-tindak').style.display = 'block';
            } else if (periode === 'bulan') {
                cardBody.querySelector('.field-bulan-tindak').style.display = 'block';
                cardBody.querySelector('.field-tahun-tindak-bulan').style.display = 'block';
            } else if (periode === 'tahun') {
                cardBody.querySelector('.field-tahun-tindak-only').style.display = 'block';
            }
        });
    }

    // ============================================
    // Handler untuk Laporan Tindak Lanjut Awal
    // ============================================
    const periodeTLA = document.getElementById('periode_tla');
    if (periodeTLA) {
        periodeTLA.addEventListener('change', function() {
            const periode = this.value;
            const cardBody = this.closest('.card-body');
            
            // Hide semua field dulu
            cardBody.querySelector('.field-tanggal-tla').style.display = 'none';
            cardBody.querySelector('.field-bulan-tla').style.display = 'none';
            cardBody.querySelector('.field-tahun-tla-bulan').style.display = 'none';
            cardBody.querySelector('.field-tahun-tla-only').style.display = 'none';
            
            // Tampilkan sesuai pilihan
            if (periode === 'hari') {
                cardBody.querySelector('.field-tanggal-tla').style.display = 'block';
            } else if (periode === 'bulan') {
                cardBody.querySelector('.field-bulan-tla').style.display = 'block';
                cardBody.querySelector('.field-tahun-tla-bulan').style.display = 'block';
            } else if (periode === 'tahun') {
                cardBody.querySelector('.field-tahun-tla-only').style.display = 'block';
            }
        });
    }
});
</script>
@endsection