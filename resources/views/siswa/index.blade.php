@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Card - Same as Data Pengaduan -->
    <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
        <div class="card-body py-3">
            <h5 class="mb-1 text-dark" style="font-weight: 700;">Data Siswa</h5>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Kelola data siswa</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Siswa</h6>
        </div>
        <div class="card-body">
            <!-- Form Pencarian dan Filter -->
            <div class="row mb-3">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('siswa.index') }}" method="GET" class="d-inline">
                                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Cari nama, email, atau NIS..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('siswa.index') }}" method="GET">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <select class="form-control" name="kelas" onchange="this.form.submit()">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                            {{ $kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    @if(request('search') || request('kelas'))
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP/NIS</th>
                            <th>Telepon</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $siswa)
                        <tr>
                            <td>{{ $siswas->firstItem() + $index }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>{{ $siswa->nip ?? '-' }}</td>
                            <td>{{ $siswa->phone ?? '-' }}</td>
                            <td>{{ $siswa->kelas ?? '-' }}</td>
                            <td>{{ $siswa->address ?? '-' }}</td>
                            <td>{{ $siswa->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-search fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted mb-0">Tidak ada data siswa yang ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Info Pagination -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="text-muted mb-0">
                        Menampilkan {{ $siswas->firstItem() ?? 0 }} - {{ $siswas->lastItem() ?? 0 }} dari {{ $siswas->total() }} data
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        {{ $siswas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media (max-width: 768px) {
    .card {
        border-radius: 18px !important;
        box-shadow: 0 4px 16px rgba(75,126,196,0.10) !important;
        margin-bottom: 22px !important;
        width: calc(100vw - 48px) !important;
        max-width: calc(100vw - 48px) !important;
        left: 50%;
        transform: translateX(-50%);
        position: relative;
    }
    .card-body, .card-header {
        padding: 28px 18px !important;
    }
    .card-header h6, .card-body h5 {
        font-size: 1.35rem !important;
    }
    .card-body p, .card-header p {
        font-size: 1.1rem !important;
    }
}
@media (max-width: 480px) {
    .card {
        border-radius: 14px !important;
        margin-bottom: 16px !important;
        width: calc(100vw - 32px) !important;
        max-width: calc(100vw - 32px) !important;
        left: 50%;
        transform: translateX(-50%);
        position: relative;
    }
    .card-body, .card-header {
        padding: 18px 10px !important;
    }
    .card-header h6, .card-body h5 {
        font-size: 1.1rem !important;
    }
    .card-body p, .card-header p {
        font-size: 1rem !important;
    }
}
</style>
@endpush