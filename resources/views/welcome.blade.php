<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LaporKita - Fasilitas Kampus</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        /* NAVBAR */
        .navbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }

        .logo span {
            color: #111827;
        }

        .nav-menu {
            display: flex;
            gap: 28px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #4b5563;
            font-size: 14px;
        }

        .nav-menu a:hover {
            color: #2563eb;
        }

        .btn-login {
            background: #2563eb;
            color: white !important;
            padding: 10px 18px;
            border-radius: 8px;
        }

        /* HERO */
        .hero {
            min-height: 500px;
            padding: 80px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
            background: linear-gradient(135deg, #eff6ff, #ffffff);
        }

        .hero-text {
            max-width: 600px;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #2563eb;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.15;
            margin-bottom: 20px;
            color: #111827;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero p {
            color: #6b7280;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-primary {
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-secondary {
            text-decoration: none;
            background: white;
            color: #2563eb;
            border: 1px solid #2563eb;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: bold;
        }

        /* HERO CARD */
        .hero-card {
            width: 370px;
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        .hero-card h3 {
            margin-bottom: 20px;
        }

        .report-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .report-icon {
            width: 45px;
            height: 45px;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            font-size: 20px;
        }

        .report-info {
            flex: 1;
        }

        .report-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .report-info small {
            color: #9ca3af;
        }

        .status {
            font-size: 11px;
            padding: 5px 8px;
            border-radius: 10px;
            background: #fef3c7;
            color: #92400e;
        }

        /* FEATURES */
        .features {
            padding: 70px 7%;
            text-align: center;
        }

        .features h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .features > p {
            color: #6b7280;
            margin-bottom: 40px;
        }

        .feature-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            text-align: left;
            border: 1px solid #e5e7eb;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 14px;
        }

        /* FOOTER */
        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 25px;
            margin-top: 30px;
        }

        footer p {
            color: #9ca3af;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 800px) {
            .hero {
                flex-direction: column;
                padding: 50px 7%;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-card {
                width: 100%;
            }

            .feature-container {
                grid-template-columns: 1fr;
            }

            .nav-menu a:not(.btn-login) {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            Lapor<span>Kita</span>
        </div>
        <div class="nav-menu">
             <a href="{{ route('home') }}">Beranda</a>
             <a href="#fitur">Fitur</a>
             <a href="#tentang">Tentang</a>
             <a href="{{ route('login') }}" class="btn-login">Masuk</a>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero">

        <div class="hero-text">

            <div class="badge">
                🏫 Sistem Pelaporan Fasilitas Kampus
            </div>

            <h1>
                Laporkan Fasilitas,
                <span>Wujudkan Kampus Lebih Baik.</span>
            </h1>

            <p>
                LaporKita membantu mahasiswa dan civitas kampus
                melaporkan fasilitas yang rusak atau membutuhkan
                perbaikan dengan mudah dan cepat.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('reports.create') }}" class="btn-primary">
                    + Buat Laporan
                </a>

                <a href="#fitur" class="btn-secondary">
                    Lihat Fitur
                </a>
            </div>

        </div>


        <!-- CONTOH LAPORAN -->
        <div class="hero-card">

            <h3>📋 Laporan Terbaru</h3>

            <div class="report-item">

                <div class="report-icon">
                    💡
                </div>

                <div class="report-info">
                    <strong>Lampu Ruang 204</strong>
                    <small>Gedung Fakultas A</small>
                </div>

                <span class="status">
                    Diproses
                </span>

            </div>


            <div class="report-item">

                <div class="report-icon">
                    🚰
                </div>

                <div class="report-info">
                    <strong>Kran Air Rusak</strong>
                    <small>Toilet Gedung B</small>
                </div>

                <span class="status">
                    Menunggu
                </span>

            </div>


            <div class="report-item">

                <div class="report-icon">
                    🪑
                </div>

                <div class="report-info">
                    <strong>Kursi Rusak</strong>
                    <small>Ruang 301</small>
                </div>

                <span class="status">
                    Selesai
                </span>

            </div>

        </div>

    </section>


    <!-- FEATURES -->
    <section class="features" id="fitur">

        <h2>Kenapa LaporKita?</h2>

        <p>
            Satu platform untuk membuat lingkungan kampus
            menjadi lebih nyaman.
        </p>


        <div class="feature-container">

            <div class="feature-card">

                <div class="feature-icon">
                    📝
                </div>

                <h3>Pelaporan Mudah</h3>

                <p>
                    Mahasiswa dapat melaporkan fasilitas
                    yang bermasalah dengan cepat dan mudah.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    📊
                </div>

                <h3>Pantau Status</h3>

                <p>
                    Pantau perkembangan laporan mulai dari
                    menunggu, diproses hingga selesai.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    🏫
                </div>

                <h3>Kampus Lebih Baik</h3>

                <p>
                    Membantu pihak kampus mengetahui
                    fasilitas yang membutuhkan perhatian.
                </p>

            </div>

        </div>

    </section>


    <!-- FOOTER -->
    <footer id="tentang">

        <p>
            © 2026 LaporKita — Sistem Pelaporan Fasilitas Kampus
        </p>

    </footer>

</body>
</html>