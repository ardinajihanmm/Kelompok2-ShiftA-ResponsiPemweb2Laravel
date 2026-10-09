<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Masuk') | FasTrack</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body class="auth-page">

    <main class="auth">
        <section class="auth-side">

            <div class="auth-card">

                <a href="{{ route('home') }}" class="auth-logo" aria-label="FasTrack">
                    <span class="brand-mark">
                        <i class="bi bi-buildings-fill"></i>
                    </span>
                    <span>FasTrack</span>
                </a>

                <a href="{{ route('home') }}" class="auth-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke beranda
                </a>

                {{-- Judul dan form berasal dari login.blade.php atau register.blade.php --}}
                @yield('content')

                <p class="auth-foot">
                    Sistem Pelaporan dan Monitoring Kerusakan Fasilitas Kampus
                </p>

            </div>

        </section>
    </main>

    <script src="{{ asset('js/core.js') }}"></script>

    @stack('scripts')

</body>
</html>