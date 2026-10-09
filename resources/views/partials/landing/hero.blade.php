<section class="hero" id="beranda">
    <div class="wrap hero-grid">
        <div class="hero-copy reveal">
            <span class="eyebrow"><i class="bi bi-building-check"></i> LAYANAN LAPORAN FASILITAS KAMPUS</span>
            <h1>Ada fasilitas kampus yang perlu <span>diperbaiki?</span></h1>
            <p class="lead">Lampu kelas mati, kursi rusak, atau keran bocor? Sampaikan laporan lewat FasTrack dan cek perkembangannya di satu tempat.</p>

            <div class="hero-btns">
                <a class="btn btn-primary btn-lg" href="{{ route('reports.create') }}"><i class="bi bi-megaphone-fill"></i> Buat Laporan</a>
                <a class="btn btn-outline btn-lg" href="#alur"><i class="bi bi-arrow-down-circle"></i> Cara Melapor</a>
            </div>

            <div class="trust">
                <div class="avatars"><span><i class="bi bi-person-fill"></i></span><span><i class="bi bi-tools"></i></span><span><i class="bi bi-check-lg"></i></span></div>
                <div><strong>Laporannya tercatat, statusnya bisa dicek.</strong><br>Mulai dari laporan masuk sampai selesai.</div>
            </div>
        </div>

        <div class="hero-photo-wrap reveal d2" aria-label="Area kampus dengan gedung dan fasilitas umum">
            <img class="hero-photo" src="{{ asset('images/kampus-fastrack.png') }}" alt="Area kampus dengan gedung, jalur pejalan kaki, bangku, dan taman">
            <div class="photo-caption"><span class="photo-caption-icon"><i class="bi bi-geo-alt-fill"></i></span><div><strong>Fasilitas kampus, urusan bersama</strong><small>Bantu sampaikan hal yang perlu diperbaiki.</small></div></div>
            <span class="photo-tag"><i class="bi bi-clipboard-check"></i> Laporkan dengan mudah</span>
        </div>
    </div>
</section>
