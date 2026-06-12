@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">Mahasiswa</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-pencil-square text-primary me-2"></i>Form Edit Mahasiswa</div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim"
                               value="{{ old('nim', $mahasiswa->nim) }}"
                               class="form-control @error('nim') is-invalid @enderror">
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama"
                               value="{{ old('nama', $mahasiswa->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <select name="id_jurusan" class="form-select @error('id_jurusan') is-invalid @enderror">
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}"
                                    {{ old('id_jurusan', $mahasiswa->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }} (Akreditasi {{ $j->akreditasi }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Update
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
