<aside class="sidebar" id="sidebar" aria-label="Navigasi utama">
    <a href="{{ route('dashboard') }}" class="side-brand">
        <span class="brand-mark"><i class="bi bi-buildings-fill"></i></span>
        <span>FasTrack<small>FACILITY CARE SYSTEM</small></span>
    </a>

    <div class="side-caption">WORKSPACE</div>
    <nav class="nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
        <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index', 'reports.show') ? 'active' : '' }}"><i class="bi bi-clipboard2-data-fill"></i> Semua Laporan</a>
        <a href="{{ route('reports.create') }}" class="{{ request()->routeIs('reports.create') ? 'active' : '' }}"><i class="bi bi-plus-circle-fill"></i> Buat Laporan</a>
    </nav>

    <div class="side-caption">MASTER DATA</div>
    <nav class="nav">
        <a href="{{ route('facilities.index') }}" class="{{ request()->routeIs('facilities.*') ? 'active' : '' }}"><i class="bi bi-building-fill"></i> Fasilitas Kampus</a>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"><i class="bi bi-tags-fill"></i> Kategori</a>
        <a href="{{ route('users.index') }}" class="admin-only hidden {{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Pengguna</a>
    </nav>

    <div class="side-bottom">
        <div class="side-caption" style="padding-top:0">AKUN</div>
        <nav class="nav">
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}"><i class="bi bi-person-circle"></i> Profil Saya</a>
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
