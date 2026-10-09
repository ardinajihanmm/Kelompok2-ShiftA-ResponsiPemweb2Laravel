(function () {
  'use strict';

  const { $ } = FT;
  const photoInput = $('#photo');

  async function init() {
    $('#reporterDisplay').value = FT.user?.name || '';

    const sel = $('#facility_id');
    const r = await FT.fetchAll('/facilities?per_page=100');

    if (!r.ok) {
      sel.innerHTML = '<option value="">Gagal memuat fasilitas</option>';
      FT.alert('#reportMsg', FT.errorText(r.data, 'Gagal memuat daftar fasilitas.'));
      return;
    }

    sel.innerHTML = '<option value="">Pilih fasilitas...</option>' +
      r.items.map(f => `<option value="${FT.esc(f.id)}">${FT.esc(f.name)} - ${FT.esc(f.location)}</option>`).join('');

    // Jika halaman dibuka dari detail fasilitas: /reports/create?facility=ID
    const pre = new URLSearchParams(location.search).get('facility');
    if (pre) sel.value = pre;
  }

  photoInput.addEventListener('change', () => {
    const file = photoInput.files?.[0];
    const wrap = $('#photoPreviewWrap');

    if (!file) {
      wrap.style.display = 'none';
      return;
    }

    const allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowed.includes(file.type) || file.size > 2 * 1024 * 1024) {
      photoInput.value = '';
      wrap.style.display = 'none';
      FT.alert('#reportMsg', 'Foto harus JPG, PNG, atau WEBP dan ukurannya maksimal 2 MB.');
      return;
    }

    const preview = $('#photoPreview');
    if (preview.dataset.objectUrl) URL.revokeObjectURL(preview.dataset.objectUrl);
    const objectUrl = URL.createObjectURL(file);
    preview.src = objectUrl;
    preview.dataset.objectUrl = objectUrl;
    wrap.style.display = 'block';
    FT.alert('#reportMsg', '');
  });

  $('#reportForm').addEventListener('submit', async e => {
    e.preventDefault();

    const btn = $('#submitBtn');
    const facilityId = $('#facility_id').value;
    const title = $('#title').value.trim();
    const description = $('#description').value.trim();
    const photo = photoInput.files?.[0];

    if (!facilityId || !title || !description || !photo) {
      FT.alert('#reportMsg', 'Fasilitas, judul, deskripsi, dan foto bukti wajib diisi.');
      return;
    }

    const allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowed.includes(photo.type) || photo.size > 2 * 1024 * 1024) {
      FT.alert('#reportMsg', 'Foto harus JPG, PNG, atau WEBP dan ukurannya maksimal 2 MB.');
      return;
    }

    const body = new FormData();
    body.append('facility_id', facilityId);
    body.append('title', title);
    body.append('description', description);
    body.append('photo', photo);

    FT.alert('#reportMsg', '');
    FT.loading(btn, true);

    try {
      const r = await FT.api('/reports', {
        method: 'POST',
        body,
        headers: { Accept: 'application/json' }
      });

      if (!r.ok) {
        FT.alert('#reportMsg', FT.errorText(r.data, 'Laporan gagal dibuat.'));
        FT.loading(btn, false);
        return;
      }

      FT.toast('Laporan berhasil dikirim. Status awal: Menunggu.');
      const id = r.data?.data?.id;
      setTimeout(() => {
        location.href = id ? '/reports/' + id : '/reports';
      }, 500);
    } catch (error) {
      FT.alert('#reportMsg', 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.');
      FT.loading(btn, false);
    }
  });

  FT.ready.then(init);
})();
