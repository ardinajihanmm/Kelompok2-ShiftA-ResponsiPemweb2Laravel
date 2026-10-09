<section class="bg-soft" id="fitur">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="kicker">Fitur Utama</span>
            <h2>Semua kebutuhan pelaporan dalam satu tempat.</h2>
            <p>Dirancang agar proses melaporkan kerusakan dan mengelola tindak lanjut mudah dipahami oleh setiap pengguna.</p>
        </div>

        <div class="grid-3">
            @php
                $features = [
                    ['pencil-square', 'Buat Laporan', 'Isi judul, pilih fasilitas, tulis deskripsi, dan tentukan prioritas masalah.'],
                    ['search', 'Pencarian & Filter', 'Temukan laporan menggunakan kata kunci, status, atau tingkat prioritas.'],
                    ['arrow-repeat', 'Monitoring Status', 'Lihat perkembangan laporan dari tahap menunggu sampai selesai.'],
                    ['building-gear', 'Data Fasilitas', 'Gunakan daftar fasilitas dan kategori untuk membuat laporan lebih akurat.'],
                    ['person-lock', 'Akses Berdasarkan Peran', 'Mahasiswa membuat dan memantau laporan, sedangkan admin mengelola tindak lanjut.'],
                    ['chat-left-dots', 'Tanggapan pada Laporan', 'Diskusikan perkembangan penanganan langsung di halaman detail laporan.'],
                ];
            @endphp
            @foreach ($features as $i => $f)
                <article class="card reveal d{{ $i % 3 }}">
                    <div class="card-ico"><i class="bi bi-{{ $f[0] }}"></i></div>
                    <h3>{{ $f[1] }}</h3>
                    <p>{{ $f[2] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
