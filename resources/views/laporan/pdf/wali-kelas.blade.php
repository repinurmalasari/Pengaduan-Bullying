<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Wali Kelas</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA WALI KELAS</h2>
        <p>SMKN 1 Padaherang - Sistem Pengaduan Bullying</p>
        @php
            $now = \Carbon\Carbon::now();
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        @endphp
        <p>Dicetak pada: {{ $now->day }} {{ $bulanIndo[$now->month] }} {{ $now->year }}, {{ $now->format('H:i') }} WIB</p>
    </div>

    <div class="info-box">
        <div class="info-row">
            <strong>Total Wali Kelas:</strong>
            <span>{{ $statistik['total_wali_kelas'] }} orang</span>
        </div>
        <div class="info-row">
            <strong>Dengan Kelas:</strong>
            <span>{{ $statistik['dengan_kelas'] }} orang</span>
        </div>
    </div>

    @if($waliKelas->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama</th>
                <th width="20%">Email</th>
                <th width="15%">NIP</th>
                <th width="10%">Kelas</th>
                <th width="15%">Telepon</th>
                <th width="10%">Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($waliKelas as $index => $wali)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $wali->name }}</td>
                <td>{{ $wali->email }}</td>
                <td>{{ $wali->nip ?? '-' }}</td>
                <td>{{ $wali->kelas ?? '-' }}</td>
                <td>{{ $wali->phone ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($wali->created_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        Tidak ada data wali kelas
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
    </div>
</body>
</html>
