<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tindak Lanjut</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 5px 0;
            color: #2c3e50;
            font-size: 18px;
        }
        .header p {
            margin: 3px 0;
            color: #7f8c8d;
            font-size: 10px;
        }
        .info-box {
            background: #ecf0f1;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .periode-box {
            background: #d4e6f1;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
        }
        .periode-box strong {
            color: #2c3e50;
            font-size: 11px;
        }
        .periode-box span {
            color: #34495e;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th {
            background-color: #4A7AB5;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 10px;
            border: 1px solid #3d6a9e;
        }
        td {
            padding: 6px 8px;
            border: 1px solid #bdc3c7;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .signature {
            display: inline-block;
            text-align: center;
            margin-top: 60px;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 50px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-warning { background: #ffc107; color: #000; }
        .badge-success { background: #28a745; color: #fff; }
        .badge-danger { background: #dc3545; color: #fff; }
        .badge-info { background: #17a2b8; color: #fff; }
        h3 {
            margin-top: 20px;
            color: #2c3e50;
            font-size: 14px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 5px;
        }
        h4 {
            margin-top: 0;
            color: #2c3e50;
        }
        .detail-box {
            margin-top: 30px;
            page-break-before: avoid;
        }
        .catatan-proses {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .catatan-item {
            margin-bottom: 15px;
            padding: 10px;
            background: white;
            border-left: 3px solid #4A7AB5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN TINDAK LANJUT PENANGANAN</h2>
        <p>SMKN 1 Padaherang - Sistem Pengaduan Bullying</p>
        @php
            $now = \Carbon\Carbon::now();
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        @endphp
        <p>Dicetak pada: {{ $now->day }} {{ $bulanIndo[$now->month] }} {{ $now->year }}, {{ $now->format('H:i') }} WIB</p>
    </div>

    <div class="periode-box">
        <div class="info-row">
            <strong>Periode Laporan:</strong>
            <span>{{ $periode }}</span>
        </div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <strong>Total Tindak Lanjut:</strong>
            <span>{{ $statistik['total'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Status Direncanakan:</strong>
            <span>{{ $statistik['direncanakan'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Status Diproses:</strong>
            <span>{{ $statistik['diproses'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Status Selesai:</strong>
            <span>{{ $statistik['selesai'] }} kasus</span>
        </div>
    </div>

    <h3>Detail Tindak Lanjut</h3>
    @if($tindakLanjut->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="12%">No. Laporan</th>
                <th width="10%">Tanggal</th>
                <th width="15%">Korban</th>
                <th width="15%">Pelaku</th>
                <th width="20%">Jenis Tindakan</th>
                <th width="15%">Petugas BK</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tindakLanjut as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pengaduan->nomor_laporan ?? '-' }}</td>
                    <td>{{ $item->tanggal_tindakan ? \Carbon\Carbon::parse($item->tanggal_tindakan)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $item->pengaduan->victim_name ?? '-' }}</td>
                    <td>{{ $item->pengaduan->perpetrator_name ?? '-' }}</td>
                    <td>{{ $item->jenis_tindakan ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>
                        @if($item->status == 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($item->status == 'diproses')
                            <span class="badge badge-info">Diproses</span>
                        @else
                            <span class="badge badge-warning">Direncanakan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @else
    <div class="no-data">
        Tidak ada data tindak lanjut yang sesuai dengan filter yang dipilih.
    </div>
    @endif

    @if($tindakLanjut->count() > 0)
        <div class="detail-box">
            <h3>Ringkasan Hasil Tindakan Lengkap</h3>
            <table>
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="12%">Nomor Laporan</th>
                        <th width="10%">Status Pengaduan</th>
                        <th width="15%">Jenis Tindakan</th>
                        <th width="20%">Deskripsi</th>
                        <th width="15%">Tahapan</th>
                        <th width="15%">Hasil</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tindakLanjut as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->pengaduan->nomor_laporan ?? '-' }}</td>
                            <td>
                                @if($item->pengaduan)
                                    @if($item->pengaduan->status == 'disetujui')
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif($item->pengaduan->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        {{ ucfirst($item->pengaduan->status) }}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->jenis_tindakan ?? '-' }}</td>
                            <td>{{ Str::limit($item->deskripsi ?? '-', 50) }}</td>
                            <td>
                                @if($item->status == 'direncanakan')
                                    <span class="badge badge-warning">Direncanakan</span>
                                @elseif($item->status == 'diproses')
                                    <span class="badge badge-info">Diproses</span><br>
                                    <small>Mulai: {{ $item->tanggal_mulai_proses ? \Carbon\Carbon::parse($item->tanggal_mulai_proses)->format('d/m/Y') : '-' }}</small>
                                @elseif($item->status == 'selesai')
                                    <span class="badge badge-success">Selesai</span><br>
                                    <small>Selesai: {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 'selesai')
                                    {{ Str::limit($item->hasil ?? '-', 80) }}
                                @else
                                    <em style="color: #999;">Belum selesai</em>
                                @endif
                            </td>
                            <td>
                                @if($item->status_hasil)
                                    <strong>{{ ucfirst($item->status_hasil) }}</strong>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="catatan-proses">
                <h4>Catatan Proses:</h4>
                @foreach($tindakLanjut->where('status', '!=', 'direncanakan') as $item)
                    @if($item->catatan_proses || $item->evaluasi)
                        <div class="catatan-item">
                            <strong>{{ $item->pengaduan->nomor_laporan ?? '-' }}</strong><br>
                            @if($item->catatan_proses)
                                <small><strong>Catatan:</strong> {{ $item->catatan_proses }}</small><br>
                            @endif
                            @if($item->pihak_terlibat)
                                <small><strong>Pihak Terlibat:</strong> {{ $item->pihak_terlibat }}</small><br>
                            @endif
                            @if($item->evaluasi)
                                <small><strong>Evaluasi:</strong> {{ $item->evaluasi }}</small><br>
                            @endif
                            @if($item->rekomendasi)
                                <small><strong>Rekomendasi:</strong> {{ $item->rekomendasi }}</small>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="footer">
        <p style="margin-bottom: 60px;">
            Padaherang, {{ date('d F Y') }}<br>
            <strong>Mengetahui,</strong>
        </p>
        <p style="margin-top: 0;">
            <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
            <strong>Kepala Sekolah</strong>
        </p>
    </div>
</body>
</html>