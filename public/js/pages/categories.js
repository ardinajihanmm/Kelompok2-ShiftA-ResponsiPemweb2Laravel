(function () {
  'use strict';
  const { $, esc } = FT;

  async function load() {
    $('#categoryGrid').innerHTML = Array.from({ length: 4 }, () => '<div class="skeleton" style="height:130px;border-radius:20px"></div>').join('');
    const r = await FT.fetchAll('/categories?per_page=100');
    if (!r.ok) { $('#categoryGrid').innerHTML = `<div class="panel" style="grid-column:1/-1">${FT.empty('wifi-off', 'Gagal memuat kategori', FT.errorText(r.data))}</div>`; return; }
    $('#categoryGrid').innerHTML = r.items.length ? r.items.map(c => `
      <article class="fac-card">
        <div class="fac-top"><span class="fac-ico"><i class="bi bi-tag-fill"></i></span><span class="tag">#${c.id}</span></div>
        <div><h3>${esc(c.name)}</h3></div>
        <p class="fac-desc">${esc(c.description || 'Belum ada deskripsi.')}</p>
      </article>`).join('')
      : `<div class="panel" style="grid-column:1/-1">${FT.empty('tags', 'Belum ada kategori', 'Admin dapat menambahkan kategori baru.')}</div>`;
  }

  const toggleForm = show => $('#formWrap').classList.toggle('hidden', typeof show === 'boolean' ? !show : $('#formWrap').classList.contains('hidden') ? false : true);
  $('#toggleFormBtn')?.addEventListener('click', () => toggleForm());
  $('#cancelFormBtn').addEventListener('click', () => toggleForm(false));

  $('#categoryForm').addEventListener('submit', async e => {
    e.preventDefault();
    const btn = $('#saveBtn');
    const body = { name: $('#cName').value.trim(), description: $('#cDesc').value.trim() };
    if (!body.name) { FT.alert('#formMsg', 'Nama kategori wajib diisi.'); return; }
    FT.alert('#formMsg', ''); FT.loading(btn, true);
    const r = await FT.api('/categories', { method: 'POST', body: JSON.stringify(body) });
    FT.loading(btn, false);
    if (!r.ok) { FT.alert('#formMsg', FT.errorText(r.data, 'Gagal menyimpan kategori.')); return; }
    e.target.reset(); toggleForm(false); FT.toast('Kategori berhasil ditambahkan.'); load();
  });

  FT.ready.then(load);
})();
