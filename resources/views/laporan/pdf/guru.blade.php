<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Guru BK</title>
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
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA GURU BK</h2>
        <p>SMKN 1 Padaherang - Sistem Pengaduan Bullying</p>
        @php
            $now = \Carbon\Carbon::now();
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        @endphp
        <p>Dicetak pada: {{ $now->day }} {{ $bulanIndo[$now->month] }} {{ $now->year }}, {{ $now->format('H:i') }} WIB</p>
    </div>

    <div class="info-box">
        <div class="info-row">
            <strong>Total Guru BK:</strong>
            <span>{{ $statistik['total_guru'] }} guru</span>
        </div>
    </div>

    @if($guru->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Nama</th>
                    <th width="30%">Email</th>
                    <th width="20%">Total Tindak Lanjut</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guru as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->tindak_lanjut_count ?? 0 }}</td>
                        <td>{{ $item->tindak_lanjut_count > 0 ? 'Aktif' : 'Tidak Aktif' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada data guru BK yang sesuai dengan filter yang dipilih.
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