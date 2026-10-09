(function () {
  'use strict';
  const { $, esc } = FT;
  const state = { items: [], categories: [], cat: '' };

  function render() {
    const q = $('#facilitySearch').value.trim().toLowerCase();
    const items = state.items.filter(f =>
      (!state.cat || String(f.category?.id) === state.cat) &&
      (f.name + ' ' + (f.location || '') + ' ' + (f.category?.name || '')).toLowerCase().includes(q));
    $('#facilityCount').textContent = items.length + ' fasilitas';

    $('#facilityGrid').innerHTML = items.length ? items.map(f => `
      <article class="fac-card">
        <div class="fac-top"><span class="fac-ico"><i class="bi bi-building"></i></span><span class="tag">${esc(f.category?.name || 'Tanpa kategori')}</span></div>
        <div><h3>${esc(f.name)}</h3><div class="fac-loc"><i class="bi bi-geo-alt-fill"></i>${esc(f.location || '-')}</div></div>
        <p class="fac-desc">${esc(f.description || 'Belum ada deskripsi.')}</p>
        <a class="btn btn-soft btn-sm" href="/reports/create?facility=${f.id}"><i class="bi bi-megaphone"></i> Laporkan kerusakan</a>
      </article>`).join('')
      : `<div class="panel" style="grid-column:1/-1">${FT.empty('building-x', 'Fasilitas tidak ditemukan', 'Coba kata kunci atau kategori lain.')}</div>`;
  }

  function renderChips() {
    const chips = [['', 'Semua'], ...state.categories.map(c => [String(c.id), c.name])];
    $('#categoryChips').innerHTML = chips.map(([v, n]) => `<button class="chip ${state.cat === v ? 'active' : ''}" data-cat="${esc(v)}">${esc(n)}</button>`).join('');
    $('#fCategory').innerHTML = '<option value="">Pilih kategori...</option>' + state.categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
  }

  async function load() {
    $('#facilityGrid').innerHTML = Array.from({ length: 6 }, () => '<div class="skeleton" style="height:190px;border-radius:20px"></div>').join('');
    const [f, c] = await Promise.all([FT.fetchAll('/facilities?per_page=100'), FT.fetchAll('/categories?per_page=100')]);
    if (!f.ok) { $('#facilityGrid').innerHTML = `<div class="panel" style="grid-column:1/-1">${FT.empty('wifi-off', 'Gagal memuat fasilitas', FT.errorText(f.data))}</div>`; return; }
    state.items = f.items; state.categories = c.items;
    renderChips(); render();
  }

  $('#categoryChips').addEventListener('click', e => { const b = e.target.closest('[data-cat]'); if (!b) return; state.cat = b.dataset.cat; renderChips(); render(); });
  $('#facilitySearch').addEventListener('input', FT.debounce(render, 150));

  const toggleForm = show => $('#formWrap').classList.toggle('hidden', typeof show === 'boolean' ? !show : $('#formWrap').classList.contains('hidden') ? false : true);
  $('#toggleFormBtn')?.addEventListener('click', () => toggleForm());
  $('#cancelFormBtn').addEventListener('click', () => toggleForm(false));

  $('#facilityForm').addEventListener('submit', async e => {
    e.preventDefault();
    const btn = $('#saveBtn');
    const body = { name: $('#fName').value.trim(), location: $('#fLocation').value.trim(), category_id: Number($('#fCategory').value), description: $('#fDesc').value.trim() };
    if (!body.name || !body.location || !body.category_id) { FT.alert('#formMsg', 'Nama, lokasi, dan kategori wajib diisi.'); return; }
    FT.alert('#formMsg', ''); FT.loading(btn, true);
    const r = await FT.api('/facilities', { method: 'POST', body: JSON.stringify(body) });
    FT.loading(btn, false);
    if (!r.ok) { FT.alert('#formMsg', FT.errorText(r.data, 'Gagal menyimpan fasilitas.')); return; }
    e.target.reset(); toggleForm(false); FT.toast('Fasilitas berhasil ditambahkan.'); load();
  });

  FT.ready.then(load);
})();
