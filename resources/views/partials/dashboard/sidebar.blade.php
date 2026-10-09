<aside class="sidebar" id="sidebar" aria-label="Navigasi utama">
    <a href="{{ route('dashboard') }}" class="side-brand">
        <span class="brand-mark"><i class="bi bi-buildings-fill"></i></span>
        <span>FasTrack<small>FACILITY CARE SYSTEM</small></span>
    </a>

    <div class="side-caption">WORKSPACE</div>
    <nav class="nav">
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="/reports" onclick="window.location.assign('/reports'); return false;"
           class="{{ request()->is('reports') || request()->is('reports/*') ? 'active' : '' }}">
            <i class="bi bi-clipboard2-data-fill"></i>
            <span data-text-admin="Semua Laporan" data-text-mahasiswa="Laporan Saya">Laporan</span>
        </a>
        <a href="/reports/create" class="mahasiswa-only hidden {{ request()->is('reports/create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle-fill"></i> Buat Laporan
        </a>
    </nav>

    <div class="side-caption">MASTER DATA</div>
    <nav class="nav">
        <a href="/facilities" class="{{ request()->is('facilities') || request()->is('facilities/*') ? 'active' : '' }}">
            <i class="bi bi-building-fill"></i> Fasilitas Kampus
        </a>
        <a href="/categories" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> Kategori
        </a>
        <a href="/users" onclick="window.location.assign('/users'); return false;"
           class="admin-only hidden {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Pengguna
        </a>
    </nav>

    <div class="side-bottom">
        <div class="side-caption" style="padding-top:0">AKUN</div>
        <nav class="nav">
            <a href="/profile" class="{{ request()->is('profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profil Saya
            </a>
        </nav>
        <div class="side-user" style="margin-top:12px">
            <div class="avatar" data-user-initial>F</div>
            <div>
                <strong data-user-name>Memuat...</strong>
                <small data-user-role>&nbsp;</small>
            </div>
        </div>
        <button class="nav-logout" type="button" data-logout><i class="bi bi-box-arrow-right"></i> Keluar</button>
    </div>
</aside>
