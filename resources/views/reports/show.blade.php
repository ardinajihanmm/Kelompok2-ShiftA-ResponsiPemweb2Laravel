@extends('layouts.app')

@section('title', 'Detail Laporan - LaporKita')

@section('content')
    <div class="page">
        <div class="container">
            <a href="{{ route('reports.index') }}" class="back-link">
                ← Kembali ke laporan
            </a>

            <div id="error-message" class="alert alert-error" style="display:none"></div>
            <p id="loading-message">Memuat detail laporan...</p>

            <div id="detail-content" style="display:none">
                <div class="detail-layout">
                    <div class="card">
                        <div class="detail-header">
                            <div>
                                <span id="facility-name" class="category">🏢 Fasilitas</span>
                                <h1 id="report-title"></h1>
                            </div>
                            <span id="report-status" class="status"></span>
                        </div>

                        <div class="detail-info">
                            <div><small>Lokasi</small><strong id="report-location"></strong></div>
                            <div><small>Dilaporkan oleh</small><strong id="report-user"></strong></div>
                            <div><small>Waktu laporan</small><strong id="report-date"></strong></div>
                        </div>

                        <hr>
                        <h3>Deskripsi Masalah</h3>
                        <p id="report-description" class="description"></p>

                        <hr>
                        <h3>Prioritas</h3>
                        <p id="report-priority"></p>
                    </div>

                    <div class="card status-card">
                        <h3>Status Laporan</h3>
                        <div id="report-timeline" class="timeline"></div>
                    </div>
                </div>

                <div class="card comments-card">
                    <h2>Tanggapan dan Komentar</h2>

                    <div id="comment-error" class="alert alert-error" style="display:none"></div>
                    <div id="comment-success" class="alert" style="display:none"></div>

                    <form id="comment-form">
                        <div class="form-group">
                            <label for="comment-input">Tulis tanggapan</label>
                            <textarea id="comment-input" class="form-control" rows="3" maxlength="1000"
                                placeholder="Tulis komentar..." required></textarea>
                        </div>
                        <button id="comment-submit" class="btn btn-primary" type="submit">
                            Kirim Tanggapan
                        </button>
                    </form>

                    <hr>
                    <p id="comments-loading">Memuat komentar...</p>
                    <div id="comments-list"></div>
                    <p id="comments-empty" style="display:none">Belum ada komentar.</p>
                    <button id="comments-more" class="btn btn-secondary" type="button" style="display:none">
                        Muat komentar lainnya
                    </button>
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
            overflow-wrap: anywhere;
        }

        .detail-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
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
            overflow-wrap: anywhere;
        }

        .description {
            color: #6b7280;
            line-height: 1.8;
            white-space: pre-wrap;
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

        .timeline-item small,
        .comment-date {
            color: #9ca3af;
            font-size: 12px;
        }

        .comments-card {
            margin-top: 25px;
        }

        .comments-card h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .comment-item {
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .comment-body {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            line-height: 1.7;
        }

        .comment-actions {
            display: flex;
            gap: 8px;
        }

        #comments-more {
            margin-top: 15px;
        }

        @media(max-width:800px) {

            .detail-layout,
            .detail-info {
                grid-template-columns: 1fr;
            }

            .detail-header,
            .comment-header {
                flex-wrap: wrap;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const $ = id => document.getElementById(id);
            const id = @json($id);
            const token = localStorage.getItem('auth_token');
            const headers = {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                ...(token ? { Authorization: `Bearer ${token}` } : {})
            };

            let user = null, page = 1, lastPage = 1, busy = false;

            const dateText = value => {
                if (!value) return '-';
                const date = new Date(value);
                return Number.isNaN(date.getTime()) ? '-' : date.toLocaleString('id-ID');
            };

            const message = (id, text) => {
                $(id).textContent = text;
                $(id).style.display = 'block';
            };

            async function request(url, options = {}) {
                const response = await fetch(url, { headers, ...options });
                const result = await response.json().catch(() => ({}));
                if (!response.ok) throw new Error(result.message || 'Permintaan gagal.');
                return result;
            }

            async function loadComments(reset = false) {
                if (busy) return;
                busy = true;

                if (reset) {
                    page = 1;
                    $('comments-list').replaceChildren();
                }

                $('comments-loading').style.display = 'block';
                $('comments-empty').style.display = 'none';
                $('comments-more').style.display = 'none';
                $('comment-error').style.display = 'none';

                try {
                    const result = await request(
                        `/api/reports/${encodeURIComponent(id)}/comments?page=${page}`
                    );
                    const paginator = result.data;
                    const comments = Array.isArray(paginator?.data) ? paginator.data : [];
                    lastPage = paginator?.last_page || 1;

                    comments.forEach(comment => {
                        const item = document.createElement('div');
                        item.className = 'comment-item';

                        const header = document.createElement('div');
                        header.className = 'comment-header';

                        const author = document.createElement('strong');
                        author.textContent = comment.user?.name || 'Pengguna';

                        const date = document.createElement('small');
                        date.className = 'comment-date';
                        date.textContent = dateText(comment.created_at);
                        header.append(author, date);

                        const body = document.createElement('p');
                        body.className = 'comment-body';
                        body.textContent = comment.comment || '';

                        item.append(header, body);

                        const owner = user && Number(user.id) === Number(comment.user_id);
                        const admin = user?.role === 'admin';

                        if (owner || admin) {
                            const actions = document.createElement('div');
                            actions.className = 'comment-actions';

                            if (owner) {
                                const edit = document.createElement('button');
                                edit.className = 'btn btn-secondary';
                                edit.type = 'button';
                                edit.textContent = 'Edit';
                                edit.onclick = async () => {
                                    const text = prompt('Ubah komentar:', comment.comment);
                                    if (text === null) return;
                                    if (!text.trim()) {
                                        message('comment-error', 'Komentar tidak boleh kosong.');
                                        return;
                                    }
                                    try {
                                        await request(`/api/comments/${comment.id}`, {
                                            method: 'PUT',
                                            body: JSON.stringify({ comment: text.trim() })
                                        });
                                        message('comment-success', 'Komentar diperbarui.');
                                        await loadComments(true);
                                    } catch (e) {
                                        message('comment-error', e.message);
                                    }
                                };
                                actions.append(edit);
                            }

                            const del = document.createElement('button');
                            del.className = 'btn btn-secondary';
                            del.type = 'button';
                            del.textContent = 'Hapus';
                            del.onclick = async () => {
                                if (!confirm('Hapus komentar ini?')) return;
                                try {
                                    await request(`/api/comments/${comment.id}`, { method: 'DELETE' });
                                    message('comment-success', 'Komentar dihapus.');
                                    await loadComments(true);
                                } catch (e) {
                                    message('comment-error', e.message);
                                }
                            };
                            actions.append(del);
                            item.append(actions);
                        }

                        $('comments-list').append(item);
                    });

                    $('comments-empty').style.display =
                        $('comments-list').children.length ? 'none' : 'block';
                    $('comments-more').style.display = page < lastPage ? 'inline-block' : 'none';
                } catch (e) {
                    message('comment-error', e.message);
                } finally {
                    $('comments-loading').style.display = 'none';
                    busy = false;
                }
            }

            $('comment-form').addEventListener('submit', async event => {
                event.preventDefault();
                $('comment-error').style.display = 'none';
                $('comment-success').style.display = 'none';

                if (!token) {
                    message('comment-error', 'Silakan login untuk mengirim komentar.');
                    return;
                }

                const comment = $('comment-input').value.trim();
                if (!comment) return;

                $('comment-submit').disabled = true;
                try {
                    const result = await request(`/api/reports/${encodeURIComponent(id)}/comments`, {
                        method: 'POST',
                        body: JSON.stringify({ comment })
                    });
                    $('comment-input').value = '';
                    message('comment-success', result.message || 'Komentar berhasil dikirim.');
                    await loadComments(true);
                } catch (e) {
                    message('comment-error', e.message);
                } finally {
                    $('comment-submit').disabled = false;
                }
            });

            $('comments-more').addEventListener('click', async () => {
                if (page < lastPage) {
                    page++;
                    await loadComments();
                }
            });

            try {
                if (token) {
                    try {
                        const result = await request('/api/auth/me');
                        user = result.data?.user ?? result.user ?? result.data ?? null;
                    } catch (e) {
                        console.warn('Identitas pengguna tidak berhasil dimuat:', e.message);
                    }
                }

                const result = await request(`/api/reports/${encodeURIComponent(id)}`);
                const report = result.data;
                if (!report) throw new Error('Laporan tidak ditemukan.');

                $('report-title').textContent = report.title || '-';
                $('facility-name').textContent = '🏢 ' + (report.facility?.name || 'Fasilitas');
                $('report-location').textContent = report.facility?.location || 'Tidak tersedia';
                $('report-user').textContent = report.user?.name || 'Pengguna';
                $('report-date').textContent = dateText(report.created_at);
                $('report-description').textContent = report.description || '-';
                $('report-priority').textContent = ({
                    low: 'Rendah', medium: 'Sedang', high: 'Tinggi'
                })[report.priority] || report.priority || '-';

                $('report-status').textContent = ({
                    menunggu: 'Menunggu', diproses: 'Diproses',
                    selesai: 'Selesai', ditolak: 'Ditolak'
                })[report.status] || report.status || '-';

                $('report-status').className = 'status ' + ({
                    menunggu: 'status-waiting', diproses: 'status-process',
                    selesai: 'status-done', ditolak: 'status-rejected'
                })[report.status];

                const steps = [
                    ['menunggu', 'Laporan dibuat'],
                    ['diproses', 'Sedang diproses'],
                    ['selesai', 'Selesai']
                ];
                const current = steps.findIndex(step => step[0] === report.status);

                $('report-timeline').replaceChildren();
                steps.forEach((step, index) => {
                    const row = document.createElement('div');
                    row.className = 'timeline-item' +
                        (current >= 0 && index <= current ? ' active' : '');
                    const dot = document.createElement('div');
                    dot.className = 'dot';
                    const content = document.createElement('div');
                    const title = document.createElement('strong');
                    title.textContent = step[1];
                    const date = document.createElement('small');
                    date.textContent = index === 0
                        ? dateText(report.created_at)
                        : (current >= index ? dateText(report.updated_at) : 'Belum tercapai');
                    content.append(title, date);
                    row.append(dot, content);
                    $('report-timeline').append(row);
                });

                if (report.status === 'ditolak') {
                    const row = document.createElement('div');
                    row.className = 'timeline-item active';
                    row.textContent = 'Laporan ditolak — ' + dateText(report.updated_at);
                    $('report-timeline').append(row);
                }

                await loadComments(true);
                $('loading-message').style.display = 'none';
                $('detail-content').style.display = 'block';
            } catch (e) {
                $('loading-message').style.display = 'none';
                message('error-message', e.message || 'Gagal memuat detail laporan.');
            }
        });
    </script>
@endsection