@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
    <div class="page-head">
        <div>
            <h1>Kategori Fasilitas</h1>
            <p>Kelompokkan fasilitas berdasarkan jenisnya.</p>
        </div>
        <div class="head-actions admin-only hidden">
            <button class="btn btn-primary" id="toggleFormBtn" type="button"><i class="bi bi-plus-lg"></i> Tambah kategori</button>
        </div>
    </div>

    <div id="formWrap" class="panel form-panel hidden" style="margin-bottom:20px;max-width:640px">
        <div class="panel-head"><h2 id="categoryFormTitle">Tambah kategori</h2></div>
        <div id="formMsg"></div>
        <form id="categoryForm" novalidate><input type="hidden" id="categoryId">
            <div class="field"><label for="cName">Nama kategori <span class="req">*</span></label><input class="input" id="cName" placeholder="Contoh: Elektronik" required></div>
            <div class="field"><label for="cDesc">Deskripsi</label><textarea class="textarea" id="cDesc" style="min-height:90px"></textarea></div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline" id="cancelFormBtn">Batal</button>
                <button class="btn btn-primary" id="saveBtn" type="submit">Simpan kategori</button>
            </div>
        </form>
    </div>

    <div id="categoryGrid" class="card-grid"></div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/categories.js') }}"></script>
@endpush
