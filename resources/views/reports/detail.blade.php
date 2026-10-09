@extends('layouts.dashboard')

@section('title', 'Detail Laporan')

@section('content')
    <a href="{{ route('reports.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali ke daftar laporan</a>

    <div id="detailRoot" data-report-id="{{ $id }}">
        <div class="panel"><div class="skeleton" style="height:28px;width:60%;margin-bottom:16px"></div><div class="skeleton" style="height:90px"></div></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/report-detail.js') }}"></script>
@endpush
