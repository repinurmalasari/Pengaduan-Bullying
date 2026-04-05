<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pengaduan</title>
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
        /* BADGE CLASSES - SAMA SEPERTI TINDAK LANJUT AWAL */
        .badge-warning { background: #ffc107; color: #000; }
        .badge-success { background: #28a745; color: #fff; }
        .badge-danger { background: #dc3545; color: #fff; }
        .badge-info { background: #17a2b8; color: #fff; }
        .badge-purple { background: #6366f1; color: #fff; }
        .badge-secondary { background: #6c757d; color: #fff; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA PENGADUAN BULLYING</h2>
        <p>SMKN 1 Padaherang - Sistem Pengaduan Bullying</p>
        @php
            $now = \Carbon\Carbon::now();
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        @endphp
        <p>Dicetak pada: {{ $now->day }} {{ $bulanIndo[$now->month] }} {{ $now->year }}, {{ $now->format('H:i') }} WIB</p>
    </div>

    <div class="periode-box">
        <div class="info-row">
            <strong> Periode Laporan:</strong>
            <span>{{ $periode ?? 'Semua Periode' }}</span>
        </div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <strong>Total Pengaduan:</strong>
            <span>{{ $statistik['total'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Menunggu:</strong>
            <span>{{ $statistik['menunggu'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Disetujui:</strong>
            <span>{{ $statistik['disetujui'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Ditolak:</strong>
            <span>{{ $statistik['ditolak'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Direncanakan:</strong>
            <span>{{ $statistik['direncanakan'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Diproses:</strong>
            <span>{{ $statistik['proses'] }} pengaduan</span>
        </div>
        <div class="info-row">
            <strong>Status Selesai:</strong>
            <span>{{ $statistik['selesai'] }} pengaduan</span>
        </div>
    </div>

    @if($pengaduan->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Nomor Laporan</th>
                <th width="8%">Tanggal</th>
                <th width="13%">Pelapor</th>
                <th width="13%">Korban</th>
                <th width="13%">Pelaku</th>
                <th width="15%">Jenis Bullying</th>
                <th width="8%">Prioritas</th>
                <th width="12%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nomor_laporan }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->reporter_name }}</td>
                <td>{{ $item->victim_name }}</td>
                <td>{{ $item->perpetrator_name }}</td>
                <td>{{ $item->bullying_type }}</td>
                <td>
                    @if($item->urgency == 'tinggi')
                        <span class="badge badge-danger">Tinggi</span>
                    @elseif($item->urgency == 'sedang')
                        <span class="badge badge-warning">Sedang</span>
                    @else
                        <span class="badge badge-info">Rendah</span>
                    @endif
                </td>
                <td>
                    {{-- BADGE DENGAN WARNA SAMA SEPERTI TINDAK LANJUT AWAL --}}
                    @if($item->final_status == 'menunggu')
                        <span class="badge badge-secondary">Menunggu</span>
                    @elseif($item->final_status == 'disetujui')
                        <span class="badge badge-success">Disetujui</span>
                    @elseif($item->final_status == 'ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                    @elseif($item->final_status == 'direncanakan')
                        <span class="badge badge-info">Direncanakan</span>
                    @elseif($item->final_status == 'diproses')
                        <span class="badge badge-warning">Diproses</span>
                    @elseif($item->final_status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @elseif($item->final_status == 'direkomendasi_bk')
                        <span class="badge badge-purple">Direkomendasi BK</span>
                    @else
                        <span class="badge badge-secondary">{{ $item->final_status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        Tidak ada data pengaduan untuk periode yang dipilih.
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