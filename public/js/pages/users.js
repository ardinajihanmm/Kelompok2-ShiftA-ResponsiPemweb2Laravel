(function () {
  'use strict';
  const { $, esc } = FT;
  const state = { page: 1, seq: 0 };

  async function load() {
    const seq = ++state.seq;
    const q = new URLSearchParams({ page: state.page });
    const s = $('#userSearch').value.trim(); if (s) q.set('search', s);
    $('#userTable').innerHTML = FT.skeletonRows(5);
    const r = await FT.api('/users?' + q);
    if (seq !== state.seq) return;
    if (!r.ok) { $('#userTable').innerHTML = FT.empty('shield-lock', 'Tidak dapat memuat pengguna', FT.errorText(r.data, 'Pastikan akses admin aktif.')); return; }

    const items = FT.list(r.data), meta = FT.meta(r.data);
    $('#userCount').textContent = (meta?.total ?? items.length) + ' pengguna';
    $('#userTable').innerHTML = items.length ? `<div class="table-wrap"><table>
      <thead><tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Terdaftar</th></tr></thead>
      <tbody>${items.map(u => `<tr>
        <td><div class="cell-user"><div class="avatar">${FT.initial(u.name)}</div><div><div class="td-title">${esc(u.name)}</div><div class="td-sub">User #${u.id}</div></div></div></td>
        <td>${esc(u.email)}</td><td>${FT.roleBadge(u.role)}</td><td>${FT.date(u.created_at)}</td></tr>`).join('')}</tbody></table></div>
      <div class="pagination" id="pagination"></div>`
      : FT.empty('people', 'Pengguna tidak ditemukan', 'Coba kata kunci lain.');
    FT.renderPager($('#pagination'), meta, p => { state.page = p; load(); });
  }

  $('#userSearch').addEventListener('input', FT.debounce(() => { state.page = 1; load(); }, 350));
  FT.ready.then(load);
})();
