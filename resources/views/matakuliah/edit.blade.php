@extends('layouts.app')

@section('title', 'Edit Matakuliah')
@section('page-title', 'Edit Matakuliah')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}" class="text-decoration-none">Matakuliah</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-pencil-square text-primary me-2"></i>Form Edit Matakuliah</div>
            <div class="card-body">
                <form action="{{ route('matakuliah.update', $matakuliah->id_matakuliah) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Matakuliah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_matakuliah"
                               value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}"
                               class="form-control @error('nama_matakuliah') is-invalid @enderror">
                        @error('nama_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SKS <span class="text-danger">*</span></label>
                        <select name="sks" class="form-select @error('sks') is-invalid @enderror">
                            @foreach([1,2,3,4,5,6] as $s)
                                <option value="{{ $s }}"
                                    {{ old('sks', $matakuliah->sks) == $s ? 'selected' : '' }}>
                                    {{ $s }} SKS
                                </option>
                            @endforeach
                        </select>
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <select name="id_jurusan" class="form-select @error('id_jurusan') is-invalid @enderror">
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}"
                                    {{ old('id_jurusan', $matakuliah->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
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
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
