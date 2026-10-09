@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <div class="page-head">
        <div>
            <h1>Profil Saya</h1>
            <p>Informasi akun yang sedang digunakan.</p>
        </div>
    </div>

    <section class="panel profile-card">
        <div class="profile-cover"></div>
        <div class="profile-body">
            <div class="profile-id">
                <div class="avatar avatar-lg" data-user-initial>F</div>
                <div style="padding-bottom:6px">
                    <h2 data-user-name>Memuat...</h2>
                    <span class="badge no-dot role-mahasiswa" id="roleBadge" data-user-role>&nbsp;</span>
                </div>
            </div>

            <div class="form-grid">
                <div class="field"><label>Nama</label><input class="input" id="pName" disabled></div>
                <div class="field"><label>Email</label><input class="input" id="pEmail" disabled></div>
                <div class="field"><label>Role</label><input class="input" id="pRole" disabled></div>
                <div class="field"><label>Terdaftar sejak</label><input class="input" id="pSince" disabled></div>
            </div>

            <div class="form-actions" style="margin-top:12px">
                <button class="btn btn-danger" type="button" data-logout><i class="bi bi-box-arrow-right"></i> Keluar dari akun</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/profile.js') }}"></script>
@endpush
