<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Akademik UTB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -200px; left: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(26,86,219,0.3) 0%, transparent 70%);
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -200px; right: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
            border-radius: 50%;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }
        .login-logo {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #1a56db, #6366f1);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.25rem;
        }
        h1 { font-size: 1.6rem; font-weight: 800; color: #0f172a; }
        .subtitle { color: #64748b; font-size: 0.875rem; }
        .form-label { font-size: 0.8rem; font-weight: 600; color: #374151; }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 0.6rem 0.9rem;
            font-size: 0.875rem;
        }
        .form-control:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.12);
        }
        .btn-login {
            background: linear-gradient(135deg, #1a56db, #6366f1);
            border: none;
            border-radius: 10px;
            padding: 0.65rem;
            font-weight: 700;
            font-size: 0.875rem;
            color: #fff;
            width: 100%;
            transition: opacity 0.2s;
        }
        .btn-login:hover { opacity: 0.9; color: #fff; }
        .divider {
            display: flex; align-items: center; gap: 0.75rem;
            color: #94a3b8; font-size: 0.78rem;
            margin: 1rem 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: #e2e8f0;
        }
        .hint-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.78rem;
            color: #0369a1;
        }
        .is-invalid { border-color: #ef4444 !important; }
        .invalid-feedback { font-size: 0.75rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">🎓</div>
        <h1>Selamat Datang</h1>
        <p class="subtitle mb-4">Sistem Akademik — Universitas Teknologi Bandung</p>

        @if($errors->any())
            <div class="alert alert-danger rounded-3 py-2 px-3 mb-3" style="font-size:0.8rem;">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Email atau password salah.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="admin@akademik.com" autofocus required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Sistem
            </button>
        </form>

        <div class="divider">Demo Login</div>

        <div class="hint-box">
            <i class="bi bi-info-circle me-1"></i>
            <strong>Email:</strong> admin@akademik.com &nbsp;|&nbsp;
            <strong>Password:</strong> password
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
