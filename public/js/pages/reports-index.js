(function () {
  'use strict';
  const { $ } = FT;
  const state = { page: 1, seq: 0 };
  let facilityOptions = [];

  const modal = () => $('#adminReportModal');
  function closeAdminModal() {
    modal().style.display = 'none';
    $('#adminReportForm').reset();
    $('#adminReportId').value = '';
    $('#adminReportMsg').innerHTML = '';
    $('#adminReportPhoto').value = '';
  }
  async function openAdminModal(report = null) {
    const isEdit = Boolean(report);
    $('#adminReportModalTitle').textContent = isEdit ? 'Edit laporan' : 'Tambah laporan';
    $('#adminReportId').value = report?.id || '';
    $('#adminReportTitle').value = report?.title || '';
    $('#adminReportDescription').value = report?.description || '';
    $('#adminReportStatus').value = report?.status || 'menunggu';
    $('#adminReportPriority').value = report?.priority || 'medium';
    $('#adminReportPhoto').value = '';

    const facilitySelect = $('#adminReportFacility');
    facilitySelect.innerHTML = '<option value="">Memuat fasilitas...</option>';
    modal().style.display = 'flex';

    const response = await FT.fetchAll('/facilities?per_page=100');
    if (!response.ok) {
      facilitySelect.innerHTML = '<option value="">Gagal memuat fasilitas</option>';
      FT.alert('#adminReportMsg', FT.errorText(response.data, 'Gagal memuat fasilitas.'));
      return;
    }
    facilityOptions = response.items || [];
    facilitySelect.innerHTML = '<option value="">Pilih fasilitas...</option>' +
      facilityOptions.map(f => `<option value="${FT.esc(f.id)}">${FT.esc(f.name)} - ${FT.esc(f.location || '')}</option>`).join('');
    if (report?.facility?.id) facilitySelect.value = String(report.facility.id);
  }

  function rows(items, admin) {
    if (!items.length) return FT.empty('search', 'Tidak ada laporan yang cocok', 'Coba ubah kata kunci atau reset filter.');
    return `<div class="table-wrap"><table>
      <thead><tr><th>Laporan</th><th>Fasilitas</th><th>Prioritas</th><th>Status</th><th>Tanggal</th>${admin ? '<th>Ubah status</th><th>Ubah prioritas</th><th>Aksi</th>' : ''}</tr></thead>
      <tbody>${items.map(x => `
        <tr class="is-link" data-id="${x.id}">
          <td><div class="td-title">${FT.esc(x.title)}</div><div class="td-sub">${FT.esc(x.user?.name || 'Pelapor')} &middot; #${x.id}</div></td>
          <td><div class="td-title">${FT.esc(x.facility?.name || '-')}</div><div class="td-sub">${FT.esc(x.facility?.location || '')}</div></td>
          <td>${FT.priorityBadge(x.priority)}</td>
          <td>${FT.statusBadge(x.status)}</td>
          <td>${FT.date(x.created_at)}</td>
          ${admin ? `<td data-stop><select class="select select-sm" data-status="${x.id}" data-current="${x.status}" aria-label="Ubah status laporan #${x.id}">${Object.entries(FT.STATUS).map(([k, v]) => `<option value="${k}" ${x.status === k ? 'selected' : ''}>${v}</option>`).join('')}</select></td><td data-stop><select class="select select-sm" data-priority="${x.id}" data-current="${x.priority}" aria-label="Ubah prioritas laporan #${x.id}">${Object.entries(FT.PRIORITY).map(([k, v]) => `<option value="${k}" ${x.priority === k ? 'selected' : ''}>${v}</option>`).join('')}</select></td><td data-stop><div style="display:flex;gap:8px;flex-wrap:wrap"><button class="btn btn-outline btn-sm" data-edit-report="${x.id}"><i class="bi bi-pencil-square"></i> Edit</button><button class="btn btn-danger btn-sm" data-delete-report="${x.id}"><i class="bi bi-trash"></i> Hapus</button></div></td>` : ''}
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
    const sel = e.target.closest('select[data-status], select[data-priority]');
    if (!sel) return;
    const field = sel.dataset.status ? 'status' : 'priority';
    const id = sel.dataset.status || sel.dataset.priority;
    const previous = field === 'status' ? (sel.dataset.current || 'menunggu') : (sel.dataset.current || 'medium');
    sel.disabled = true;
    const r = await FT.api('/reports/' + id, { method: 'PUT', body: JSON.stringify({ [field]: sel.value }) });
    if (r.ok) { sel.dataset.current = sel.value; FT.toast(field === 'status' ? 'Status laporan berhasil diperbarui.' : 'Prioritas laporan berhasil diperbarui.'); } else { sel.value = previous; FT.toast(FT.errorText(r.data, 'Perubahan laporan gagal disimpan.'), 'error'); }
    sel.disabled = false;
    load();
  });

  $('#reportTable').addEventListener('click', async e => {
    const btn = e.target.closest('[data-delete-report]'); if (!btn) return;
    if (!await FT.confirm({ title: 'Hapus laporan?', text: 'Laporan yang dihapus tidak dapat dipulihkan.', okText: 'Ya, hapus' })) return;
    btn.disabled = true; const r = await FT.api('/reports/' + btn.dataset.deleteReport, { method: 'DELETE' });
    if (!r.ok) { FT.toast(FT.errorText(r.data, 'Gagal menghapus laporan.'), 'error'); btn.disabled = false; return; }
    FT.toast('Laporan berhasil dihapus.'); load();
  });

  // Admin CRUD: create and update via modal; read is the existing list/detail page; delete stays in the table.
  $('#adminCreateReportBtn')?.addEventListener('click', () => openAdminModal());
  $('#adminReportCloseBtn')?.addEventListener('click', closeAdminModal);
  $('#adminReportCancelBtn')?.addEventListener('click', closeAdminModal);
  modal()?.addEventListener('click', e => { if (e.target === modal()) closeAdminModal(); });

  $('#reportTable').addEventListener('click', async e => {
    const editBtn = e.target.closest('[data-edit-report]');
    if (!editBtn) return;
    e.preventDefault();
    e.stopPropagation();
    editBtn.disabled = true;
    const response = await FT.api('/reports/' + editBtn.dataset.editReport);
    editBtn.disabled = false;
    if (!response.ok) {
      FT.toast(FT.errorText(response.data, 'Gagal memuat laporan untuk diedit.'), 'error');
      return;
    }
    await openAdminModal(response.data.data);
  });

  $('#adminReportForm')?.addEventListener('submit', async e => {
    e.preventDefault();
    const saveBtn = $('#adminReportSaveBtn');
    const reportId = $('#adminReportId').value;
    const facilityId = $('#adminReportFacility').value;
    const title = $('#adminReportTitle').value.trim();
    const description = $('#adminReportDescription').value.trim();
    const status = $('#adminReportStatus').value;
    const priority = $('#adminReportPriority').value;
    const photo = $('#adminReportPhoto').files?.[0];

    if (!facilityId || !title || !description) {
      FT.alert('#adminReportMsg', 'Fasilitas, judul, dan deskripsi wajib diisi.');
      return;
    }
    if (photo && (!['image/jpeg', 'image/png', 'image/webp'].includes(photo.type) || photo.size > 2 * 1024 * 1024)) {
      FT.alert('#adminReportMsg', 'Foto harus JPG, PNG, atau WEBP dan maksimal 2 MB.');
      return;
    }

    let body, method, url;
    if (photo || !reportId) {
      body = new FormData();
      body.append('facility_id', facilityId);
      body.append('title', title);
      body.append('description', description);
      body.append('status', status);
      body.append('priority', priority);
      if (photo) body.append('photo', photo);
      method = reportId ? 'POST' : 'POST';
      url = reportId ? '/reports/' + reportId : '/reports/admin';
      if (reportId) body.append('_method', 'PUT');
    } else {
      body = JSON.stringify({ facility_id: facilityId, title, description, status, priority });
      method = 'PUT';
      url = '/reports/' + reportId;
    }

    FT.loading(saveBtn, true);
    const result = await FT.api(url, {
      method,
      body,
      headers: body instanceof FormData ? { Accept: 'application/json' } : undefined
    });
    FT.loading(saveBtn, false);

    if (!result.ok) {
      FT.alert('#adminReportMsg', FT.errorText(result.data, 'Laporan gagal disimpan.'));
      return;
    }

    FT.toast(reportId ? 'Laporan berhasil diperbarui.' : 'Laporan berhasil ditambahkan.');
    closeAdminModal();
    load();
  });

  const reload = () => { state.page = 1; load(); };
  $('#search').addEventListener('input', FT.debounce(reload, 350));
  $('#statusFilter').addEventListener('change', reload);
  $('#priorityFilter').addEventListener('change', reload);
  $('#resetBtn').addEventListener('click', () => { $('#search').value = ''; $('#statusFilter').value = ''; $('#priorityFilter').value = ''; reload(); });

  FT.ready.then(load);
})();
