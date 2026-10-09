/* Komponen tampilan laporan yang dipakai dashboard & daftar laporan */
(function () {
  'use strict';
  const PRIORITY_ICON = { high: 'lightning-charge-fill', medium: 'wrench-adjustable', low: 'info-circle-fill' };

  FT.reportItem = r => `
    <a class="report-item" href="/reports/${r.id}">
      <span class="report-ico p-${FT.esc(r.priority)}"><i class="bi bi-${PRIORITY_ICON[r.priority] || 'clipboard2'}"></i></span>
      <span class="report-main">
        <strong>${FT.esc(r.title)}</strong>
        <small>${FT.esc(r.facility?.name || 'Fasilitas')} &middot; ${FT.esc(r.user?.name || 'Pelapor')} &middot; ${FT.ago(r.created_at)}</small>
      </span>
      ${FT.statusBadge(r.status)}
    </a>`;

  FT.reportList = items => items.length
    ? `<div class="report-list">${items.map(FT.reportItem).join('')}</div>`
    : FT.empty('clipboard2-x', 'Belum ada laporan', 'Mulai dengan membuat laporan pertama.', '<a class="btn btn-primary btn-sm" href="/reports/create"><i class="bi bi-plus-lg"></i> Buat laporan</a>');
})();
