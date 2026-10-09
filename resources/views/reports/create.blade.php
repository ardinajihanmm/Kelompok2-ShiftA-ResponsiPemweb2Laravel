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
