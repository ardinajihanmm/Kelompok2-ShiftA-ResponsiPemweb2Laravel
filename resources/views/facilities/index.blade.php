@extends('layouts.dashboard')

@section('title', 'Fasilitas Kampus')

@section('content')
    <div class="page-head">
        <div>
            <h1>Fasilitas Kampus</h1>
            <p>Direktori fasilitas dan lokasi yang bisa dilaporkan.</p>
        </div>
        <div class="head-actions admin-only hidden">
            <button class="btn btn-primary" id="toggleFormBtn" type="button"><i class="bi bi-plus-lg"></i> Tambah fasilitas</button>
        </div>
    </div>

    <div id="formWrap" class="panel form-panel hidden" style="margin-bottom:20px">
        <div class="panel-head"><h2 id="facilityFormTitle">Tambah fasilitas</h2></div>
        <div id="formMsg"></div>
        <form id="facilityForm" novalidate><input type="hidden" id="facilityId">
            <div class="form-grid">
                <div class="field"><label for="fName">Nama fasilitas <span class="req">*</span></label><input class="input" id="fName" required></div>
                <div class="field"><label for="fLocation">Lokasi <span class="req">*</span></label><input class="input" id="fLocation" placeholder="Gedung A, lantai 2" required></div>
                <div class="field span-2"><label for="fCategory">Kategori <span class="req">*</span></label><select class="select" id="fCategory" required></select></div>
                <div class="field span-2"><label for="fDesc">Deskripsi</label><textarea class="textarea" id="fDesc" style="min-height:90px"></textarea></div>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline" id="cancelFormBtn">Batal</button>
                <button class="btn btn-primary" id="saveBtn" type="submit">Simpan fasilitas</button>
            </div>
        </form>
    </div>

    <div class="toolbar">
        <div class="input-icon"><i class="bi bi-search"></i><input class="input" id="facilitySearch" placeholder="Cari nama atau lokasi fasilitas..." autocomplete="off"></div>
        <span class="muted" id="facilityCount" style="font-size:12.5px"></span>
    </div>
    <div class="chips" id="categoryChips"></div>

    <div id="facilityGrid" class="card-grid"></div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/facilities.js') }}"></script>
@endpush
