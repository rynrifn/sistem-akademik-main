@extends('layouts.app')

@section('title', 'Data Jurusan')
@section('page-title', 'Data Jurusan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Jurusan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-building text-primary me-2"></i>Daftar Jurusan</span>
        <div class="d-flex gap-2">
            <a href="{{ route('jurusan.print') }}" class="btn btn-success btn-sm" target="_blank">
                <i class="bi bi-printer me-1"></i> Export PDF
            </a>
            <a href="{{ route('jurusan.export-csv') }}" class="btn btn-info btn-sm" target="_blank">
                <i class="bi bi-filetype-csv me-1"></i> Export CSV
            </a>
            <a href="{{ route('jurusan.export-excel') }}" class="btn btn-warning btn-sm" target="_blank">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </a>
            <a href="{{ route('jurusan.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jurusan
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="d-flex gap-2 mb-3 search-box" style="max-width:360px;">
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Cari nama jurusan...">
            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Jurusan</th>
                        <th>Akreditasi</th>
                        <th>Mahasiswa</th>
                        <th>Matakuliah</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusan as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($jurusan->currentPage() - 1) * $jurusan->perPage() }}</td>
                        <td class="fw-semibold">{{ $item->nama_jurusan }}</td>
                        <td>
                            <span class="badge badge-akreditasi-{{ $item->akreditasi }} px-2 py-1 rounded-2 fw-bold">
                                {{ $item->akreditasi }}
                            </span>
                        </td>
                        <td>{{ $item->mahasiswa_count }}</td>
                        <td>{{ $item->matakuliah_count }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('jurusan.edit', $item->id_jurusan) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('jurusan.destroy', $item->id_jurusan) }}" method="POST"
                                      onsubmit="return confirm('Hapus jurusan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data jurusan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($jurusan->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $jurusan->links() }}
    </div>
    @endif
</div>
@endsection