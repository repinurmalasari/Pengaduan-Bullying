@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Card - Same as Data Siswa -->
    <div class="card shadow-sm mb-4" style="border: none; border-radius: 10px;">
        <div class="card-body py-3">
            <h5 class="mb-1 text-dark" style="font-weight: 700;">Data Guru BK</h5>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Kelola data guru BK</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Guru BK</h6>
        </div>
        <div class="card-body">
            <!-- Form Pencarian dan Filter -->
            <div class="row mb-3">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('guru.index') }}" method="GET" class="d-inline">
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
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    @if(request('search'))
                        <a href="{{ route('guru.index') }}" class="btn btn-secondary">
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
                            <th>Alamat</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $index => $guru)
                        <tr>
                            <td>{{ $gurus->firstItem() + $index }}</td>
                            <td>{{ $guru->name }}</td>
                            <td>{{ $guru->email }}</td>
                            <td>{{ $guru->nip ?? '-' }}</td>
                            <td>{{ $guru->phone ?? '-' }}</td>
                            <td>{{ $guru->address ?? '-' }}</td>
                            <td>{{ $guru->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-search fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted mb-0">Tidak ada data guru BK yang ditemukan.</p>
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
                        Menampilkan {{ $gurus->firstItem() ?? 0 }} - {{ $gurus->lastItem() ?? 0 }} dari {{ $gurus->total() }} data
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        {{ $gurus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection