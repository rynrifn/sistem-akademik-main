@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a56db,#3b82f6);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $totalJurusan }}</div>
                    <div class="stat-label mt-1">Total Jurusan</div>
                </div>
                <div class="stat-icon">🏫</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#059669,#10b981);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $totalMahasiswa }}</div>
                    <div class="stat-label mt-1">Total Mahasiswa</div>
                </div>
                <div class="stat-icon">👨‍🎓</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#7c3aed,#a78bfa);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $totalMatakuliah }}</div>
                    <div class="stat-label mt-1">Total Matakuliah</div>
                </div>
                <div class="stat-icon">📚</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-building text-primary"></i> Ringkasan per Jurusan
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Jurusan</th>
                        <th>Akreditasi</th>
                        <th>Mahasiswa</th>
                        <th>Matakuliah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusanList as $j)
                    <tr>
                        <td class="fw-600">{{ $j->nama_jurusan }}</td>
                        <td>
                            <span class="badge badge-akreditasi-{{ $j->akreditasi }} px-2 py-1 rounded-2 fw-bold">
                                Akreditasi {{ $j->akreditasi }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-success-subtle text-success px-2 py-1">
                                {{ $j->mahasiswa_count }} mahasiswa
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-purple-subtle text-purple px-2 py-1" style="background:#ede9fe;color:#6d28d9;">
                                {{ $j->matakuliah_count }} matkul
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('jurusan.edit', $j->id_jurusan) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data jurusan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
