@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pilih Peran') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('role.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="role">{{ __('Pilih peran Anda') }}</label>
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                <option value="siswa">{{ __('Siswa') }}</option>
                                <option value="guru">{{ __('Guru') }}</option>
                                <option value="wali_kelas">{{ __('Wali Kelas') }}</option>
                            </select>

                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Lanjutkan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection