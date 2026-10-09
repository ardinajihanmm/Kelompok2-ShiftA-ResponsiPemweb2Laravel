<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'LaporKita')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .logo span {
            color: #111827;
        }

        .nav-menu {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #4b5563;
            font-size: 14px;
        }

        .nav-menu a:hover {
            color: #2563eb;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            padding: 11px 18px;
            font-weight: bold;
        }

        .btn-primary {
            background: #2563eb;
            color: white !important;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-outline {
            border: 1px solid #2563eb;
            color: #2563eb !important;
            background: white;
        }

        .container {
            width: 86%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page {
            padding: 50px 0;
            min-height: calc(100vh - 140px);
        }

        .page-title {
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #6b7280;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .auth-wrapper {
            min-height: calc(100vh - 140px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
        }

        .auth-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-title h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .auth-title p {
            color: #6b7280;
            font-size: 14px;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 14px;
        }

        .auth-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 25px;
        }

        footer p {
            color: #9ca3af;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 0 5%;
            }

            .nav-menu {
                gap: 10px;
            }

            .nav-menu a:not(.btn) {
                display: none;
            }

            .container {
                width: 90%;
            }
        }
    </style>

    @yield('styles')
</head>

<body>

    <nav class="navbar">

        <a href="{{ route('home') }}" class="logo">
            Lapor<span>Kita</span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('reports.index') }}">Laporan</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>

            <a href="{{ route('login') }}" class="btn btn-primary">
                Masuk
            </a>
        </div>

    </nav>

    @yield('content')

    <footer>
        <p>
            © 2026 LaporKita — Sistem Pelaporan Fasilitas Kampus
        </p>
    </footer>

@yield('scripts')
</body>

</html>