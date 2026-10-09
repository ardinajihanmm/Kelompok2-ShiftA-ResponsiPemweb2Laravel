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