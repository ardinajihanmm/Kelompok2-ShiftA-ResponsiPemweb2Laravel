# FasTrack — Sistem Pelaporan dan Monitoring Kerusakan Fasilitas Kampus

FasTrack adalah aplikasi web untuk membantu mahasiswa melaporkan kerusakan fasilitas kampus dan membantu admin memantau serta memperbarui status tindak lanjut laporan.

## Permasalahan
Pelaporan kerusakan fasilitas kampus sering tersebar dan sulit dipantau status penyelesaiannya. FasTrack menyediakan alur terpusat: mahasiswa membuat laporan → sistem menyimpan laporan → admin memproses laporan → status diperbarui hingga selesai.

## Fitur
- Register, login, logout menggunakan Laravel Sanctum Bearer Token
- Role `mahasiswa` dan `admin`
- CRUD User (admin)
- CRUD Category
- CRUD Facility
- CRUD Report dengan status dan prioritas
- Komentar/tanggapan pada laporan
- Search dan filter laporan
- Pagination API
- Form Request validation
- API Resource
- Dashboard frontend responsif
- Alur bisnis monitoring status laporan

## Teknologi
- Laravel 13
- PHP
- MySQL/MariaDB
- Eloquent ORM
- Laravel Sanctum
- Blade + HTML/CSS/JavaScript
- Git/GitHub
- Postman

## Relasi Data
- User 1:N Report
- User 1:N Comment
- Category 1:N Facility
- Facility 1:N Report
- Report 1:N Comment

## Alur Bisnis
1. Mahasiswa login.
2. Mahasiswa memilih fasilitas dan membuat laporan kerusakan.
3. Sistem menyimpan laporan dengan status `menunggu`.
4. Admin melihat laporan dan mengubah status menjadi `diproses`, `selesai`, atau `ditolak`.
5. Status akhir dapat dipantau oleh pengguna.

## API Documentation

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| POST | `/api/auth/register` | Registrasi | No |
| POST | `/api/auth/login` | Login dan mendapatkan token | No |
| POST | `/api/auth/logout` | Logout token aktif | Yes |
| GET | `/api/auth/me` | Data pengguna aktif | Yes |
| GET | `/api/users` | Daftar user | Admin |
| POST | `/api/users` | Tambah user | Admin |
| GET | `/api/users/{id}` | Detail user | Admin |
| PUT/PATCH | `/api/users/{id}` | Update user | Admin |
| DELETE | `/api/users/{id}` | Hapus user | Admin |
| GET | `/api/categories` | Daftar kategori | Yes |
| POST | `/api/categories` | Tambah kategori | Yes |
| GET | `/api/categories/{id}` | Detail kategori | Yes |
| PUT/PATCH | `/api/categories/{id}` | Update kategori | Yes |
| DELETE | `/api/categories/{id}` | Hapus kategori | Yes |
| GET | `/api/facilities` | Daftar fasilitas | Yes |
| POST | `/api/facilities` | Tambah fasilitas | Yes |
| GET | `/api/facilities/{id}` | Detail fasilitas | Yes |
| PUT/PATCH | `/api/facilities/{id}` | Update fasilitas | Yes |
| DELETE | `/api/facilities/{id}` | Hapus fasilitas | Yes |
| GET | `/api/reports` | Daftar laporan + search/filter + pagination | Yes |
| POST | `/api/reports` | Buat laporan | Yes |
| GET | `/api/reports/{id}` | Detail laporan | Yes |
| PUT/PATCH | `/api/reports/{id}` | Update laporan/status | Yes |
| DELETE | `/api/reports/{id}` | Hapus laporan | Yes |
| GET | `/api/reports/{id}/comments` | Daftar tanggapan | Yes |
| POST | `/api/reports/{id}/comments` | Tambah tanggapan | Yes |
| PUT/PATCH | `/api/comments/{id}` | Update tanggapan | Yes |
| DELETE | `/api/comments/{id}` | Hapus tanggapan | Yes |

## Cara Menjalankan
```bash
git clone <URL_REPOSITORY>
cd Kelompok2-ShiftA-ResponsiPemweb2Laravel
composer install
copy .env.example .env
php artisan key:generate
```

Atur database di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fastrack
DB_USERNAME=root
DB_PASSWORD=
```

Lalu:
```bash
php artisan migrate:fresh --seed
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Akun Pengujian
**Admin**
- Email: `admin@fastrack.test`
- Password: `password123`

**Mahasiswa**
- Email: `mahasiswa@fastrack.test`
- Password: `password123`

## Deployment
Isi link aplikasi live di bagian ini setelah deployment:
`[LINK DEPLOYMENT]`

## Video Dokumentasi Individu
Isi link video masing-masing anggota:
- Anggota 1 — Authentication & Authorization: `[LINK VIDEO]`
- Anggota 2 — Report API: `[LINK VIDEO]`
- Anggota 3 — Category & Facility API: `[LINK VIDEO]`
- Anggota 4 — Comment API & Frontend: `[LINK VIDEO]`

## Catatan
Untuk endpoint yang membutuhkan autentikasi, gunakan header:
`Authorization: Bearer <TOKEN>`
