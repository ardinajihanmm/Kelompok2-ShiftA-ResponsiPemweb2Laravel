/* FasTrack shell: guard login, isi data user di sidebar/topbar, logout, sidebar mobile. */
(function () {
  'use strict';
  const { $, $$ } = FT;

  if (!FT.token()) { FT.ready = new Promise(() => {}); location.replace('/login'); return; }

  const adminOnlyPage = document.body.dataset.admin === '1';

  FT.ready = FT.api('/auth/me').then(r => {
    if (!r.ok) { FT.clearToken(); location.replace('/login'); return new Promise(() => {}); }
    const u = r.data.data || {};
    FT.user = u;

    if (adminOnlyPage && u.role !== 'admin') { location.replace('/dashboard'); return new Promise(() => {}); }

    const role = (u.role || 'mahasiswa');
    $$('[data-user-name]').forEach(el => el.textContent = u.name || 'Pengguna');
    $$('[data-user-first]').forEach(el => el.textContent = (u.name || 'Pengguna').split(' ')[0]);
    $$('[data-user-email]').forEach(el => el.textContent = u.email || '');
    $$('[data-user-role]').forEach(el => el.textContent = role.charAt(0).toUpperCase() + role.slice(1));
    $$('[data-user-initial]').forEach(el => el.textContent = FT.initial(u.name));
    $$('.admin-only').forEach(el => el.classList.toggle('hidden', role !== 'admin'));
    document.body.classList.add('is-ready');
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
