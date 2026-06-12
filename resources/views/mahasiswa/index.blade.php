@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Mahasiswa</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people text-primary me-2"></i>Daftar Mahasiswa</span>
        <div class="d-flex gap-2">
            <a href="{{ route('mahasiswa.print') }}" class="btn btn-success btn-sm" target="_blank">
                <i class="bi bi-printer me-1"></i> Export PDF
            </a>
            <a href="{{ route('mahasiswa.export-csv') }}" class="btn btn-info btn-sm" target="_blank">
                <i class="bi bi-filetype-csv me-1"></i> Export CSV
            </a>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" class="d-flex gap-2 mb-3 search-box" style="max-width:360px;">
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Cari nama / NIM...">
            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Akreditasi</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
                        <td><code class="text-primary">{{ $item->nim }}</code></td>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                        <td>
                            @if($item->jurusan)
                            <span class="badge badge-akreditasi-{{ $item->jurusan->akreditasi }} px-2 py-1 rounded-2 fw-bold">
                                {{ $item->jurusan->akreditasi }}
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('mahasiswa.edit', $item->id_mahasiswa) }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $item->id_mahasiswa) }}" method="POST"
                                      onsubmit="return confirm('Hapus mahasiswa ini?')">
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
                                Belum ada data mahasiswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($mahasiswa->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $mahasiswa->links() }}
    </div>
    @endif
</div>
@endsection