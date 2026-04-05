@extends('layouts.app')

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: none;
    }
    
    .stat-label {
        color: #6b7280;
        font-size: 13px;
        font-weight: 500;
        margin: 0;
    }
    
    .stat-number {
        color: #1f2937;
        font-size: 32px;
        font-weight: bold;
        margin: 8px 0 0 0;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .draf-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: none;
    }
    
    .draf-title {
        color: #1f2937;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    
    .draf-row {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 16px;
        margin-bottom: 16px;
    }
    
    .draf-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .draf-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    
    .draf-badge {
        font-size: 13px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }
    
    .draf-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 12px;
    }
    
    .draf-detail-item {
        display: flex;
        flex-direction: column;
    }
    
    .draf-detail-label {
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 4px;
    }
    
    .draf-detail-value {
        color: #1f2937;
        font-size: 14px;
        font-weight: 500;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .action-btn {
        background: white;
        border: 1px solid #e5e7eb;
        padding: 6px 8px;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>

<!-- Header -->
<div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 style="color: #1f2937; font-weight: bold; margin: 0; font-size: 20px;">Draf Pengaduan</h3>
        <p style="color: #6b7280; margin: 4px 0 0 0; font-size: 13px;">Kelola draf pengaduan bullying Anda</p>
    </div>
    <div style="display: flex; gap: 12px; align-items: center;">
        <a href="{{ route('buat-pengaduan.index') }}" class="btn" style="background: white; border: 2px solid #4B7EC4; color: #4B7EC4; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fas fa-list"></i>Pengaduan Terkirim
        </a>
        <a href="{{ route('buat-pengaduan.create') }}" class="btn" style="background: linear-gradient(135deg, #4B7EC4 0%, #2C5AA0 100%); border: none; color: white; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fas fa-plus"></i>Buat Pengaduan
        </a>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="stat-card" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p class="stat-label">Total Draf</p>
                <p class="stat-number" style="color: #2C5AA0;">{{ $totalDraf ?? 0 }}</p>
            </div>
            <div class="stat-icon" style="background: #dbeafe; color: #2C5AA0;">
                <i class="fas fa-file-import"></i>
            </div>
        </div>
    </div>
</div>

<!-- Draf List -->
<div class="draf-card">
    <h5 class="draf-title">Daftar Draf Pengaduan</h5>

    @if ($draf->count() > 0)
        @foreach($draf as $item)
        <div class="draf-row">
            <div class="draf-header">
                <span style="background: #f3f4f6; color: #374151; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    {{ $item['nomor_laporan'] }}
                </span>
                <span class="draf-badge" style="background-color: #fce7f3; color: #be185d;">
                    {{ ucfirst($item['status']) }}
                </span>
                @if($item['prioritas'] == 'tinggi')
                <span class="draf-badge" style="background-color: #fee2e2; color: #991b1b;">
                    Tinggi
                </span>
                @elseif($item['prioritas'] == 'sedang')
                <span class="draf-badge" style="background-color: #fef3c7; color: #92400e;">
                    Sedang
                </span>
                @elseif($item['prioritas'] == 'rendah')
                <span class="draf-badge" style="background-color: #dcfce7; color: #166534;">
                    Rendah
                </span>
                @endif
            </div>

            <div class="draf-details">
                <div class="draf-detail-item">
                    <span class="draf-detail-label">Pelapor</span>
                    <span class="draf-detail-value">{{ $item['pelapor'] }}</span>
                </div>
                <div class="draf-detail-item">
                    <span class="draf-detail-label">Korban</span>
                    <span class="draf-detail-value">{{ $item['korban'] }}</span>
                </div>
                <div class="draf-detail-item">
                    <span class="draf-detail-label">Jenis</span>
                    <span class="draf-detail-value">{{ $item['jenis'] }}</span>
                </div>
                <div class="draf-detail-item">
                    <span class="draf-detail-label">Tanggal</span>
                    <span class="draf-detail-value">{{ $item['tanggal'] }}</span>
                </div>
            </div>
                <div class="action-buttons" style="justify-content: flex-end;">

    {{-- KIRIM DRAF --}}
    <button class="action-btn" style="color:#2563eb"
        onclick="if(confirm('Kirim pengaduan ini sekarang?')) document.getElementById('send-form-{{ $item['id'] }}').submit();"
        title="Kirim">
        <i class="fas fa-paper-plane"></i>
    </button>

    <form id="send-form-{{ $item['id'] }}"
          action="{{ route('pengaduan.kirim', $item['id']) }}"
          method="POST" style="display:none;">
        @csrf
    </form>

    <a href="{{ route('buat-pengaduan.show', $item['id']) }}" class="action-btn" style="color: #3b82f6;">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{ route('buat-pengaduan.edit', $item['id']) }}" class="action-btn" style="color: #10b981;">
        <i class="fas fa-pen-to-square"></i>
    </a>

    <button class="action-btn" style="color: #ef4444;"
        onclick="if(confirm('Yakin ingin menghapus draf ini?')) { document.getElementById('delete-form-{{ $item['id'] }}').submit(); }">
        <i class="fas fa-trash"></i>
    </button>

                <form id="delete-form-{{ $item['id'] }}" action="{{ route('buat-pengaduan.destroy', $item['id']) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        @endforeach
    @else
    <div style="text-align: center; padding: 60px 20px;">
        <i class="fas fa-file-export" style="font-size: 48px; color: #d1d5db; margin-bottom: 12px; display: block;"></i>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">Belum ada draf pengaduan</p>
        <a href="{{ route('buat-pengaduan.create') }}" class="btn" style="background: linear-gradient(135deg, #4B7EC4 0%, #2C5AA0 100%); border: none; color: white; padding: 10px 22px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fas fa-plus"></i>Buat Pengaduan Baru
        </a>
    </div>
    @endif
</div>

@if (session('success'))
<div style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999;">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif
@endsection
