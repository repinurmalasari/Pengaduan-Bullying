<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Siswa</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 20px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
        }
        
        .header h1 {
            margin: 5px 0;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
            font-weight: normal;
        }
        
        .info-box {
            background: #f5f5f5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            page-break-inside: avoid;
        }
        
        .info-box strong {
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            page-break-inside: auto;
        }
        
        table thead {
            background: #4A7AB5;
            color: white;
            display: table-header-group;
        }
        
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        
        table th {
            font-weight: bold;
            padding: 10px 8px;
        }
        
        table tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        table tbody tr:hover {
            background: #f0f0f0;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            page-break-inside: avoid;
        }
        
        .no-data h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .footer {
            margin-top: 40px;
            text-align: right;
            page-break-inside: avoid;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .signature-space {
            margin-bottom: 60px;
        }
        
        .signature-line {
            display: inline-block;
            border-bottom: 1px solid #333;
            width: 200px;
            margin-top: 0;
        }
        
        /* Print specific styles */
        @media print {
            body {
                margin: 0;
                padding: 10mm;
            }
            
            .header {
                page-break-after: avoid;
            }
            
            .info-box {
                page-break-after: avoid;
            }
            
            table {
                page-break-inside: auto;
            }
            
            table thead {
                display: table-header-group;
            }
            
            table tbody tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            
            .footer {
                page-break-inside: avoid;
            }
            
            /* Prevent orphaned content */
            h3 {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Siswa</h1>
        <h2>SMK Negeri 1 Padaherang</h2>
    </div>

    <div class="info-box">
        <strong>Periode Laporan:</strong> {{ $periode ?? 'Semua Periode' }}<br>
        <strong>Tanggal Cetak:</strong> {{ date('d F Y H:i:s') }}<br>
        <strong>Total Siswa:</strong> {{ $statistik['total_siswa'] ?? $siswa->count() }} siswa
    </div>

    @if($siswa->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama</th>
                    <th width="25%">Email</th>
                    <th width="15%">Kelas</th>
                    <th width="15%">Total Pengaduan</th>
                    <th width="15%">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td style="text-align: center;">{{ $item->kelas ?? '-' }}</td>
                        <td style="text-align: center;">{{ $item->pengaduan_siswa_count ?? 0 }}</td>
                        <td style="text-align: center;">{{ $item->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <h3>Tidak Ada Data</h3>
            <p>Tidak ada data siswa yang sesuai dengan filter yang dipilih.</p>
        </div>
    @endif

    <div class="footer">
        <p class="signature-space">
            Padaherang, {{ date('d F Y') }}<br>
            <strong>Mengetahui,</strong>
        </p>
        <p style="margin-top: 0;">
            <span class="signature-line">&nbsp;</span><br>
            <strong>Kepala Sekolah</strong>
        </p>
    </div>
</body>
</html>