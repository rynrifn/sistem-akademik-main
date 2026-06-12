@extends('layouts.app')

@section('title', 'Edit Jurusan')
@section('page-title', 'Edit Jurusan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('jurusan.index') }}" class="text-decoration-none">Jurusan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-pencil-square text-primary me-2"></i>Form Edit Jurusan</div>
            <div class="card-body">
                <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_jurusan"
                               value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                               class="form-control @error('nama_jurusan') is-invalid @enderror">
                        @error('nama_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Akreditasi <span class="text-danger">*</span></label>
                        <select name="akreditasi" class="form-select @error('akreditasi') is-invalid @enderror">
                            @foreach(['A','B','C'] as $ak)
                                <option value="{{ $ak }}"
                                    {{ old('akreditasi', $jurusan->akreditasi) == $ak ? 'selected' : '' }}>
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
                            <i class="bi bi-check-lg me-1"></i> Update
                        </button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
