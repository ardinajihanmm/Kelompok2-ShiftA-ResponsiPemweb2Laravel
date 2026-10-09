# FasTrack — Facility Care System

> Sistem pelaporan dan pemantauan kerusakan fasilitas kampus.

FasTrack adalah aplikasi web untuk membantu mahasiswa melaporkan kerusakan fasilitas kampus dan membantu admin memantau serta menindaklanjuti laporan secara terstruktur.

---

## Informasi Kelompok

- **Nomor Kelompok:** Kelompok 2
- **Shift Praktikum:** Shift A
- **Repository:** [Kelompok2-ShiftA-ResponsiPemweb2Laravel](https://github.com/ardinajihanmm/Kelompok2-ShiftA-ResponsiPemweb2Laravel)

## Anggota Kelompok

| No. | Nama Lengkap | NIM | Shift Awal | Shift Akhir | Jobdesk / Kontribusi | Link Video Penjelasan |
|---:|---|---|---|---|---|---|
| 1 | Ardina Jihan Mariska | H1H024018| Shift B | Shift A | CRUD Pengguna, Mengelola role admin dan mahasiswa sesuai implementasi. Integrasi tampilan autentikasi dengan backend Laravel. Halaman awal website. Halaman login dan register. Autentikasi dan hak akses. Proses login, register, dan logout. Integrasi autentikasi API dan Sanctum Pembatasan akses halaman berdasarkan role.| [YouTube/Drive](https://youtu.be/ecjdt3Msosg) |
| 2 | Mohammad Zulfan Ramadhan | H1H024008 | Shift A | Shift A | CRUD fitur reports/laporan | [YouTube/Drive](https://youtu.be/J0qRNB-0mbg) |
| 3 | [Nama Lengkap] | [NIM] | [Shift Awal] | [Shift Akhir] | [Jobdesk / kontribusi] | [YouTube/Drive](https://...) |
| 4 | [Nama Lengkap] | [NIM] | [Shift Awal] | [Shift Akhir] | [Jobdesk / kontribusi] | [YouTube/Drive](https://...) |

---

## Deskripsi Aplikasi

FasTrack menyediakan sistem pelaporan fasilitas kampus yang menghubungkan pelapor dengan admin pengelola fasilitas. Mahasiswa dapat membuat laporan dengan memilih fasilitas, mengisi judul dan deskripsi masalah, serta melampirkan foto bukti. Admin dapat memantau laporan dan mengelola data pendukung aplikasi.

Setiap laporan memiliki status awal **Menunggu**, sedangkan prioritas ditentukan oleh admin setelah laporan ditinjau.

### Target Pengguna

- **Mahasiswa / pengguna:** membuat laporan dan melihat laporan sesuai hak akses.
- **Admin:** mengelola laporan serta data pendukung seperti fasilitas, kategori, dan pengguna.

## Teknologi yang Digunakan

- **Backend:** Laravel 13 / PHP
- **Frontend:** Blade, CSS, JavaScript
- **API dan autentikasi:** Laravel Sanctum
- **Database:** MySQL
- **Lingkungan pengembangan lokal:** Laragon
- **Version control:** Git dan GitHub

> Sesuaikan versi PHP, database, dan package dengan konfigurasi aktual project.

## Fitur Utama

### 1. Autentikasi dan Otorisasi
- Registrasi dan login pengguna.
- Endpoint autentikasi berbasis API.
- Proteksi endpoint menggunakan `auth:sanctum`.
- Pembatasan fitur admin menggunakan middleware `role:admin`.

### 2. Pelaporan Fasilitas
- Membuat laporan dengan memilih fasilitas.
- Mengisi judul dan deskripsi kerusakan.
- Mengunggah foto bukti kerusakan.
- Status awal laporan adalah `menunggu`.
- Prioritas ditetapkan admin setelah peninjauan.

### 3. Pengelolaan Laporan
- Melihat daftar dan detail laporan.
- Mencari laporan berdasarkan kata kunci.
- Memfilter laporan berdasarkan status dan prioritas.
- Memperbarui atau menghapus laporan sesuai otorisasi.

### 4. Master Data
- Pengelolaan fasilitas kampus.
- Pengelolaan kategori laporan.
- Pengelolaan data pengguna oleh admin.

### 5. Komentar Laporan
- Melihat dan menambahkan komentar pada laporan.
- Memperbarui atau menghapus komentar sesuai aturan akses aplikasi.

## Gambaran Skema Data

Entitas utama aplikasi:

- `users`: data akun dan peran pengguna.
- `facilities`: data fasilitas kampus.
- `categories`: kategori laporan.
- `reports`: data laporan, pelapor, fasilitas, status, prioritas, dan foto.
- `comments`: komentar yang terkait dengan laporan.

Relasi dan nama kolom mengikuti migration serta model yang tersedia di repository.

## Persyaratan

Pastikan perangkat telah memiliki:
- PHP dan ekstensi yang dibutuhkan Laravel.
- Composer.
- Node.js dan npm.
- MySQL atau database yang dikonfigurasi pada project.
- Git.
- Laragon (opsional untuk Windows).

## Panduan Instalasi Lokal

### 1. Clone repository

```bash
git clone https://github.com/ardinajihanmm/Kelompok2-ShiftA-ResponsiPemweb2Laravel.git
cd Kelompok2-ShiftA-ResponsiPemweb2Laravel
```

### 2. Install dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi environment

Salin `.env.example` menjadi `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 4. Atur database

Buat database lokal, lalu sesuaikan konfigurasi di file `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database dan kredensial dengan konfigurasi MySQL lokal.

### 5. Jalankan migration dan seeder

```bash
php artisan migrate --seed
```

Jika database sudah berisi data penting, buat backup terlebih dahulu. Hindari `php artisan migrate:fresh` karena perintah tersebut menghapus tabel beserta datanya.

### 6. Siapkan penyimpanan foto

```bash
php artisan storage:link
```

### 7. Jalankan aplikasi

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua, jika aset frontend menggunakan Vite:

```bash
npm run dev
```

Buka alamat lokal yang ditampilkan oleh `php artisan serve`, biasanya `http://127.0.0.1:8000`.

## Endpoint API Utama

Tabel berikut adalah gambaran endpoint yang digunakan. Periksa `php artisan route:list` untuk memastikan metode, middleware, dan endpoint aktual.

| Modul | Endpoint | Keterangan |
|---|---|---|
| Registrasi | `POST /api/auth/register` | Membuat akun |
| Login | `POST /api/auth/login` | Login pengguna |
| Logout | `POST /api/auth/logout` | Logout dengan autentikasi |
| Profil pengguna aktif | `GET /api/auth/me` | Mengambil data pengguna aktif |
| Laporan | `/api/reports` | Operasi laporan melalui API resource |
| Fasilitas | `/api/facilities` | Membaca data fasilitas |
| Kategori | `/api/categories` | Membaca data kategori |
| Komentar | `/api/reports/{report}/comments` | Membaca atau menambahkan komentar |
| Pengguna | `/api/users` | Pengelolaan pengguna oleh admin |

Endpoint yang memerlukan autentikasi harus dipanggil dengan token yang sesuai. Operasi admin juga memerlukan peran admin.

## Pengembangan dan Troubleshooting

- Periksa daftar route dengan `php artisan route:list`.
- Bersihkan cache aplikasi dengan `php artisan optimize:clear`.
- Bersihkan cache Blade dengan `php artisan view:clear`.
- Jika foto tidak tampil, pastikan upload berhasil, file tersimpan di disk `public`, dan `php artisan storage:link` sudah dijalankan.
- Jangan commit file `.env` atau kredensial database ke repository.
- Sebelum menggabungkan perubahan tim, periksa konflik Git dan pastikan penanda `<<<<<<<`, `=======`, atau `>>>>>>>` tidak tertinggal di file aplikasi.

