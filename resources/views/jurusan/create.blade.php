@extends('layouts.app')

@section('title', 'Tambah Jurusan')
@section('page-title', 'Tambah Jurusan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('jurusan.index') }}" class="text-decoration-none">Jurusan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-plus-circle text-primary me-2"></i>Form Tambah Jurusan</div>
            <div class="card-body">
                <form action="{{ route('jurusan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan') }}"
                               class="form-control @error('nama_jurusan') is-invalid @enderror"
                               placeholder="Contoh: Teknik Informatika">
                        @error('nama_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Akreditasi <span class="text-danger">*</span></label>
                        <select name="akreditasi" class="form-select @error('akreditasi') is-invalid @enderror">
                            <option value="">-- Pilih Akreditasi --</option>
                            @foreach(['A','B','C'] as $ak)
                                <option value="{{ $ak }}" {{ old('akreditasi') == $ak ? 'selected' : '' }}>
                                    Akreditasi {{ $ak }}
                                </option>
                            @endforeach
                        </select>
                        @error('akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
