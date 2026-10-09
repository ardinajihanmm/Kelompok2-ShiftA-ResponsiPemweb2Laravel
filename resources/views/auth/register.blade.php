@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <h2>Buat akun FasTrack</h2>
    <p class="auth-sub">Daftar sebagai mahasiswa untuk mulai membuat dan memantau laporan.</p>

    <div id="authMsg"></div>

    <form id="registerForm" novalidate>
        <div class="field">
            <label for="name">Nama lengkap</label>
            <div class="input-icon">
                <i class="bi bi-person"></i>
                <input class="input" id="name" type="text" placeholder="Nama kamu" autocomplete="name" required>
            </div>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <div class="input-icon">
                <i class="bi bi-envelope"></i>
                <input class="input" id="email" type="email" placeholder="nama@email.com" autocomplete="email" required>
            </div>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <div class="input-icon">
                <i class="bi bi-lock"></i>
                <input class="input" id="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                <button class="toggle-pass" type="button" aria-label="Tampilkan password"><i class="bi bi-eye"></i></button>
            </div>
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi password</label>
            <div class="input-icon">
                <i class="bi bi-shield-lock"></i>
                <input class="input" id="password_confirmation" type="password" placeholder="Ulangi password" autocomplete="new-password" required>
            </div>
        </div>

        <button class="btn btn-primary btn-block" id="submitBtn" type="submit">Buat akun</button>
    </form>

    <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
