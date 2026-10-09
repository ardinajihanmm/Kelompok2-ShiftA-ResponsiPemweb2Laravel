@extends('layouts.app')

@section('title', 'Dashboard - LaporKita')

@section('content')

    <div class="page">
        <div class="container">

            <div class="page-title">
                <h1>Dashboard 👋</h1>
                <p>Selamat datang di LaporKita. Pantau laporan fasilitas kampusmu di sini.</p>
            </div>

            {{-- STATISTIK --}}
            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-icon">📋</div>
                    <div>
                        <span>Total Laporan</span>
                        <strong>12</strong>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon yellow">⏳</div>
                    <div>
                        <span>Menunggu</span>
                        <strong>4</strong>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">🔧</div>
                    <div>
                        <span>Diproses</span>
                        <strong>5</strong>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">✓</div>
                    <div>
                        <span>Selesai</span>
                        <strong>3</strong>
                    </div>
                </div>

            </div>

            {{-- LAPORAN TERBARU --}}
            <div class="section-header">
                <div>
                    <h2>Laporan Terbaru</h2>
                    <p>Beberapa laporan fasilitas yang kamu buat.</p>
                </div>

                <a href="{{ route('reports.create') }}" class="btn btn-primary">
                    + Buat Laporan
                </a>
            </div>

            <div class="card">

                <div class="report-row">
                    <div class="report-icon">💡</div>

                    <div class="report-content">
                        <strong>Lampu Ruang 204 Rusak</strong>
                        <small>Gedung Fakultas A • 2 jam lalu</small>
                    </div>

                    <span class="status status-process">
                        Diproses
                    </span>
                </div>

                <div class="report-row">
                    <div class="report-icon">🚰</div>

                    <div class="report-content">
                        <strong>Kran Air Toilet Rusak</strong>
                        <small>Gedung B • Kemarin</small>
                    </div>

                    <span class="status status-waiting">
                        Menunggu
                    </span>
                </div>

                <div class="report-row">
                    <div class="report-icon">🪑</div>

                    <div class="report-content">
                        <strong>Kursi Ruang 301 Rusak</strong>
                        <small>Gedung C • 2 hari lalu</small>
                    </div>

                    <span class="status status-done">
                        Selesai
                    </span>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('styles')

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-icon.yellow {
            background: #fef3c7;
        }

        .stat-icon.blue {
            background: #dbeafe;
        }

        .stat-icon.green {
            background: #dcfce7;
        }

        .stat-card span {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .stat-card strong {
            font-size: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .section-header h2 {
            margin-bottom: 5px;
        }

        .section-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .report-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .report-row:last-child {
            border-bottom: none;
        }

        .report-icon {
            width: 45px;
            height: 45px;
            background: #eff6ff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        .report-content {
            flex: 1;
        }

        .report-content strong {
            display: block;
            margin-bottom: 5px;
        }

        .report-content small {
            color: #9ca3af;
        }

        .status {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .status-waiting {
            background: #fef3c7;
            color: #92400e;
        }

        .status-process {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-done {
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 800px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }
        }
    </style>

@endsection