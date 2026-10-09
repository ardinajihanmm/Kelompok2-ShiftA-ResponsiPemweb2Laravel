@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="page-head">
        <div>
            <h1>Halo, <span data-user-first>Pengguna</span></h1>
            <p>Ringkasan laporan dan aktivitas fasilitas kampus hari ini.</p>
        </div>
        <div class="head-actions">
            <a href="{{ route('reports.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat laporan</a>
        </div>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-ico"><i class="bi bi-clipboard2-data-fill"></i></div>
            <div class="stat-num" id="statTotal">0</div>
            <div class="stat-label">Total laporan</div>
            <div class="stat-foot">Semua laporan tercatat</div>
        </div>
        <div class="stat amber">
            <div class="stat-ico"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-num" id="statMenunggu">0</div>
            <div class="stat-label">Menunggu</div>
            <div class="stat-foot">Perlu ditinjau admin</div>
        </div>
        <div class="stat blue">
            <div class="stat-ico"><i class="bi bi-arrow-repeat"></i></div>
            <div class="stat-num" id="statDiproses">0</div>
            <div class="stat-label">Diproses</div>
            <div class="stat-foot">Dalam tindak lanjut</div>
        </div>
        <div class="stat green">
            <div class="stat-ico"><i class="bi bi-check2-circle"></i></div>
            <div class="stat-num" id="statSelesai">0</div>
            <div class="stat-label">Selesai</div>
            <div class="stat-foot">Sudah ditangani</div>
        </div>
    </div>

    <div class="dash-grid">
        <section class="panel">
            <div class="panel-head">
                <div><h2>Laporan terbaru</h2><p>Pantau laporan fasilitas yang baru masuk.</p></div>
                <a href="{{ route('reports.index') }}" class="link-btn">Lihat semua <i class="bi bi-arrow-right"></i></a>
            </div>
            <div id="recentReports"></div>
        </section>

        <div class="stack">
            <section class="panel">
                <div class="panel-head"><div><h2>Distribusi status</h2><p>Perbandingan status seluruh laporan.</p></div></div>
                <div class="dist-bar" id="distBar"></div>
                <div class="dist-legend" id="distLegend"></div>
            </section>

            <section class="panel">
                <div class="panel-head"><div><h2>Akses cepat</h2><p>Langsung ke aktivitas utama.</p></div></div>
                <div class="quick-list">
                    <a class="quick" href="{{ route('reports.create') }}"><span class="q-ico"><i class="bi bi-plus-lg"></i></span><span><strong>Buat laporan baru</strong><small>Laporkan kerusakan fasilitas</small></span><i class="bi bi-chevron-right"></i></a>
                    <a class="quick" href="{{ route('reports.index') }}"><span class="q-ico"><i class="bi bi-search"></i></span><span><strong>Monitoring laporan</strong><small>Cari dan filter perkembangan</small></span><i class="bi bi-chevron-right"></i></a>
                    <a class="quick" href="{{ route('facilities.index') }}"><span class="q-ico"><i class="bi bi-building"></i></span><span><strong>Direktori fasilitas</strong><small>Lihat lokasi fasilitas kampus</small></span><i class="bi bi-chevron-right"></i></a>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/reports-common.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
@endpush
