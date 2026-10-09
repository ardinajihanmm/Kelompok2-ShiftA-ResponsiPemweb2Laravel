<<<<<<< HEAD
@extends('layouts.dashboard')

@section('title', 'Buat Laporan')

@section('content')
    <a href="{{ route('reports.index') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali ke daftar laporan</a>
    <div class="page-head">
        <div>
            <h1>Buat Laporan Baru</h1>
            <p>Jelaskan kendala fasilitas agar bisa ditindaklanjuti dengan tepat.</p>
        </div>
    </div>

    <div class="panel form-panel">
        <div class="alert alert-info"><i class="bi bi-info-circle-fill"></i><span>Isi detail kerusakan dan unggah foto sebagai bukti. Prioritas akan ditentukan oleh admin setelah laporan ditinjau. Status awal laporan adalah <b>Menunggu</b>.</span></div>
        <div id="reportMsg"></div>

        <form id="reportForm" novalidate>
            <div class="form-grid">
                <div class="field span-2">
                    <label for="facility_id">Fasilitas kampus <span class="req">*</span></label>
                    <select class="select" id="facility_id" required><option value="">Memuat fasilitas...</option></select>
                </div>

                <div class="field span-2">
                    <label for="title">Judul laporan <span class="req">*</span></label>
                    <input class="input" id="title" maxlength="255" placeholder="Contoh: AC ruang kelas tidak menyala" required>
                </div>

                <div class="field span-2">
                    <label for="description">Deskripsi masalah <span class="req">*</span></label>
                    <textarea class="textarea" id="description" placeholder="Jelaskan kondisi, lokasi spesifik, dan dampak masalah..." required></textarea>
                </div>

                <div class="field span-2">
                    <label for="photo">Foto bukti kerusakan <span class="req">*</span></label>
                    <input class="input" type="file" id="photo" accept="image/jpeg,image/png,image/webp" required>
                    <small class="field-hint">Format JPG, PNG, atau WEBP. Maksimal 2 MB. Foto membantu admin memeriksa kondisi fasilitas.</small>
                    <div id="photoPreviewWrap" style="display:none;margin-top:12px">
                        <img id="photoPreview" alt="Pratinjau foto bukti" style="max-width:260px;max-height:190px;object-fit:contain;border-radius:12px;border:1px solid #dbe3ef">
                    </div>
                </div>

                <div class="field span-2">
                    <label for="reporterDisplay">Pelapor</label>
                    <input class="input" id="reporterDisplay" disabled>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('reports.index') }}" class="btn btn-outline">Batal</a>
                <button class="btn btn-primary" id="submitBtn" type="submit">Kirim laporan <i class="bi bi-send"></i></button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/report-create.js') }}"></script>
@endpush
=======
@extends('layouts.app')

@section('title', 'Buat Laporan - LaporKita')

@section('content')

    <div class="page-container">

        <div class="page-header">
            <div>
                <h1>Buat Laporan</h1>
                <p>Laporkan fasilitas kampus yang mengalami masalah.</p>
            </div>

            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

        <div class="card">

            <div id="error-message" class="alert alert-error" style="display:none;"></div>
            <div id="success-message" class="alert" style="display:none;"></div>

            <form id="report-form">

                <div class="form-group">
                    <label for="facility_id">Fasilitas</label>
                    <select id="facility_id" name="facility_id" class="form-control" required>
                        <option value="">Memuat fasilitas....</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Judul Laporan</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        placeholder="Contoh: Lampu ruangan mati"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Masalah</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="6"
                        placeholder="Jelaskan kerusakan atau masalah fasilitas..."
                        required
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="priority">Prioritas</label>
                    <select id="priority" name="priority" class="form-control" required>
                        <option value="low">Rendah</option>
                        <option value="medium" selected>Sedang</option>
                        <option value="high">Tinggi</option>
                    </select>
                </div>

                <div style="display:flex; gap:12px; margin-top:20px;">
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" id="submit-button" class="btn btn-primary">
                        Kirim Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        async function loadFacilities() {
    const facilitySelect = document.getElementById('facility_id');
    const token = localStorage.getItem('auth_token');
    if (!token) {
    facilitySelect.innerHTML =
        '<option value="">Silakan login terlebih dahulu</option>';
    return;
    }

    facilitySelect.innerHTML = '<option value="">Memuat fasilitas...</option>';

    try {
        const response = await fetch('/api/facilities?per_page=100', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'Gagal memuat fasilitas.');
        }

        // Mendukung respons FacilityResource dengan pagination Laravel.
        const facilities = Array.isArray(result.data)
            ? result.data
            : [];

        facilitySelect.innerHTML =
            '<option value="">Pilih fasilitas</option>';

        facilities.forEach(function (facility) {
            const option = document.createElement('option');
            option.value = facility.id;
            option.textContent = facility.name + ' — ' + facility.location;
            facilitySelect.appendChild(option);
        });

        if (facilities.length === 0) {
            facilitySelect.innerHTML =
                '<option value="">Belum ada fasilitas tersedia</option>';
        }
    } catch (error) {
        facilitySelect.innerHTML =
            '<option value="">Gagal memuat fasilitas</option>';

        console.error('Kesalahan fasilitas:', error);
    }
}

loadFacilities();
    document.getElementById('report-form').addEventListener('submit', async function (event) {
        event.preventDefault();

        const form = this;
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');
        const submitButton = document.getElementById('submit-button');

        errorMessage.style.display = 'none';
        successMessage.style.display = 'none';
        errorMessage.textContent = '';
        successMessage.textContent = '';

        const token = localStorage.getItem('auth_token');

        if (!token) {
            errorMessage.textContent = 'Sesi login tidak ditemukan. Silakan login terlebih dahulu.';
            errorMessage.style.display = 'block';
            return;
        }

        const payload = {
            facility_id: Number(form.facility_id.value),
            title: form.title.value.trim(),
            description: form.description.value.trim(),
            priority: form.priority.value
        };

        submitButton.disabled = true;
        submitButton.textContent = 'Mengirim...';

        try {
            const response = await fetch('/api/reports', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Sesi login tidak valid atau sudah berakhir. Silakan login kembali.');
                }

                if (result.errors) {
                    const messages = Object.values(result.errors).flat();
                    throw new Error(messages.join(' '));
                }

                throw new Error(result.message || 'Laporan gagal dikirim.');
            }

            successMessage.textContent = result.message || 'Laporan berhasil dikirim!';
            successMessage.style.display = 'block';

            form.reset();
            form.priority.value = 'medium';
            
            submitButton.disabled = true; 
            submitButton.textContent = 'Laporan berhasil!'; 
            
            window.setTimeout(function () { 
                window.location.assign('/laporan'); 
            }, 1000); 
            return;

        } catch (error) {
            errorMessage.textContent = error.message || 'Terjadi kesalahan saat mengirim laporan.';
            errorMessage.style.display = 'block';
        } finally {
            if (!successMessage.textContent) {
                submitButton.disabled = false;
                submitButton.textContent = 'Kirim Laporan';
            }
        }
    });
    </script>

@endsection
<<<<<<< HEAD

=======
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
>>>>>>> 5f287d4ee30cd078aa0738cb9042e57796871337
