@extends('layouts.dashboard')

@section('title', 'Laporan')

@section('content')
    <div class="page-head">
        <div>
            <h1 data-text-admin="Semua Laporan" data-text-mahasiswa="Laporan Saya">Laporan</h1>
            <p data-text-admin="Kelola dan tindak lanjuti laporan kerusakan fasilitas dari seluruh mahasiswa."
               data-text-mahasiswa="Pantau perkembangan laporan kerusakan fasilitas yang kamu buat.">Telusuri laporan kerusakan fasilitas kampus.</p>
        </div>
        <div class="head-actions">
            <a href="{{ route('reports.create') }}" class="btn btn-primary mahasiswa-only hidden"><i class="bi bi-plus-lg"></i> Buat laporan</a>
            <button type="button" class="btn btn-primary admin-only hidden" id="adminCreateReportBtn">
                <i class="bi bi-plus-lg"></i> Tambah laporan
            </button>
        </div>
    </div>

    <section class="panel">
        <div class="filters">
            <div class="input-icon"><i class="bi bi-search"></i><input class="input" id="search" placeholder="Cari judul atau deskripsi..." autocomplete="off"></div>
            <select class="select" id="statusFilter" aria-label="Filter status">
                <option value="">Semua status</option>
                <option value="menunggu">Menunggu</option>
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai</option>
                <option value="ditolak">Ditolak</option>
            </select>
            <select class="select" id="priorityFilter" aria-label="Filter prioritas">
                <option value="">Semua prioritas</option>
                <option value="low">Rendah</option>
                <option value="medium">Sedang</option>
                <option value="high">Tinggi</option>
            </select>
            <button class="btn btn-outline" id="resetBtn" type="button"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
        </div>

        <div id="reportTable"></div>
        <div class="pagination" id="pagination"></div>
    </section>

    <div id="adminReportModal" class="modal-overlay" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(15,23,42,.55);padding:20px;overflow:auto;align-items:center;justify-content:center">
        <section class="panel" style="width:min(680px,100%);margin:auto">
            <div class="panel-head" style="display:flex;align-items:center;justify-content:space-between;gap:12px">
                <div><h2 id="adminReportModalTitle">Tambah laporan</h2><p>Isi informasi laporan yang akan dicatat admin.</p></div>
                <button type="button" class="btn btn-outline btn-sm" id="adminReportCloseBtn" aria-label="Tutup">Tutup</button>
            </div>
            <div id="adminReportMsg"></div>
            <form id="adminReportForm">
                <input type="hidden" id="adminReportId">
                <div class="field" style="margin-bottom:14px">
                    <label for="adminReportFacility">Fasilitas</label>
                    <select class="select" id="adminReportFacility" required><option value="">Memuat fasilitas...</option></select>
                </div>
                <div class="field" style="margin-bottom:14px">
                    <label for="adminReportTitle">Judul laporan</label>
                    <input class="input" id="adminReportTitle" maxlength="255" required>
                </div>
                <div class="field" style="margin-bottom:14px">
                    <label for="adminReportDescription">Deskripsi</label>
                    <textarea class="textarea" id="adminReportDescription" required></textarea>
                </div>
                <div class="form-grid" style="margin-bottom:14px">
                    <div class="field">
                        <label for="adminReportStatus">Status</label>
                        <select class="select" id="adminReportStatus">
                            <option value="menunggu">Menunggu</option><option value="diproses">Diproses</option><option value="selesai">Selesai</option><option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="adminReportPriority">Prioritas</label>
                        <select class="select" id="adminReportPriority">
                            <option value="low">Rendah</option><option value="medium" selected>Sedang</option><option value="high">Tinggi</option>
                        </select>
                    </div>
                </div>
                <div class="field" style="margin-bottom:18px">
                    <label for="adminReportPhoto">Foto bukti (opsional)</label>
                    <input class="input" type="file" id="adminReportPhoto" accept="image/jpeg,image/png,image/webp">
                    <small class="field-hint">JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-outline" id="adminReportCancelBtn">Batal</button>
                    <button type="submit" class="btn btn-primary" id="adminReportSaveBtn">Simpan laporan</button>
                </div>
            </form>
        </section>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/pages/reports-common.js') }}"></script>
    <script src="{{ asset('js/pages/reports-index.js') . '?v=20261009crud1' }}"></script>
@endpush
