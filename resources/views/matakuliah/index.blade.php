@extends('layouts.app')

@section('title', 'Data Matakuliah')
@section('page-title', 'Data Matakuliah')
@section('breadcrumb')
    <li class="breadcrumb-item active">Matakuliah</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-book text-primary me-2"></i>Daftar Matakuliah</span>
        <div class="d-flex gap-2">
            <a href="{{ route('matakuliah.print') }}" class="btn btn-success btn-sm" target="_blank">
                <i class="bi bi-printer me-1"></i> Export PDF
            </a>
            <a href="{{ route('matakuliah.export-csv') }}" class="btn btn-info btn-sm" target="_blank">
                <i class="bi bi-filetype-csv me-1"></i> Export CSV
            </a>
            <a href="{{ route('matakuliah.export-excel') }}" class="btn btn-warning btn-sm" target="_blank">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </a>
            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Matakuliah
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="d-flex gap-2 mb-3 search-box" style="max-width:360px;">
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Cari nama matakuliah...">
            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Jurusan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliah as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($matakuliah->currentPage() - 1) * $matakuliah->perPage() }}</td>
                        <td class="fw-semibold">{{ $item->nama_matakuliah }}</td>
                        <td><span class="badge bg-secondary">{{ $item->sks }} SKS</span></td>
                        <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('matakuliah.edit', $item->id_matakuliah) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('matakuliah.destroy', $item->id_matakuliah) }}" method="POST"
                                      onsubmit="return confirm('Hapus matakuliah ini?')">
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
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data matakuliah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($matakuliah->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $matakuliah->links() }}
    </div>
    @endif
</div>
@endsection