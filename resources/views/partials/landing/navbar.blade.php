<header class="nav-wrap">
    <div class="navbar">
        <a class="brand" href="#beranda">
            <span class="logo"><i class="bi bi-buildings-fill"></i></span>
            <span>FasTrack<small>FACILITY CARE SYSTEM</small></span>
        </a>

        <nav class="nav-links" id="navLinks" aria-label="Menu utama">
            <a href="#beranda" class="active">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#fitur">Fitur</a>
            <a href="#alur">Alur Pelaporan</a>
            <a href="#faq">Informasi</a>
        </nav>

        <div class="nav-actions">
            <a class="btn btn-outline btn-sm" href="{{ route('login') }}" data-guest>Masuk</a>
            <a class="btn btn-primary btn-sm" href="{{ route('register') }}" data-guest>Mulai Lapor <i class="bi bi-arrow-up-right"></i></a>
            <a class="btn btn-primary btn-sm hidden" href="{{ route('dashboard') }}" data-authed>Buka Dashboard <i class="bi bi-arrow-up-right"></i></a>
            <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu" aria-expanded="false"><i class="bi bi-list"></i></button>
        </div>
    </div>
</header>
