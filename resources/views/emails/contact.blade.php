<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #5a8fb8 0%, #1a4d8f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-label {
            font-weight: bold;
            color: #1a4d8f;
            margin-bottom: 5px;
        }
        .info-value {
            color: #666;
        }
        .message-box {
            background-color: #f8f9fa;
            border-left: 4px solid #5a8fb8;
            padding: 20px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Pesan Baru dari Form Kontak</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Sistem Pengaduan Siswa - SMK Negeri 1 Padaherang</p>
        </div>
        
        <div class="content">
            <p>Anda menerima pesan baru dari formulir kontak website:</p>
            
            <div class="info-row">
                <div class="info-label">Nama Pengirim:</div>
                <div class="info-value">{{ $name }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $email }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Subjek:</div>
                <div class="info-value">{{ $subject }}</div>
            </div>
            
            <div class="message-box">
                <div class="info-label">Pesan:</div>
                <div style="margin-top: 10px; white-space: pre-wrap;">{{ $messageContent }}</div>
            </div>
            
            <p style="margin-top: 20px; color: #666; font-size: 14px;">
                <strong>Catatan:</strong> Anda dapat membalas pesan ini langsung ke email pengirim.
            </p>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">Email ini dikirim secara otomatis dari Sistem Pengaduan Siswa</p>
            <p style="margin: 5px 0 0 0;">SMK Negeri 1 Padaherang &copy; 2026</p>
        </div>
    </div>
</body>
</html>
