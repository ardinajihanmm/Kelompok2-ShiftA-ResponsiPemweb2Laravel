@extends('layouts.dashboard')

@section('title', 'Semua Laporan')

@section('content')
    <div class="page-head">
        <div>
            <h1>Semua Laporan</h1>
            <p>Kelola dan telusuri laporan kerusakan fasilitas kampus.</p>
        </div>
        <div class="head-actions">
            <a href="{{ route('reports.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat laporan</a>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/reports-common.js') }}"></script>
    <script src="{{ asset('js/pages/reports-index.js') }}"></script>
@endpush
