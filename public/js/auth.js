/* FasTrack: login & register (Bearer token via Sanctum, endpoint API tidak berubah) */
(function () {
  'use strict';
  const { $ } = FT;

  // Sudah login? langsung ke dashboard.
  if (FT.token()) {
    FT.api('/auth/me').then(r => { if (r.ok) location.replace('/dashboard'); });
  }

  FT.bindPasswordToggles();

  const loginForm = $('#loginForm'), registerForm = $('#registerForm');
  const form = loginForm || registerForm;
  if (!form) return;
  const mode = loginForm ? 'login' : 'register';

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const btn = $('#submitBtn');
    const body = { email: $('#email').value.trim(), password: $('#password').value };
    if (mode === 'register') {
      body.name = $('#name').value.trim();
      body.password_confirmation = $('#password_confirmation').value;
      if (body.password !== body.password_confirmation) {
        FT.alert('#authMsg', 'Konfirmasi password tidak sama.');
        return;
      }
    }
    FT.alert('#authMsg', '');
    FT.loading(btn, true);
    const r = await FT.api('/auth/' + mode, { method: 'POST', body: JSON.stringify(body) });
    if (!r.ok) {
      FT.alert('#authMsg', FT.errorText(r.data, 'Tidak dapat masuk. Periksa data yang kamu isi.'));
      FT.loading(btn, false);
      return;
    }
    FT.setToken(r.data.data.token);
    FT.alert('#authMsg', mode === 'login' ? 'Login berhasil. Mengalihkan...' : 'Akun berhasil dibuat. Mengalihkan...', 'success');
    location.replace('/dashboard');
  });
})();
