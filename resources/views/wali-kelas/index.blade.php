@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Card - Same as Data Siswa -->
    <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
        <div class="card-body py-3">
            <h5 class="mb-1 text-dark" style="font-weight: 700;">Data Wali Kelas</h5>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Kelola data wali kelas</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Wali Kelas</h6>
        </div>
        <div class="card-body">
            <!-- Form Pencarian dan Filter -->
            <div class="row mb-3">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('wali-kelas.index') }}" method="GET" class="d-inline">
                                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Cari nama, email, atau NIP..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('wali-kelas.index') }}" method="GET">
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
                        <a href="{{ route('wali-kelas.index') }}" class="btn btn-secondary">
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
                            <th>NIP</th>
                            <th>Telepon</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($waliKelas as $index => $wali)
                        <tr>
                            <td>{{ $waliKelas->firstItem() + $index }}</td>
                            <td>{{ $wali->name }}</td>
                            <td>{{ $wali->email }}</td>
                            <td>{{ $wali->nip ?? '-' }}</td>
                            <td>{{ $wali->phone ?? '-' }}</td>
                            <td>{{ $wali->kelas ?? '-' }}</td>
                            <td>{{ $wali->address ?? '-' }}</td>
                            <td>{{ $wali->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-search fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted mb-0">Tidak ada data wali kelas yang ditemukan.</p>
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
                        Menampilkan {{ $waliKelas->firstItem() ?? 0 }} - {{ $waliKelas->lastItem() ?? 0 }} dari {{ $waliKelas->total() }} data
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        {{ $waliKelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection