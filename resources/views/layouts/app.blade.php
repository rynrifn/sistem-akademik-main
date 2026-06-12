<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Akademik') — UTB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1e429f;
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-active: #1a56db;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-brand .brand-title {
            font-weight: 800;
            font-size: 1.1rem;
            color: #fff;
            line-height: 1.2;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.72rem;
            color: var(--sidebar-text);
            font-weight: 500;
        }
        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .nav-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #475569;
            padding: 1rem 1.25rem 0.3rem;
            text-transform: uppercase;
        }
        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            margin: 0.1rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            transition: all 0.15s;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.07);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: var(--primary);
            font-weight: 600;
        }
        .sidebar .nav-link i { font-size: 1rem; width: 18px; }
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .user-info {
            display: flex; align-items: center; gap: 0.75rem;
            color: var(--sidebar-text);
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .user-name { font-size: 0.8rem; font-weight: 600; color: #e2e8f0; }
        .user-role { font-size: 0.7rem; }

        /* MAIN */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar .page-title {
            font-weight: 700;
            font-size: 1rem;
            color: #0f172a;
        }
        .topbar .breadcrumb {
            margin: 0;
            font-size: 0.78rem;
        }
        .main-content {
            padding: 1.5rem;
            flex: 1;
        }

        /* CARDS */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.25rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: #0f172a;
        }

        /* TABLES */
        .table th {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }
        .table td {
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            vertical-align: middle;
            color: #334155;
        }
        .table tbody tr:hover { background: #f8fafc; }

        /* BADGES */
        .badge-akreditasi-A { background: #dcfce7; color: #166534; }
        .badge-akreditasi-B { background: #dbeafe; color: #1e40af; }
        .badge-akreditasi-C { background: #fef9c3; color: #854d0e; }

        /* BUTTONS */
        .btn { font-size: 0.8rem; font-weight: 600; border-radius: 8px; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-sm { padding: 0.3rem 0.65rem; }

        /* FORMS */
        .form-label { font-size: 0.8rem; font-weight: 600; color: #374151; }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.12);
        }

        /* STAT CARDS */
        .stat-card {
            border-radius: 14px;
            padding: 1.25rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.9;
        }
        .stat-card .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: 0.8rem;
            opacity: 0.85;
            font-weight: 500;
        }

        /* ALERT */
        .alert { border-radius: 10px; font-size: 0.875rem; }

        /* SEARCH BOX */
        .search-box .form-control {
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        .search-box .btn {
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<nav class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">🎓</div>
        <div class="brand-title">Sistem Akademik</div>
        <div class="brand-sub">Universitas Teknologi Bandung</div>
    </div>

    <div class="nav-label">Menu Utama</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
    </ul>

    <div class="nav-label">Data Master</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('jurusan.index') }}"
               class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Jurusan
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mahasiswa.index') }}"
               class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Mahasiswa
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('matakuliah.index') }}"
               class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Matakuliah
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-info mb-2">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger w-100 mt-1">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</nav>

{{-- MAIN --}}
<div class="main-wrapper">
    <div class="topbar">
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary rounded-pill" style="font-size:0.7rem;">
                <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>Online
            </span>
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
