@extends('layouts.app')

@section('title', 'Masuk - LaporKita')

@section('content')

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="auth-title">
                <h1>Selamat Datang 👋</h1>
                <p>Masuk ke akun LaporKita kamu</p>
            </div>

            <div class="card">

                <div id="error-message" class="alert alert-error" style="display:none;"></div>

                <div id="success-message" class="alert" style="display:none;">
                    Login berhasil. Mengarahkan...
                </div>

                <form id="login-form">

                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email" id="email" name="email" class="form-control" placeholder="contoh@email.com"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>

                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" id="login-button" class="btn btn-primary" style="width:100%;">
                        Masuk
                    </button>

                </form>

                <div class="auth-footer">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function (event) {
            event.preventDefault();

            const button = document.getElementById('login-button');
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Reset pesan
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            button.disabled = true;
            button.textContent = 'Memproses...';

            try {
                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Login gagal.');
                }

                // Simpan token dan data user
                localStorage.setItem('auth_token', result.data.token);
                localStorage.setItem('user', JSON.stringify(result.data.user));

                successMessage.style.display = 'block';

                // Masuk ke dashboard
                setTimeout(() => {
                    window.location.href = "{{ route('dashboard') }}";
                }, 500);

            } catch (error) {
                errorMessage.textContent = error.message;
                errorMessage.style.display = 'block';

                button.disabled = false;
                button.textContent = 'Masuk';
            }
        });
    </script>

@endsection