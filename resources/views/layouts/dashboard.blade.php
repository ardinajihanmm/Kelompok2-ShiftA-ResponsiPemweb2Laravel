<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | FasTrack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body data-roles="@yield('roles')">
    <div class="shell">
        @include('partials.dashboard.sidebar')
        <div class="overlay" id="overlay"></div>

        <div class="main">
            @include('partials.dashboard.topbar')
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/core.js') }}"></script>
    <script src="{{ asset('js/shell.js') }}"></script>
    @stack('scripts')
</body>
</html>
