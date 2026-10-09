@extends('layouts.dashboard')

@section('title', 'Pengguna')
@section('roles', 'admin')

@section('content')
    <div class="page-head">
        <div>
            <h1>Pengguna</h1>
            <p>Kelola akun, email, dan hak akses pengguna FasTrack.</p>
        </div>
        <div class="head-actions"><button class="btn btn-primary" id="addUserBtn" type="button"><i class="bi bi-plus-lg"></i> Tambah pengguna</button></div>
    </div>

    <section class="panel form-panel hidden" id="userFormWrap" style="max-width:760px;margin-bottom:20px">
        <div class="panel-head"><h2 id="userFormTitle">Tambah pengguna</h2></div>
        <div id="userFormMsg"></div>
        <form id="userForm" novalidate>
            <div class="form-grid">
                <div class="field"><label for="uName">Nama lengkap *</label><input class="input" id="uName" required maxlength="255"></div>
                <div class="field"><label for="uEmail">Email *</label><input class="input" id="uEmail" type="email" required></div>
                <div class="field"><label for="uRole">Role *</label><select class="select" id="uRole" required><option value="mahasiswa">Mahasiswa</option><option value="admin">Admin</option></select></div>
                <div class="field"><label for="uPassword">Password <span id="uPasswordRequired">*</span></label><input class="input" id="uPassword" type="password" minlength="8" autocomplete="new-password"><small class="field-hint" id="uPasswordHint">Minimal 8 karakter.</small></div>
                <div class="field"><label for="uPasswordConfirmation">Konfirmasi password <span id="uConfirmRequired">*</span></label><input class="input" id="uPasswordConfirmation" type="password" minlength="8" autocomplete="new-password"></div>
            </div>
            <div class="form-actions"><button class="btn btn-outline" id="cancelUserBtn" type="button">Batal</button><button class="btn btn-primary" id="saveUserBtn" type="submit">Simpan pengguna</button></div>
        </form>
    </section>
    <section class="panel">
        <div class="toolbar">
            <div class="input-icon"><i class="bi bi-search"></i><input class="input" id="userSearch" placeholder="Cari nama atau email..." autocomplete="off"></div>
            <span class="muted" id="userCount" style="font-size:12.5px"></span>
        </div>
        <div id="userTable"></div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/users.js') . '?v=20261009b' }}"></script>
@endpush
