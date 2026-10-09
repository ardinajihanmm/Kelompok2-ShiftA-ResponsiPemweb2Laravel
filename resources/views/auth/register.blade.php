<<<<<<< HEAD
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
=======
@extends('layouts.app')

@section('title', 'Daftar - LaporKita')

@section('content')

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="auth-title">
                <h1>Buat Akun ✨</h1>
                <p>Daftar untuk mulai menggunakan LaporKita</p>
            </div>

            <div class="card">

                <div id="error-message" class="alert alert-error" style="display:none;"></div>

                <div id="success-message" class="alert" style="display:none;">
                    Registrasi berhasil.
                </div>

                <form id="register-form">

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>

                        <input type="text" id="name" name="name" class="form-control" placeholder="Nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email" id="email" name="email" class="form-control" placeholder="contoh@email.com"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>

                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Minimal 8 karakter" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            Konfirmasi Password
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password" minlength="8" required>
                    </div>

                    <button type="submit" id="register-button" class="btn btn-primary" style="width:100%;">
                        Daftar
                    </button>

                </form>

                <div class="auth-footer">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', async function (event) {
            event.preventDefault();

            const button = document.getElementById('register-button');
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            if (password !== passwordConfirmation) {
                errorMessage.textContent = 'Konfirmasi password tidak sama.';
                errorMessage.style.display = 'block';
                return;
            }

            button.disabled = true;
            button.textContent = 'Mendaftarkan...';

            try {
                const response = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: passwordConfirmation
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Registrasi gagal.');
                }

                // Simpan token dan data user
                localStorage.setItem('auth_token', result.data.token);
                localStorage.setItem('user', JSON.stringify(result.data.user));

                successMessage.textContent = 'Registrasi berhasil! Mengarahkan ke dashboard...';
                successMessage.style.display = 'block';

                setTimeout(() => {
                    window.location.href = "{{ route('dashboard') }}";
                }, 700);

            } catch (error) {
                errorMessage.textContent = error.message;
                errorMessage.style.display = 'block';

                button.disabled = false;
                button.textContent = 'Daftar';
            }
        });
    </script>

@endsection
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
