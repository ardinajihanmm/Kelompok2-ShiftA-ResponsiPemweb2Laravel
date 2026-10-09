<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FasTrack | Pelaporan Fasilitas Kampus')</title>
    <meta name="description" content="FasTrack adalah sistem pelaporan dan monitoring kerusakan fasilitas kampus. Laporkan, pantau, dan tindak lanjuti dalam satu platform.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body class="landing">
    @include('partials.landing.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.landing.footer')

    <script src="{{ asset('js/core.js') }}"></script>
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
