(function () {
  'use strict';
  const { $ } = FT;
  const COLORS = { menunggu: '#f59e0b', diproses: '#3b82f6', selesai: '#10b981', ditolak: '#ef4444' };

  function countUp(el, to) {
    const dur = 700, t0 = performance.now();
    (function tick(t) {
      const p = Math.min(1, (t - t0) / dur);
      el.textContent = Math.round(to * (1 - Math.pow(1 - p, 3)));
      if (p < 1) requestAnimationFrame(tick);
    })(t0);
  }

  async function total(extra = '') {
    const r = await FT.api('/reports?per_page=1' + extra);
    return r.ok ? (FT.meta(r.data)?.total ?? FT.list(r.data).length) : 0;
  }

  async function load() {
    $('#recentReports').innerHTML = FT.skeletonRows(4);

    const [all, menunggu, diproses, selesai, ditolak, recent] = await Promise.all([
      total(), total('&status=menunggu'), total('&status=diproses'), total('&status=selesai'), total('&status=ditolak'),
      FT.api('/reports?per_page=5'),
    ]);

    countUp($('#statTotal'), all); countUp($('#statMenunggu'), menunggu);
    countUp($('#statDiproses'), diproses); countUp($('#statSelesai'), selesai);

    const parts = { menunggu, diproses, selesai, ditolak };
    $('#distBar').innerHTML = all
      ? Object.entries(parts).map(([k, v]) => `<span style="width:${(v / all) * 100}%;background:${COLORS[k]}" title="${FT.STATUS[k]}: ${v}"></span>`).join('')
      : '';
    $('#distLegend').innerHTML = Object.entries(parts).map(([k, v]) =>
      `<div><i style="background:${COLORS[k]}"></i>${FT.STATUS[k]}<b>${v}</b></div>`).join('');

    $('#recentReports').innerHTML = recent.ok
      ? FT.reportList(FT.list(recent.data))
      : FT.empty('wifi-off', 'Gagal memuat laporan', FT.errorText(recent.data, 'Periksa koneksi ke server.'));
  }

  FT.ready.then(load);
})();
