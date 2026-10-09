@extends('layouts.app')

@section('title', 'Detail Laporan - LaporKita')

@section('content')

    <div class="page">

        <div class="container">

            <a href="{{ route('reports.index') }}" class="back-link">
                ← Kembali ke laporan
            </a>

            <div class="detail-layout">

                {{-- DETAIL UTAMA --}}
                <div class="card">

                    <div class="detail-header">

                        <div>
                            <span class="category">
                                💡 Elektronik
                            </span>

                            <h1>
                                Lampu Ruang 204 Rusak
                            </h1>
                        </div>

                        <span class="status status-process">
                            Diproses
                        </span>

                    </div>

                    <div class="detail-info">

                        <div>
                            <small>Lokasi</small>
                            <strong>📍 Gedung Fakultas A, Ruang 204</strong>
                        </div>

                        <div>
                            <small>Dilaporkan oleh</small>
                            <strong>Mahasiswa</strong>
                        </div>

                        <div>
                            <small>Waktu laporan</small>
                            <strong>9 Oktober 2026, 09:30</strong>
                        </div>

                    </div>

                    <hr>

                    <h3>Deskripsi Masalah</h3>

                    <p class="description">
                        Lampu di ruang 204 mati dan membuat ruangan cukup gelap
                        saat digunakan untuk kegiatan belajar. Mohon dilakukan
                        pengecekan dan perbaikan agar ruangan dapat digunakan
                        dengan nyaman.
                    </p>

                </div>

                {{-- STATUS --}}
                <div class="card status-card">

                    <h3>Status Laporan</h3>

                    <div class="timeline">

                        <div class="timeline-item active">
                            <div class="dot"></div>

                            <div>
                                <strong>Laporan dibuat</strong>
                                <small>9 Oktober 2026</small>
                            </div>
                        </div>

                        <div class="timeline-item active">
                            <div class="dot"></div>

                            <div>
                                <strong>Sedang diproses</strong>
                                <small>9 Oktober 2026</small>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="dot"></div>

                            <div>
                                <strong>Selesai</strong>
                                <small>Belum selesai</small>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('styles')

    <style>
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .detail-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-header h1 {
            font-size: 28px;
            margin-top: 15px;
        }

        .detail-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .detail-info small {
            display: block;
            color: #9ca3af;
            margin-bottom: 7px;
        }

        .detail-info strong {
            font-size: 14px;
        }

        hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 25px 0;
        }

        .description {
            color: #6b7280;
            line-height: 1.8;
            margin-top: 12px;
        }

        .status-card h3 {
            margin-bottom: 25px;
        }

        .timeline-item {
            display: flex;
            gap: 15px;
            position: relative;
            padding-bottom: 28px;
        }

        .timeline-item:not(:last-child)::after {
            content: "";
            position: absolute;
            left: 5px;
            top: 15px;
            width: 2px;
            height: calc(100% - 5px);
            background: #e5e7eb;
        }

        .dot {
            width: 12px;
            height: 12px;
            background: #d1d5db;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 3px;
            z-index: 1;
        }

        .timeline-item.active .dot {
            background: #2563eb;
        }

        .timeline-item strong {
            display: block;
            margin-bottom: 5px;
        }

        .timeline-item small {
            color: #9ca3af;
        }

        @media (max-width: 800px) {
            .detail-layout {
                grid-template-columns: 1fr;
            }

            .detail-info {
                grid-template-columns: 1fr;
            }
        }
    </style>

@endsection