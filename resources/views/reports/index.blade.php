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
                    id="search-report"
                    class="form-control"
                    placeholder="🔍 Cari laporan..."
                >

                <select id="filter-status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <div id="error-message" class="alert alert-error" style="display:none;"></div>

            <div id="report-grid" class="report-grid">
                <p id="loading-message">Memuat laporan...</p>
            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', async function () {
        const grid = document.getElementById('report-grid');
        const errorMessage = document.getElementById('error-message');
        const searchInput = document.getElementById('search-report');
        const statusFilter = document.getElementById('filter-status');

        let reports = [];

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, function (char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[char];
            });
        }

        function statusLabel(status) {
            const labels = {
                menunggu: 'Menunggu',
                diproses: 'Diproses',
                selesai: 'Selesai',
                ditolak: 'Ditolak'
            };

            return labels[status] || status;
        }

        function formatDate(dateString) {
            if (!dateString) return '-';

            const date = new Date(dateString);

            if (Number.isNaN(date.getTime())) return '-';

            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
        }

        function renderReports() {
            const keyword = searchInput.value.trim().toLowerCase();
            const selectedStatus = statusFilter.value;

            const filtered = reports.filter(function (report) {
                const searchableText = [
                    report.title,
                    report.description,
                    report.facility?.name,
                    report.facility?.location,
                    report.status
                ].join(' ').toLowerCase();

                return searchableText.includes(keyword) &&
                    (!selectedStatus || report.status === selectedStatus);
            });

            if (filtered.length === 0) {
                grid.innerHTML = '<p>Belum ada laporan yang sesuai dengan pencarian.</p>';
                return;
            }

            grid.innerHTML = filtered.map(function (report) {
                const statusClasses = {
                    menunggu: 'status-waiting',
                    diproses: 'status-process',
                    selesai: 'status-done',
                    ditolak: 'status-rejected'
                };

                const facilityName = report.facility?.name || 'Fasilitas tidak diketahui';
                const location = report.facility?.location || 'Lokasi tidak tersedia';

                return `
                    <div class="report-card">
                        <div class="report-card-top">
                            <span class="category">🏢 ${escapeHtml(facilityName)}</span>
                            <span class="status ${statusClasses[report.status] || 'status-waiting'}">
                                ${escapeHtml(statusLabel(report.status))}
                            </span>
                        </div>

                        <h3>${escapeHtml(report.title)}</h3>

                        <p>${escapeHtml(report.description)}</p>

                        <div class="report-location">
                            📍 ${escapeHtml(location)}
                        </div>

                        <div class="report-card-footer">
                            <small>Dibuat ${escapeHtml(formatDate(report.created_at))}</small>

                            <a href="/laporan/${encodeURIComponent(report.id)}">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function loadReports() {
            const token = localStorage.getItem('auth_token');

            grid.innerHTML = '<p>Memuat laporan...</p>';
            errorMessage.style.display = 'none';

            try {
                const headers = {
                    'Accept': 'application/json'
                };

                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                const response = await fetch('/api/reports', {
                    method: 'GET',
                    headers: headers
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal mengambil daftar laporan.');
                }

                reports = Array.isArray(result.data) ? result.data : [];
                renderReports();

            } catch (error) {
                grid.innerHTML = '';
                errorMessage.textContent =
                    error.message || 'Tidak dapat terhubung ke server.';
                errorMessage.style.display = 'block';
            }
        }

        searchInput.addEventListener('input', renderReports);
        statusFilter.addEventListener('change', renderReports);

        await loadReports();
    });
    </script>

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
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .report-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            min-width: 0;
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
            overflow-wrap: anywhere;
        }

        .report-card p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            min-height: 68px;
            overflow-wrap: anywhere;
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
            white-space: nowrap;
        }

        @media (max-width: 900px) {
            .report-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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
