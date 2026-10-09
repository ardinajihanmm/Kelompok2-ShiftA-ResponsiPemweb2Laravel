/* FasTrack shell: guard login & role, isi data user, menu per role, logout, sidebar mobile. */
(function () {
  'use strict';
  const { $, $$ } = FT;

  if (!FT.token()) { FT.ready = new Promise(() => {}); location.replace('/login'); return; }

  // Role yang boleh membuka halaman ini (kosong = semua role yang sudah login).
  const allowedRoles = (document.body.dataset.roles || '').split(',').map(s => s.trim()).filter(Boolean);

  // Pesan singkat setelah redirect (mis. dialihkan karena tidak punya akses).
  function showFlash() {
    const msg = sessionStorage.getItem('ft_flash');
    if (msg) { sessionStorage.removeItem('ft_flash'); FT.toast(msg, 'error'); }
  }

  FT.ready = FT.api('/auth/me').then(r => {
    if (!r.ok) { FT.clearToken(); location.replace('/login'); return new Promise(() => {}); }
    const u = r.data.data || {};
    FT.user = u;
    const role = u.role || 'mahasiswa';

    if (allowedRoles.length && !allowedRoles.includes(role)) {
      sessionStorage.setItem('ft_flash', 'Halaman tersebut tidak tersedia untuk akun ' + role + '.');
      location.replace('/dashboard');
      return new Promise(() => {});
    }

    $$('[data-user-name]').forEach(el => el.textContent = u.name || 'Pengguna');
    $$('[data-user-first]').forEach(el => el.textContent = (u.name || 'Pengguna').split(' ')[0]);
    $$('[data-user-email]').forEach(el => el.textContent = u.email || '');
    $$('[data-user-role]').forEach(el => el.textContent = role.charAt(0).toUpperCase() + role.slice(1));
    $$('[data-user-initial]').forEach(el => el.textContent = FT.initial(u.name));

    // Menu & elemen per role
    $$('.admin-only').forEach(el => el.classList.toggle('hidden', role !== 'admin'));
    $$('.mahasiswa-only').forEach(el => el.classList.toggle('hidden', role !== 'mahasiswa'));
    // Teks per role: data-text-admin="..." data-text-mahasiswa="..."
    $$(`[data-text-${role}]`).forEach(el => el.textContent = el.getAttribute(`data-text-${role}`));

    document.body.classList.add('is-ready');
    showFlash();
    return u;
  });

  async function logout() {
    await FT.api('/auth/logout', { method: 'POST' });
    FT.clearToken();
    location.replace('/login');
  }
  $$('[data-logout]').forEach(b => b.addEventListener('click', async () => {
    if (await FT.confirm({ title: 'Keluar dari akun?', text: 'Kamu perlu login lagi untuk mengakses FasTrack.', okText: 'Ya, keluar', danger: false })) logout();
  }));

  const sidebar = $('#sidebar'), overlay = $('#overlay');
  function toggle(force) {
    const open = typeof force === 'boolean' ? force : !sidebar.classList.contains('open');
    sidebar.classList.toggle('open', open);
    overlay.classList.toggle('show', open);
  }
  $('#menuBtn')?.addEventListener('click', () => toggle());
  overlay?.addEventListener('click', () => toggle(false));
  document.addEventListener('keydown', e => { if (e.key === 'Escape') toggle(false); });
})();
