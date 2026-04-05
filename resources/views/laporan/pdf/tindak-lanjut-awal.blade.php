<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tindak Lanjut Awal</title>
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
        .badge-purple { background: #6366f1; color: #fff; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN TINDAK LANJUT AWAL</h2>
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
            <span>{{ $periode ?? 'Semua Periode' }}</span>
        </div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <strong>Total Tindak Lanjut:</strong>
            <span>{{ $statistik['total'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Status Diproses:</strong>
            <span>{{ $statistik['diproses'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Status Selesai:</strong>
            <span>{{ $statistik['selesai'] }} kasus</span>
        </div>
        <div class="info-row">
            <strong>Direkomendasi ke BK:</strong>
            <span>{{ $statistik['direkomendasi_bk'] }} kasus</span>
        </div>
    </div>

    @if($tindakLanjutAwal->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">No. Laporan</th>
                <th width="8%">Tanggal</th>
                <th width="12%">Pelapor</th>
                <th width="12%">Korban</th>
                <th width="12%">Pelaku</th>
                <th width="12%">Wali Kelas</th>
                <th width="21%">Catatan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tindakLanjutAwal as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pengaduan->nomor_laporan ?? '-' }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</td>
                <td>{{ $item->pengaduan->reporter_name ?? '-' }}</td>
                <td>{{ $item->pengaduan->victim_name ?? '-' }}</td>
                <td>{{ $item->pengaduan->perpetrator_name ?? '-' }}</td>
                <td>{{ $item->waliKelas->name ?? '-' }}</td>
                <td>{{ $item->catatan ?? '-' }}</td>
                <td>
                    @if($item->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @elseif($item->status == 'diproses')
                        <span class="badge badge-warning">Diproses</span>
                    @elseif($item->status == 'direkomendasi_bk')
                        <span class="badge badge-purple">Direkomendasi BK</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        Tidak ada data tindak lanjut awal
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