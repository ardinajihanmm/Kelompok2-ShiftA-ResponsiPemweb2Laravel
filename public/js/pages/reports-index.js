(function () {
  'use strict';
  const { $ } = FT;
  const state = { page: 1, seq: 0 };

  function rows(items, admin) {
    if (!items.length) return FT.empty('search', 'Tidak ada laporan yang cocok', 'Coba ubah kata kunci atau reset filter.');
    return `<div class="table-wrap"><table>
      <thead><tr><th>Laporan</th><th>Fasilitas</th><th>Prioritas</th><th>Status</th><th>Tanggal</th>${admin ? '<th>Ubah status</th>' : ''}</tr></thead>
      <tbody>${items.map(x => `
        <tr class="is-link" data-id="${x.id}">
          <td><div class="td-title">${FT.esc(x.title)}</div><div class="td-sub">${FT.esc(x.user?.name || 'Pelapor')} &middot; #${x.id}</div></td>
          <td><div class="td-title">${FT.esc(x.facility?.name || '-')}</div><div class="td-sub">${FT.esc(x.facility?.location || '')}</div></td>
          <td>${FT.priorityBadge(x.priority)}</td>
          <td>${FT.statusBadge(x.status)}</td>
          <td>${FT.date(x.created_at)}</td>
          ${admin ? `<td data-stop><select class="select select-sm" data-status="${x.id}" aria-label="Ubah status laporan #${x.id}">${Object.entries(FT.STATUS).map(([k, v]) => `<option value="${k}" ${x.status === k ? 'selected' : ''}>${v}</option>`).join('')}</select></td>` : ''}
        </tr>`).join('')}</tbody></table></div>`;
  }

  async function load() {
    const seq = ++state.seq;
    const q = new URLSearchParams({ per_page: '10', page: state.page });
    const s = $('#search').value.trim(), st = $('#statusFilter').value, pr = $('#priorityFilter').value;
    if (s) q.set('search', s); if (st) q.set('status', st); if (pr) q.set('priority', pr);

    $('#reportTable').innerHTML = FT.skeletonRows(5);
    const r = await FT.api('/reports?' + q);
    if (seq !== state.seq) return; // ada request yang lebih baru
    if (!r.ok) { $('#reportTable').innerHTML = FT.empty('wifi-off', 'Gagal memuat laporan', FT.errorText(r.data)); $('#pagination').innerHTML = ''; return; }

    $('#reportTable').innerHTML = rows(FT.list(r.data), FT.user?.role === 'admin');
    FT.renderPager($('#pagination'), FT.meta(r.data), p => { state.page = p; load(); window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }

  $('#reportTable').addEventListener('click', e => {
    if (e.target.closest('[data-stop]')) return;
    const tr = e.target.closest('tr[data-id]');
    if (tr) location.href = '/reports/' + tr.dataset.id;
  });

  $('#reportTable').addEventListener('change', async e => {
    const sel = e.target.closest('select[data-status]');
    if (!sel) return;
    sel.disabled = true;
    const r = await FT.api('/reports/' + sel.dataset.status, { method: 'PUT', body: JSON.stringify({ status: sel.value }) });
    if (r.ok) FT.toast('Status laporan berhasil diperbarui.'); else FT.toast(FT.errorText(r.data, 'Status gagal diperbarui.'), 'error');
    load();
  });

  const reload = () => { state.page = 1; load(); };
  $('#search').addEventListener('input', FT.debounce(reload, 350));
  $('#statusFilter').addEventListener('change', reload);
  $('#priorityFilter').addEventListener('change', reload);
  $('#resetBtn').addEventListener('click', () => { $('#search').value = ''; $('#statusFilter').value = ''; $('#priorityFilter').value = ''; reload(); });

  FT.ready.then(load);
})();
