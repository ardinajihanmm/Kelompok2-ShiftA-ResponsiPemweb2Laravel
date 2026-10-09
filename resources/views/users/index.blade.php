@extends('layouts.dashboard')

@section('title', 'Pengguna')
@section('admin', '1')

@section('content')
    <div class="page-head">
        <div>
            <h1>Pengguna</h1>
            <p>Daftar pengguna yang terdaftar di FasTrack. Halaman ini hanya tersedia untuk admin.</p>
        </div>
    </div>

    <section class="panel">
        <div class="toolbar">
            <div class="input-icon"><i class="bi bi-search"></i><input class="input" id="userSearch" placeholder="Cari nama atau email..." autocomplete="off"></div>
            <span class="muted" id="userCount" style="font-size:12.5px"></span>
        </div>
        <div id="userTable"></div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/users.js') }}"></script>
@endpush
