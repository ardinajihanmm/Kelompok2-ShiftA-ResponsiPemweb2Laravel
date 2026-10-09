FasTrack - File CRUD Laporan (hanya file yang berubah)

Cara memasang:
1. Backup file lama.
2. Ekstrak ZIP ini di folder project Laravel kamu dengan mempertahankan struktur folder.
3. Pastikan file ditempatkan sesuai path di dalam ZIP.
4. Jalankan: php artisan optimize:clear
5. Refresh /reports dengan Ctrl+F5.

File yang disertakan:
- public/js/pages/reports-index.js
- resources/views/reports/index.blade.php
- routes/api.php
- app/Http/Controllers/Api/ReportController.php

Fitur admin yang ditambahkan:
- Tambah laporan (fasilitas, judul, deskripsi, status, prioritas, foto opsional)
- Edit laporan (fasilitas, judul, deskripsi, status, prioritas; foto baru opsional)
- Hapus laporan (tetap ada)
- Baca daftar dan detail laporan (fitur yang sudah ada)

Catatan:
- Tidak ada migration database baru.
- Endpoint tambah admin baru: POST /api/reports/admin, dilindungi auth:sanctum dan role:admin.
- Alur mahasiswa untuk membuat laporan tidak diubah.
- Sebelum dipakai, uji di lokal. File ini dibuat dari ZIP project yang kamu kirim.
