@extends('layouts.app')

@section('title', 'Laporan - LaporKita')

@section('content')

    <div class="page">

        <div class="container">

            <div class="page-title-row">

                <div class="page-title" style="margin-bottom:0;">
                    <h1>Daftar Laporan 📋</h1>
                    <p>Lihat dan pantau laporan fasilitas kampus.</p>
                </div>

                <a href="{{ route('reports.create') }}" class="btn btn-primary">
                    + Buat Laporan
                </a>

            </div>

            <div class="filter-bar card">

                <input
                    type="text"
                    class="form-control"
                    placeholder="🔍 Cari laporan..."
                >

                <select class="form-control">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Diproses</option>
                    <option>Selesai</option>
                </select>

            </div>

            <div class="report-grid">

                {{-- LAPORAN 1 --}}
                <div class="report-card">

                    <div class="report-card-top">
                        <span class="category">💡 Elektronik</span>
                        <span class="status status-process">Diproses</span>
                    </div>

                    <h3>Lampu Ruang 204 Rusak</h3>

                    <p>
                        Lampu di ruang 204 mati dan membuat ruangan cukup gelap
                        saat digunakan untuk kegiatan belajar.
                    </p>

                    <div class="report-location">
                        📍 Gedung Fakultas A, Ruang 204
                    </div>

                    <div class="report-card-footer">
                        <small>Dilaporkan 2 jam lalu</small>

                        <a href="{{ route('reports.show', 1) }}">
                            Lihat Detail →
                        </a>
                    </div>

                </div>

                {{-- LAPORAN 2 --}}
                <div class="report-card">

                    <div class="report-card-top">
                        <span class="category">🚰 Fasilitas Air</span>
                        <span class="status status-waiting">Menunggu</span>
                    </div>

                    <h3>Kran Air Toilet Rusak</h3>

                    <p>
                        Kran air pada toilet lantai dua tidak dapat digunakan
                        karena mengalami kerusakan.
                    </p>

                    <div class="report-location">
                        📍 Gedung B, Toilet Lantai 2
                    </div>

                    <div class="report-card-footer">
                        <small>Dilaporkan kemarin</small>

                        <a href="{{ route('reports.show', 2) }}">
                            Lihat Detail →
                        </a>
                    </div>

                </div>

                {{-- LAPORAN 3 --}}
                <div class="report-card">

                    <div class="report-card-top">
                        <span class="category">🪑 Furniture</span>
                        <span class="status status-done">Selesai</span>
                    </div>

                    <h3>Kursi Ruang 301 Rusak</h3>

                    <p>
                        Beberapa kursi di ruang 301 mengalami kerusakan pada
                        bagian kaki dan tidak nyaman digunakan.
                    </p>

                    <div class="report-location">
                        📍 Gedung C, Ruang 301
                    </div>

                    <div class="report-card-footer">
                        <small>Dilaporkan 2 hari lalu</small>

                        <a href="{{ route('reports.show', 3) }}">
                            Lihat Detail →
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('styles')

    <style>

        .page-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .filter-bar {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .report-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
        }

        .report-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 10px;
        }

        .category {
            font-size: 12px;
            color: #2563eb;
            background: #eff6ff;
            padding: 6px 9px;
            border-radius: 20px;
        }

        .report-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .report-card p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            min-height: 68px;
        }

        .report-location {
            color: #4b5563;
            font-size: 13px;
            margin: 18px 0;
        }

        .report-card-footer {
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .report-card-footer small {
            color: #9ca3af;
        }

        .report-card-footer a {
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .report-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {
            .report-grid {
                grid-template-columns: 1fr;
            }

            .page-title-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-bar {
                grid-template-columns: 1fr;
            }
        }

    </style>

@endsection