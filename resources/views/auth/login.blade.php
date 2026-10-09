
@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <h2>Selamat datang kembali</h2>
    <p class="auth-sub">Masuk untuk mengakses monitoring fasilitas kampus.</p>

    <div id="authMsg"></div>

    <form id="loginForm" novalidate>
        <div class="field">
            <label for="email">Email</label>
            <div class="input-icon">
                <i class="bi bi-envelope"></i>
                <input
                    class="input"
                    id="email"
                    name="email"
                    type="email"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >
            </div>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <div class="input-icon">
                <i class="bi bi-lock"></i>
                <input
                    class="input"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
                <button class="toggle-pass" type="button" aria-label="Tampilkan password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <button class="btn btn-primary btn-block" id="submitBtn" type="submit">
            Masuk ke FasTrack
        </button>
    </form>

    <p class="auth-switch">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
    </p>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
