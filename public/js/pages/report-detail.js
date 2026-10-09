(function () {
  'use strict';
  const { $, esc } = FT;
  const root = $('#detailRoot');
  const id = root.dataset.reportId;
  let report = null, cPage = 1, cTotal = 0;

  const isAdmin = () => FT.user?.role === 'admin';
  const isOwner = () => report?.user?.id === FT.user?.id;

  function steps(status) {
    let list;
    if (status === 'ditolak') {
      list = [['done', 'Laporan dibuat', 'Tercatat di sistem'], ['done', 'Ditinjau admin', 'Laporan telah diperiksa'], ['rejected', 'Ditolak', 'Laporan tidak dapat ditindaklanjuti']];
    } else {
      const order = ['menunggu', 'diproses', 'selesai'], cur = order.indexOf(status);
      const meta = [['Menunggu', 'Menunggu ditinjau admin'], ['Diproses', 'Sedang ditindaklanjuti'], ['Selesai', 'Masalah sudah ditangani']];
      list = meta.map((m, i) => [status === 'selesai' || i < cur ? 'done' : i === cur ? 'current' : '', m[0], m[1]]);
    }
    return `<div class="steps">${list.map(([c, t, s]) => `<div class="step ${c}"><span class="step-dot"><i class="bi bi-${c === 'rejected' ? 'x-lg' : c === 'done' ? 'check-lg' : 'circle'}"></i></span><div><strong>${t}</strong><small>${s}</small></div></div>`).join('')}</div>`;
  }

  function render() {
    const r = report;
    const info = (icon, label, val) => `<div class="info-item"><span class="i-ico"><i class="bi bi-${icon}"></i></span><div><small>${label}</small><b>${val}</b></div></div>`;
    root.innerHTML = `
    <div class="detail-grid">
      <div class="stack">
        <section class="panel">
          <div class="meta-row">${FT.statusBadge(r.status)} ${FT.priorityBadge(r.priority)} <span class="tag">#${r.id}</span></div>
          <h1 class="detail-title">${esc(r.title)}</h1>
          <div class="desc-text">${esc(r.description)}</div>
          ${r.photo_url ? `<div class="report-photo-wrap" style="margin-top:20px"><h3 style="font-size:16px;margin:0 0 10px">Foto bukti kerusakan</h3><a href="${esc(r.photo_url)}" target="_blank" rel="noopener"><img src="${esc(r.photo_url)}" alt="Foto bukti kerusakan laporan #${r.id}" style="display:block;max-width:100%;max-height:420px;object-fit:contain;border-radius:14px;border:1px solid #dbe3ef"></a></div>` : `<div class="field-hint" style="margin-top:18px">${r.photo_path ? 'Foto bukti tersimpan, tetapi URL belum tersedia.' : 'Belum ada foto bukti pada laporan ini.'}</div>`}
        </section>

        <section class="panel">
          <div class="panel-head"><div><h2>Tanggapan</h2><p id="commentCount">Memuat tanggapan...</p></div></div>
          <form class="comment-form" id="commentForm">
            <div class="avatar" data-user-initial>${FT.initial(FT.user?.name)}</div>
            <div style="flex:1">
              <textarea class="textarea" id="commentText" maxlength="1000" placeholder="Tulis tanggapan atau pembaruan..." required></textarea>
              <div class="form-actions" style="margin-top:10px"><button class="btn btn-primary btn-sm" id="commentBtn" type="submit"><i class="bi bi-send"></i> Kirim tanggapan</button></div>
            </div>
          </form>
          <div class="comments" id="comments"></div>
          <div id="moreWrap" style="text-align:center;margin-top:16px"></div>
        </section>
      </div>

      <div class="stack">
        <section class="panel">
          <div class="panel-head"><h2>Informasi laporan</h2></div>
          <div class="info-list">
            ${info('person', 'Pelapor', esc(r.user?.name || '-'))}
            ${info('building', 'Fasilitas', esc(r.facility?.name || '-'))}
            ${info('geo-alt', 'Lokasi', esc(r.facility?.location || '-'))}
            ${info('calendar-event', 'Dibuat', FT.dateTime(r.created_at))}
            ${info('clock-history', 'Diperbarui', FT.dateTime(r.updated_at))}
          </div>
        </section>

        <section class="panel">
          <div class="panel-head"><h2>Progres penanganan</h2></div>
          ${steps(r.status)}
          ${isAdmin() ? `<div class="field" style="margin:20px 0 0"><label for="statusSel">Ubah status (admin)</label>
            <select class="select" id="statusSel">${Object.entries(FT.STATUS).map(([k, v]) => `<option value="${k}" ${r.status === k ? 'selected' : ''}>${v}</option>`).join('')}</select></div>` : ''}
        </section>

        ${(isAdmin() || isOwner()) ? `<button class="btn btn-danger" id="deleteBtn" type="button"><i class="bi bi-trash3"></i> Hapus laporan</button>` : ''}
      </div>
    </div>`;

    $('#statusSel')?.addEventListener('change', changeStatus);
    $('#deleteBtn')?.addEventListener('click', remove);
    $('#commentForm').addEventListener('submit', postComment);
    $('#comments').addEventListener('click', onCommentClick);
    document.title = r.title + ' | FasTrack';
    cPage = 1; loadComments(true);
  }

  async function changeStatus(e) {
    const sel = e.target; sel.disabled = true;
    const res = await FT.api('/reports/' + id, { method: 'PUT', body: JSON.stringify({ status: sel.value }) });
    if (!res.ok) { FT.toast(FT.errorText(res.data, 'Status gagal diperbarui.'), 'error'); sel.disabled = false; sel.value = report.status; return; }
    report = Object.assign(report, res.data.data || {}); FT.toast('Status laporan berhasil diperbarui.'); render();
  }

  async function remove() {
    if (!await FT.confirm({ title: 'Hapus laporan ini?', text: 'Laporan dan seluruh tanggapannya akan dihapus permanen.', okText: 'Ya, hapus' })) return;
    const btn = $('#deleteBtn'); FT.loading(btn, true);
    const res = await FT.api('/reports/' + id, { method: 'DELETE' });
    if (!res.ok) { FT.toast(FT.errorText(res.data, 'Laporan gagal dihapus.'), 'error'); FT.loading(btn, false); return; }
    FT.toast('Laporan berhasil dihapus.'); setTimeout(() => location.href = '/reports', 500);
  }

  const commentHtml = c => {
    const mine = c.user?.id === FT.user?.id, canDel = mine || isAdmin();
    return `<div class="comment ${mine ? 'mine' : ''}" data-cid="${c.id}">
      <div class="avatar">${FT.initial(c.user?.name)}</div>
      <div class="comment-body">
        <div class="comment-head"><b>${esc(c.user?.name || 'Pengguna')}</b>${c.user?.role === 'admin' ? FT.roleBadge('admin') : ''}<small>${FT.ago(c.created_at)}</small>
          ${canDel ? `<button class="btn btn-ghost btn-sm" data-del="${c.id}" aria-label="Hapus tanggapan"><i class="bi bi-trash3"></i></button>` : ''}</div>
        <div class="comment-text">${esc(c.comment)}</div>
      </div></div>`;
  };

  const updateCount = () => { const el = $('#commentCount'); if (el) el.textContent = cTotal ? cTotal + ' tanggapan' : 'Belum ada tanggapan'; };

  async function loadComments(reset) {
    const box = $('#comments');
    if (reset) box.innerHTML = FT.skeletonRows(2);
    const res = await FT.api(`/reports/${id}/comments?page=${cPage}`);
    if (!res.ok) { box.innerHTML = FT.empty('wifi-off', 'Gagal memuat tanggapan', FT.errorText(res.data)); return; }
    const items = FT.list(res.data), meta = FT.meta(res.data);
    cTotal = meta?.total ?? items.length;
    if (reset) box.innerHTML = '';
    if (reset && !items.length) box.innerHTML = FT.empty('chat-left-dots', 'Belum ada tanggapan', 'Jadilah yang pertama memberi tanggapan.');
    else box.insertAdjacentHTML('beforeend', items.map(commentHtml).join(''));
    updateCount();
    const more = meta && meta.current_page < meta.last_page;
    $('#moreWrap').innerHTML = more ? '<button class="btn btn-outline btn-sm" id="moreBtn">Muat tanggapan sebelumnya</button>' : '';
    $('#moreBtn')?.addEventListener('click', async e => { FT.loading(e.currentTarget, true); cPage++; await loadComments(false); });
  }

  async function postComment(e) {
    e.preventDefault();
    const ta = $('#commentText'), btn = $('#commentBtn'), text = ta.value.trim();
    if (!text) return;
    FT.loading(btn, true);
    const res = await FT.api(`/reports/${id}/comments`, { method: 'POST', body: JSON.stringify({ comment: text }) });
    FT.loading(btn, false);
    if (!res.ok) { FT.toast(FT.errorText(res.data, 'Tanggapan gagal dikirim.'), 'error'); return; }
    ta.value = '';
    const box = $('#comments');
    if (!box.querySelector('.comment')) box.innerHTML = '';
    box.insertAdjacentHTML('afterbegin', commentHtml(res.data.data));
    cTotal++; updateCount();
    FT.toast('Tanggapan berhasil ditambahkan.');
  }

  async function onCommentClick(e) {
    const b = e.target.closest('[data-del]'); if (!b) return;
    if (!await FT.confirm({ title: 'Hapus tanggapan?', text: 'Tanggapan ini akan dihapus permanen.', okText: 'Ya, hapus' })) return;
    const res = await FT.api('/comments/' + b.dataset.del, { method: 'DELETE' });
    if (!res.ok) { FT.toast(FT.errorText(res.data, 'Tanggapan gagal dihapus.'), 'error'); return; }
    b.closest('.comment').remove(); cTotal = Math.max(0, cTotal - 1); updateCount();
    if (!$('#comments').querySelector('.comment')) $('#comments').innerHTML = FT.empty('chat-left-dots', 'Belum ada tanggapan', 'Jadilah yang pertama memberi tanggapan.');
    FT.toast('Tanggapan berhasil dihapus.');
  }

  FT.ready.then(async () => {
    const res = await FT.api('/reports/' + id);
    if (!res.ok) {
      root.innerHTML = `<div class="panel">${FT.empty('file-earmark-x', res.status === 404 ? 'Laporan tidak ditemukan' : 'Gagal memuat laporan', FT.errorText(res.data), '<a class="btn btn-primary btn-sm" href="/reports">Kembali ke daftar</a>')}</div>`;
      return;
    }
    report = res.data.data; render();
  });
})();
