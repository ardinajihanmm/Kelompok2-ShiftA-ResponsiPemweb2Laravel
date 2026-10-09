<<<<<<< HEAD
@extends('layouts.dashboard')

@section('title', 'Buat Laporan')

@section('content')
    <a href="{{ route('reports.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali ke daftar laporan</a>
    <div class="page-head">
        <div>
            <h1>Buat Laporan Baru</h1>
            <p>Jelaskan kendala fasilitas agar bisa ditindaklanjuti dengan tepat.</p>
        </div>
    </div>

    <div class="panel form-panel">
        <div class="alert alert-info"><i class="bi bi-info-circle-fill"></i><span>Isi detail kerusakan dan unggah foto sebagai bukti. Prioritas akan ditentukan oleh admin setelah laporan ditinjau. Status awal laporan adalah <b>Menunggu</b>.</span></div>
        <div id="reportMsg"></div>

        <form id="reportForm" novalidate>
            <div class="form-grid">
                <div class="field span-2">
                    <label for="facility_id">Fasilitas kampus <span class="req">*</span></label>
                    <select class="select" id="facility_id" required><option value="">Memuat fasilitas...</option></select>
                </div>

                <div class="field span-2">
                    <label for="title">Judul laporan <span class="req">*</span></label>
                    <input class="input" id="title" maxlength="255" placeholder="Contoh: AC ruang kelas tidak menyala" required>
                </div>

                <div class="field span-2">
                    <label for="description">Deskripsi masalah <span class="req">*</span></label>
                    <textarea class="textarea" id="description" placeholder="Jelaskan kondisi, lokasi spesifik, dan dampak masalah..." required></textarea>
                </div>

                <div class="field span-2">
                    <label for="photo">Foto bukti kerusakan <span class="req">*</span></label>
                    <input class="input" type="file" id="photo" accept="image/jpeg,image/png,image/webp" required>
                    <small class="field-hint">Format JPG, PNG, atau WEBP. Maksimal 2 MB. Foto membantu admin memeriksa kondisi fasilitas.</small>
                    <div id="photoPreviewWrap" style="display:none;margin-top:12px">
                        <img id="photoPreview" alt="Pratinjau foto bukti" style="max-width:260px;max-height:190px;object-fit:contain;border-radius:12px;border:1px solid #dbe3ef">
                    </div>
                </div>

                <div class="field span-2">
                    <label for="reporterDisplay">Pelapor</label>
                    <input class="input" id="reporterDisplay" disabled>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('reports.index') }}" class="btn btn-outline">Batal</a>
                <button class="btn btn-primary" id="submitBtn" type="submit">Kirim laporan <i class="bi bi-send"></i></button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/report-create.js') }}"></script>
@endpush
=======
@extends('layouts.app')

@section('title', 'Buat Laporan - LaporKita')

@section('content')

    <div class="page-container">

        <div class="page-header">
            <div>
                <h1>Buat Laporan</h1>
                <p>Laporkan fasilitas kampus yang mengalami masalah.</p>
            </div>

            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

        <div class="card">

            <div id="error-message" class="alert alert-error" style="display:none;">
            </div>

            <div id="success-message" class="alert" style="display:none;">
            </div>

            <form id="report-form">

                <div class="form-group">
                    <label for="facility_id">Fasilitas</label>

                    <select id="facility_id" name="facility_id" class="form-control" required>
                        <option value="">Pilih fasilitas</option>
                        <option value="1">Ruang 204</option>
                        <option value="2">Toilet Gedung B</option>
                        <option value="3">Ruang 301</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="location">Lokasi</label>

                    <input type="text" id="location" name="location" class="form-control"
                        placeholder="Contoh: Gedung Fakultas A, Lantai 2" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Masalah</label>

                    <textarea id="description" name="description" class="form-control" rows="6"
                        placeholder="Jelaskan kerusakan atau masalah fasilitas..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="photo">Foto (opsional)</label>

                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*">

                    <small style="color:#6b7280;">
                        Upload foto fasilitas jika diperlukan.
                    </small>
                </div>

                <div style="display:flex; gap:12px; margin-top:20px;">

                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" id="submit-button" class="btn btn-primary">
                        Kirim Laporan
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.getElementById('report-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            /*
             * Untuk sementara kita belum mengirim data ke API.
             * Endpoint laporan perlu disesuaikan dengan controller
             * laporan yang dibuat oleh anggota backend.
             */

            successMessage.textContent =
                'Form laporan sudah siap. Tinggal disambungkan ke API laporan.';

            successMessage.style.display = 'block';
        });
    </script>

@endsection
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
