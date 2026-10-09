/* FasTrack core: helper bersama (API, token, format, toast). */
(function (w) {
  'use strict';
  const TOKEN_KEY = 'fastrack_token';
  const FT = {};
  FT.token = () => localStorage.getItem(TOKEN_KEY);
  FT.setToken = t => localStorage.setItem(TOKEN_KEY, t);
  FT.clearToken = () => localStorage.removeItem(TOKEN_KEY);
  FT.$ = (sel, root = document) => root.querySelector(sel);
  FT.$$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
  FT.esc = v => String(v ?? '').replace(/[&<>"']/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m]));

  FT.api = async function (path, options = {}) {
    const headers = Object.assign({ Accept: 'application/json' }, options.headers || {});
    const isFormData = typeof FormData !== 'undefined' && options.body instanceof FormData;
    if (isFormData) {
      // Browser harus menentukan multipart boundary sendiri.
      delete headers['Content-Type'];
    } else if (options.body && !headers['Content-Type']) {
      headers['Content-Type'] = 'application/json';
    }
    if (FT.token()) headers.Authorization = 'Bearer ' + FT.token();
    let res;
    try {
      res = await fetch('/api' + path, Object.assign({}, options, { headers }));
    } catch (e) {
      return { ok: false, status: 0, data: { message: 'Tidak dapat terhubung ke server. Pastikan Laravel sedang berjalan.' } };
    }
    const data = await res.json().catch(() => ({}));
    // Hanya endpoint pemeriksaan sesi yang mengakhiri sesi browser.
    // Error 401 endpoint lain ditampilkan pada halaman terkait agar tidak terjadi redirect loop.
    if (res.status === 401 && path.split('?')[0] === '/auth/me') {
      FT.clearToken();
      if (!/^\/(login|register)\/?$/.test(location.pathname)) location.replace('/login');
    }
    return { ok: res.ok, status: res.status, data };
  };
  FT.list = d => Array.isArray(d?.data) ? d.data : (d?.data?.data || []);
  FT.meta = d => d?.meta || null;
  FT.errorText = (d, fallback = 'Terjadi kesalahan. Coba lagi.') => d?.errors ? Object.values(d.errors).flat().join(' ') : (d?.message || fallback);
  FT.debounce = (fn, ms = 300) => { let t; return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), ms); }; };
  FT.initial = name => (String(name || 'F').trim().charAt(0) || 'F').toUpperCase();
  FT.date = v => v ? new Date(v).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : '-';
  FT.dateTime = v => v ? new Date(v).toLocaleString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }) : '-';
  FT.ago = v => { if (!v) return '-'; const s = Math.max(1, Math.floor((Date.now() - new Date(v).getTime()) / 1000)); if (s < 60) return 'baru saja'; const m = Math.floor(s / 60); if (m < 60) return m + ' menit lalu'; const h = Math.floor(m / 60); if (h < 24) return h + ' jam lalu'; const d = Math.floor(h / 24); if (d < 7) return d + ' hari lalu'; return FT.date(v); };
  const STATUS = { menunggu: 'Menunggu', diproses: 'Diproses', selesai: 'Selesai', ditolak: 'Ditolak' };
  const PRIORITY = { low: 'Rendah', medium: 'Sedang', high: 'Tinggi' };
  FT.STATUS = STATUS; FT.PRIORITY = PRIORITY;
  FT.statusBadge = s => `<span class="badge s-${FT.esc(s)}">${FT.esc(STATUS[s] || s || 'Menunggu')}</span>`;
  FT.priorityBadge = p => `<span class="badge p-${FT.esc(p)}">${FT.esc(PRIORITY[p] || p || '-')}</span>`;
  FT.roleBadge = r => `<span class="badge no-dot role-${FT.esc(r || 'mahasiswa')}">${FT.esc((r || 'mahasiswa').replace(/^./, c => c.toUpperCase()))}</span>`;
  FT.empty = (icon, title, text = '', action = '') => `<div class="empty"><div class="empty-icon"><i class="bi bi-${icon}"></i></div><strong>${FT.esc(title)}</strong>${text ? `<p>${FT.esc(text)}</p>` : ''}${action}</div>`;
  FT.skeletonRows = (n = 4) => Array.from({ length: n }, () => '<div class="skeleton" style="height:58px;margin-bottom:10px;border-radius:12px"></div>').join('');
  FT.toast = function (text, type = 'ok') { let wrap = FT.$('.toast-wrap'); if (!wrap) { wrap = document.createElement('div'); wrap.className = 'toast-wrap'; document.body.appendChild(wrap); } const el = document.createElement('div'); el.className = 'toast' + (type === 'error' ? ' error' : ''); el.setAttribute('role', 'status'); el.innerHTML = `<i class="bi bi-${type === 'error' ? 'exclamation-circle-fill' : 'check-circle-fill'}"></i><span>${FT.esc(text)}</span>`; wrap.appendChild(el); setTimeout(() => { el.style.transition = 'opacity .25s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 260); }, 3300); };
  FT.alert = function (target, text, type = 'error') { const el = typeof target === 'string' ? FT.$(target) : target; if (!el) return; el.innerHTML = text ? `<div class="alert alert-${type}"><i class="bi bi-${type === 'error' ? 'exclamation-circle-fill' : type === 'success' ? 'check-circle-fill' : 'info-circle-fill'}"></i><span>${FT.esc(text)}</span></div>` : ''; };
  FT.loading = (btn, on) => { if (!btn) return; btn.classList.toggle('is-loading', on); btn.disabled = on; };
  FT.confirm = function ({ title, text, okText = 'Ya, lanjutkan', danger = true }) { return new Promise(resolve => { const m = document.createElement('div'); m.className = 'modal-backdrop'; m.innerHTML = `<div class="modal" role="dialog" aria-modal="true"><div class="modal-icon ${danger ? 'danger' : ''}"><i class="bi bi-${danger ? 'trash3' : 'question-circle'}"></i></div><h3>${FT.esc(title)}</h3><p>${FT.esc(text || '')}</p><div class="modal-actions"><button class="btn btn-outline" data-x="0">Batal</button><button class="btn ${danger ? 'btn-danger' : 'btn-primary'}" data-x="1">${FT.esc(okText)}</button></div></div>`; const close = v => { m.remove(); resolve(v); }; m.addEventListener('click', e => { if (e.target === m) close(false); const b = e.target.closest('[data-x]'); if (b) close(b.dataset.x === '1'); }); document.body.appendChild(m); m.querySelector('[data-x="0"]').focus(); }); };
  FT.bindPasswordToggles = () => FT.$$('.toggle-pass').forEach(b => b.addEventListener('click', () => { const input = b.parentElement.querySelector('input'); const show = input.type === 'password'; input.type = show ? 'text' : 'password'; b.innerHTML = `<i class="bi bi-eye${show ? '-slash' : ''}"></i>`; }));
  FT.fetchAll = async function (path, maxPages = 30) { let page = 1, last = 1, items = []; do { const r = await FT.api(path + (path.includes('?') ? '&' : '?') + 'page=' + page); if (!r.ok) return { ok: false, items, data: r.data }; items = items.concat(FT.list(r.data)); last = FT.meta(r.data)?.last_page || 1; page++; } while (page <= last && page <= maxPages); return { ok: true, items }; };
  FT.renderPager = function (root, meta, onGo) { if (!root) return; if (!meta || meta.last_page <= 1) { root.innerHTML = meta ? `<span class="info">${meta.total} data</span>` : ''; return; } const cur = meta.current_page, last = meta.last_page, pages = []; for (let p = Math.max(1, cur - 2); p <= Math.min(last, cur + 2); p++) pages.push(p); root.innerHTML = `<span class="info">Menampilkan ${meta.from ?? 0}-${meta.to ?? 0} dari ${meta.total} data</span><div class="pager"><button data-p="${cur - 1}" ${cur === 1 ? 'disabled' : ''} aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>${pages.map(p => `<button data-p="${p}" class="${p === cur ? 'active' : ''}">${p}</button>`).join('')}<button data-p="${cur + 1}" ${cur === last ? 'disabled' : ''} aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button></div>`; root.querySelectorAll('button[data-p]').forEach(b => b.addEventListener('click', () => onGo(Number(b.dataset.p)))); };
  w.FT = FT;
})(window);
