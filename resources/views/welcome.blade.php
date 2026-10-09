<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="csrf-token" content="{{ csrf_token() }}">
<title>FasTrack — Campus Facility Management</title>
<style>
:root{--ink:#17233b;--muted:#7d879b;--line:#e8ecf3;--bg:#f5f7fb;--white:#fff;--navy:#172642;--blue:#1d4ed8;--blue2:#173a7a;--pale:#edf2ff;--green:#16865b;--greenbg:#e7f7ef;--amber:#b97712;--amberbg:#fff4dc;--red:#c34444;--redbg:#ffeded;--shadow:0 10px 30px rgba(23,38,66,.045)}*{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}button,input,select,textarea{font:inherit}button{cursor:pointer}.hidden{display:none!important}.muted{color:var(--muted)}.btn{border:0;border-radius:10px;padding:11px 15px;font-weight:750;font-size:13px;transition:.18s}.primary{background:var(--blue);color:white}.primary:hover{background:var(--blue2);transform:translateY(-1px)}.soft{background:#eef1f7;color:#34415a}.danger{background:var(--redbg);color:var(--red)}.outline{background:#fff;border:1px solid var(--line);color:#34415a}.full{width:100%}input,select,textarea{width:100%;border:1px solid #dce2ec;border-radius:10px;background:#fff;padding:12px 13px;color:var(--ink);outline:none}input:focus,select:focus,textarea:focus{border-color:#8ba4f6;box-shadow:0 0 0 3px #1d4ed819}textarea{min-height:110px;resize:vertical}label{display:block;font-size:12px;font-weight:800;color:#56627a;margin:14px 0 7px}.auth{min-height:100vh;display:grid;grid-template-columns:1.05fr .95fr;background:white}.auth-hero{padding:8vw;display:flex;flex-direction:column;justify-content:center;color:white;background:radial-gradient(circle at 90% 20%,#476cce 0,transparent 33%),linear-gradient(145deg,#14223c,#263f70 70%,#1d4ed8)}.logo{font-weight:950;font-size:23px;letter-spacing:-.8px}.logo b{background:linear-gradient(135deg,#173a7a,#2454ad 65%,#326be0);-webkit-background-clip:text;background-clip:text;color:transparent}.auth-hero h1{font-size:clamp(36px,4.6vw,62px);line-height:1.05;letter-spacing:-2px;margin:55px 0 18px}.auth-hero p{max-width:510px;color:#dce6ff;line-height:1.8}.hero-points{display:grid;gap:14px;margin-top:24px;color:#e7edff;font-size:14px}.auth-side{display:grid;place-items:center;padding:30px}.auth-card{width:min(430px,100%);padding:36px;border:1px solid var(--line);border-radius:22px;box-shadow:var(--shadow)}.auth-card h2{font-size:28px;margin:25px 0 7px}.tabs{display:grid;grid-template-columns:1fr 1fr;gap:5px;background:#f0f2f7;padding:5px;border-radius:10px;margin:22px 0}.tab{border:0;border-radius:8px;padding:10px;color:var(--muted);background:transparent;font-weight:800}.tab.active{background:white;color:var(--ink);box-shadow:0 2px 7px #17264212}.msg{font-size:13px;padding:11px 13px;border-radius:9px;background:var(--greenbg);color:var(--green);margin:12px 0}.msg.error{background:var(--redbg);color:var(--red)}
.shell{min-height:100vh;display:grid;grid-template-columns:248px minmax(0,1fr)}.sidebar{background:var(--navy);color:#c4cee1;padding:24px 15px;display:flex;flex-direction:column;min-height:100vh;position:sticky;top:0;height:100vh;z-index:30}.side-brand{padding:0 13px 28px;color:#fff;font-size:23px;font-weight:950;letter-spacing:-.7px}.side-brand b{color:#8ca7ff}.side-caption{padding:14px 13px 8px;font-size:10px;letter-spacing:1.4px;font-weight:900;color:#7f8da8}.nav{display:grid;gap:5px}.nav-btn{display:flex;align-items:center;gap:12px;width:100%;text-align:left;background:transparent;color:#aebbd2;border:0;border-radius:10px;padding:12px 13px;font-weight:700;font-size:13px}.nav-btn .ico{width:22px;text-align:center;font-size:16px}.nav-btn:hover{background:#ffffff0d;color:#fff}.nav-btn.active{background:#1d4ed8;color:white;box-shadow:0 7px 18px #101b3438}.side-bottom{margin-top:auto;padding:14px 8px 0}.side-user{display:flex;align-items:center;gap:10px;padding:14px 7px;border-top:1px solid #ffffff17}.avatar{width:35px;height:35px;border-radius:11px;background:#dbe5ff;color:#2e4ca7;display:grid;place-items:center;font-weight:900}.side-user strong{display:block;color:white;font-size:12px}.side-user small{font-size:11px;color:#91a0ba}.logout{width:100%;margin-top:7px;text-align:left}.main{min-width:0}.topbar{height:75px;background:white;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 34px;position:sticky;top:0;z-index:20}.crumb{font-size:12px;color:var(--muted)}.top-title{font-weight:850;font-size:15px;margin-top:3px}.top-right{display:flex;align-items:center;gap:12px}.role-chip{background:#edf2ff;color:#3557bd;border-radius:30px;padding:8px 11px;font-size:11px;font-weight:850}.mobile-menu{display:none}.content{max-width:1500px;padding:30px 34px 55px;margin:auto}.page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:25px}.page-head h1{font-size:27px;letter-spacing:-.7px;margin:0 0 7px}.page-head p{font-size:13px;color:var(--muted);margin:0;line-height:1.6}.head-actions{display:flex;gap:9px;flex-wrap:wrap}.stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;margin-bottom:20px}.stat,.panel{background:white;border:1px solid var(--line);border-radius:15px;box-shadow:var(--shadow)}.stat{padding:19px}.stat-top{display:flex;justify-content:space-between;align-items:center;color:var(--muted);font-size:12px;font-weight:750}.stat-icon{width:36px;height:36px;display:grid;place-items:center;border-radius:11px;background:#edf2ff;color:#1d4ed8;font-size:17px}.stat-num{font-size:30px;font-weight:900;letter-spacing:-1px;margin-top:13px}.stat-foot{font-size:11px;color:var(--muted);margin-top:3px}.dashboard-grid{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(270px,.8fr);gap:18px}.panel{padding:21px;min-width:0}.panel-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:17px}.panel-head h2{font-size:15px;margin:0}.panel-head p{font-size:12px;color:var(--muted);margin:5px 0 0}.link-btn{border:0;background:transparent;color:var(--blue);font-size:12px;font-weight:850}.quick-actions{display:grid;gap:10px}.quick{display:flex;align-items:center;gap:12px;padding:14px;border:1px solid var(--line);border-radius:12px;background:#fff;text-align:left}.quick:hover{border-color:#bdcbff;background:#fafbff}.quick-icon{width:39px;height:39px;border-radius:12px;background:#edf2ff;display:grid;place-items:center;color:var(--blue);font-size:18px}.quick strong{display:block;font-size:13px}.quick small{display:block;color:var(--muted);font-size:11px;margin-top:4px}.filters{display:grid;grid-template-columns:minmax(190px,1fr) 165px 165px auto;gap:10px;margin-bottom:17px}.table-wrap{overflow:auto;border:1px solid var(--line);border-radius:12px}table{width:100%;border-collapse:collapse;min-width:690px}th{text-align:left;padding:13px 15px;background:#f8f9fc;color:#8791a4;font-size:10px;letter-spacing:.6px;text-transform:uppercase;font-weight:900;white-space:nowrap}td{padding:15px;border-top:1px solid #edf0f5;font-size:12px;vertical-align:middle}tbody tr:hover{background:#fbfcff}.td-title{font-weight:800;font-size:12px}.td-sub{color:var(--muted);font-size:11px;margin-top:5px}.badge{display:inline-flex;align-items:center;white-space:nowrap;padding:6px 9px;border-radius:30px;font-size:10px;font-weight:850}.s-menunggu{background:#fff4dc;color:#a96c0b}.s-diproses{background:#edf2ff;color:#3457c0}.s-selesai{background:#e7f7ef;color:#16865b}.s-ditolak{background:#ffeded;color:#c34444}.p-low{background:#e7f7ef;color:#16865b}.p-medium{background:#fff4dc;color:#a96c0b}.p-high{background:#ffeded;color:#c34444}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:0 18px}.span2{grid-column:1/-1}.form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:22px}.empty{padding:38px 18px;text-align:center;color:var(--muted);font-size:13px}.empty .big{font-size:28px;margin-bottom:10px}.notice{padding:13px 15px;border-radius:11px;background:#f0f5ff;color:#4560a8;font-size:12px;line-height:1.6;margin-bottom:17px}.mobile-overlay{display:none}.toast{position:fixed;right:25px;bottom:24px;background:#172642;color:white;padding:14px 18px;border-radius:12px;box-shadow:var(--shadow);z-index:100;font-size:13px;max-width:360px}.toast.error{background:#9d3333}
@media(max-width:1100px){.shell{grid-template-columns:220px minmax(0,1fr)}.content{padding:25px 22px}.topbar{padding:0 22px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.dashboard-grid{grid-template-columns:1fr}.filters{grid-template-columns:1fr 1fr}.filters input{grid-column:1/-1}}@media(max-width:760px){.auth{grid-template-columns:1fr}.auth-hero{display:none}.shell{display:block}.sidebar{position:fixed;left:-270px;top:0;width:250px;transition:left .22s;height:100dvh;min-height:0}.sidebar.open{left:0}.mobile-overlay.show{display:block;position:fixed;inset:0;background:#0d183266;z-index:25}.topbar{height:68px;padding:0 15px}.mobile-menu{display:inline-grid;place-items:center;width:37px;height:37px;border:1px solid var(--line);border-radius:10px;background:white;margin-right:10px}.top-left{display:flex;align-items:center}.content{padding:23px 14px 40px}.page-head{align-items:flex-start;flex-direction:column}.page-head h1{font-size:25px}.stats{gap:10px}.stat{padding:14px}.stat-num{font-size:26px}.stat-top{font-size:11px}.stat-icon{width:30px;height:30px}.panel{padding:15px}.filters{grid-template-columns:1fr 1fr}.form-grid{grid-template-columns:1fr}.span2{grid-column:auto}.top-right .role-chip{display:none}.auth-card{padding:25px}.head-actions{width:100%}.head-actions .btn{flex:1}}@media(max-width:380px){.stats{grid-template-columns:1fr 1fr}.filters{grid-template-columns:1fr}.filters input{grid-column:auto}}
</style>
</head><body>
<div id="authPage" class="auth"><section class="auth-hero"><div class="logo">Fas<b>Track</b></div><h1>Fasilitas kampus.<br>Lebih terpantau.</h1><p>Ruang kerja digital untuk melaporkan kerusakan, memantau tindak lanjut, dan menjaga fasilitas kampus tetap siap digunakan.</p><div class="hero-points"><span>✓ &nbsp; Pelaporan terpusat dan mudah ditelusuri</span><span>✓ &nbsp; Prioritas masalah lebih jelas</span><span>✓ &nbsp; Status tindak lanjut transparan</span></div></section><section class="auth-side"><div class="auth-card"><div class="logo" style="color:var(--ink)">Fas<b>Track</b></div><h2 id="authTitle">Selamat datang kembali</h2><p class="muted" id="authSubtitle" style="font-size:13px;line-height:1.7">Masuk untuk mengakses monitoring fasilitas kampus.</p><div class="tabs"><button class="tab active" id="loginTab" onclick="setAuth('login')">Masuk</button><button class="tab" id="registerTab" onclick="setAuth('register')">Daftar akun</button></div><div id="authMsg"></div><form id="authForm" onsubmit="submitAuth(event)"><div id="nameWrap" class="hidden"><label>Nama lengkap</label><input id="name" placeholder="Nama kamu"></div><label>Email</label><input id="email" type="email" placeholder="nama@email.com" required><label>Password</label><input id="password" type="password" placeholder="Minimal 8 karakter" required><div id="confirmWrap" class="hidden"><label>Konfirmasi password</label><input id="password_confirmation" type="password"></div><button class="btn primary full" id="authBtn" type="submit" style="margin-top:22px">Masuk ke FasTrack</button></form><p class="muted" style="font-size:11px;text-align:center;margin-top:24px">Sistem Pelaporan dan Monitoring Fasilitas Kampus</p></div></section></div>
<div id="appPage" class="shell hidden"><div id="overlay" class="mobile-overlay" onclick="toggleSidebar(false)"></div><aside class="sidebar" id="sidebar"><div class="side-brand">Fas<b>Track</b></div><div class="side-caption">WORKSPACE</div><nav class="nav"><button class="nav-btn active" data-page="dashboard" onclick="go('dashboard')"><span class="ico">▦</span>Dashboard</button><button class="nav-btn" data-page="reports" onclick="go('reports')"><span class="ico">▤</span>Semua Laporan</button><button class="nav-btn" data-page="create" onclick="go('create')"><span class="ico">＋</span>Buat Laporan</button><div class="side-caption">MASTER DATA</div><button class="nav-btn" data-page="facilities" onclick="go('facilities')"><span class="ico">⌂</span>Fasilitas Kampus</button><button class="nav-btn" data-page="categories" onclick="go('categories')"><span class="ico">▧</span>Kategori</button><button class="nav-btn admin-only hidden" data-page="users" onclick="go('users')"><span class="ico">♙</span>Pengguna</button></nav><div class="side-bottom"><div class="side-caption">ACCOUNT</div><button class="nav-btn" data-page="profile" onclick="go('profile')"><span class="ico">◎</span>Profil Saya</button><div class="side-user"><div class="avatar" id="avatar">F</div><div style="min-width:0"><strong id="sideName">Pengguna</strong><small id="sideRole">Mahasiswa</small></div></div><button class="nav-btn logout" onclick="logout()"><span class="ico">↪</span>Keluar</button></div></aside>
<div class="main"><header class="topbar"><div class="top-left"><button class="mobile-menu" onclick="toggleSidebar()">☰</button><div><div class="crumb">FasTrack / Workspace</div><div class="top-title" id="topTitle">Dashboard</div></div></div><div class="top-right"><span class="role-chip" id="roleChip">MAHASISWA</span><button class="btn outline" onclick="refreshCurrent()">↻ Refresh</button></div></header><main class="content">
<section class="page hidden" id="page-dashboard"><div class="page-head"><div><h1 id="helloTitle">Dashboard overview</h1><p>Ringkasan laporan dan aktivitas fasilitas kampus hari ini.</p></div><div class="head-actions"><button class="btn primary" onclick="go('create')">＋ Buat laporan</button></div></div><div class="stats"><div class="stat"><div class="stat-top">Total laporan <span class="stat-icon">▤</span></div><div class="stat-num" id="statTotal">0</div><div class="stat-foot">Semua laporan tercatat</div></div><div class="stat"><div class="stat-top">Menunggu <span class="stat-icon" style="background:var(--amberbg);color:var(--amber)">◷</span></div><div class="stat-num" id="statWaiting">0</div><div class="stat-foot">Perlu ditinjau admin</div></div><div class="stat"><div class="stat-top">Diproses <span class="stat-icon">↻</span></div><div class="stat-num" id="statProcess">0</div><div class="stat-foot">Dalam tindak lanjut</div></div><div class="stat"><div class="stat-top">Selesai <span class="stat-icon" style="background:var(--greenbg);color:var(--green)">✓</span></div><div class="stat-num" id="statDone">0</div><div class="stat-foot">Sudah ditangani</div></div></div><div class="dashboard-grid"><section class="panel"><div class="panel-head"><div><h2>Laporan terbaru</h2><p>Pantau laporan fasilitas yang baru masuk.</p></div><button class="link-btn" onclick="go('reports')">Lihat semua →</button></div><div id="recentReports"><div class="empty">Memuat laporan...</div></div></section><section class="panel"><div class="panel-head"><div><h2>Akses cepat</h2><p>Langsung ke aktivitas utama.</p></div></div><div class="quick-actions"><button class="quick" onclick="go('create')"><span class="quick-icon">＋</span><span><strong>Buat laporan baru</strong><small>Laporkan kerusakan fasilitas</small></span></button><button class="quick" onclick="go('reports')"><span class="quick-icon">▤</span><span><strong>Monitoring laporan</strong><small>Cari dan filter perkembangan</small></span></button><button class="quick" onclick="go('facilities')"><span class="quick-icon">⌂</span><span><strong>Direktori fasilitas</strong><small>Lihat lokasi fasilitas kampus</small></span></button></div><div class="notice" style="margin-top:17px;margin-bottom:0">Alur tindak lanjut: laporan dibuat → ditinjau admin → diproses → selesai atau ditolak.</div></section></div></section>
<section class="page hidden" id="page-reports"><div class="page-head"><div><h1>Semua Laporan</h1><p>Kelola dan telusuri laporan kerusakan fasilitas kampus.</p></div><div class="head-actions"><button class="btn primary" onclick="go('create')">＋ Buat laporan</button></div></div><section class="panel"><div class="filters"><input id="search" placeholder="Cari judul atau deskripsi..." oninput="debouncedReports()"><select id="statusFilter" onchange="loadReports()"><option value="">Semua status</option><option value="menunggu">Menunggu</option><option value="diproses">Diproses</option><option value="selesai">Selesai</option><option value="ditolak">Ditolak</option></select><select id="priorityFilter" onchange="loadReports()"><option value="">Semua prioritas</option><option value="low">Rendah</option><option value="medium">Sedang</option><option value="high">Tinggi</option></select><button class="btn soft" onclick="clearFilters()">Reset filter</button></div><div id="reportTable"><div class="empty">Memuat data...</div></div></section></section>
<section class="page hidden" id="page-create"><div class="page-head"><div><h1>Buat Laporan Baru</h1><p>Jelaskan kendala fasilitas agar bisa ditindaklanjuti dengan tepat.</p></div></div><div class="panel" style="max-width:850px"><div class="notice">Tips: pilih fasilitas dan prioritas yang sesuai. Laporan baru akan masuk dengan status <b>Menunggu</b>.</div><div id="reportMsg"></div><form id="reportForm" onsubmit="createReport(event)"><div class="form-grid"><div class="span2"><label>Fasilitas kampus *</label><select id="facility_id" required><option value="">Pilih fasilitas...</option></select></div><div class="span2"><label>Judul laporan *</label><input id="title" maxlength="255" placeholder="Contoh: AC ruang kelas tidak menyala" required></div><div class="span2"><label>Deskripsi masalah *</label><textarea id="description" placeholder="Jelaskan kondisi, lokasi spesifik, dan dampak masalah..." required></textarea></div><div><label>Prioritas *</label><select id="priority"><option value="low">Rendah — tidak mendesak</option><option value="medium" selected>Sedang — perlu ditangani</option><option value="high">Tinggi — mendesak</option></select></div><div><label>Pelapor</label><input id="reporterDisplay" disabled></div></div><div class="form-actions"><button type="button" class="btn soft" onclick="go('reports')">Batal</button><button class="btn primary" type="submit">Kirim laporan →</button></div></form></div></section>
<section class="page hidden" id="page-facilities"><div class="page-head"><div><h1>Fasilitas Kampus</h1><p>Direktori fasilitas dan lokasi yang bisa dilaporkan.</p></div><div class="head-actions admin-only hidden"><button class="btn primary" onclick="toggleInlineForm('facilityFormWrap')">＋ Tambah fasilitas</button></div></div><div id="facilityFormWrap" class="panel hidden" style="margin-bottom:18px;max-width:850px"><div class="panel-head"><h2>Tambah fasilitas</h2></div><div id="facilityMsg"></div><form onsubmit="createMaster(event,'facility')"><div class="form-grid"><div><label>Nama fasilitas *</label><input id="facilityName" required></div><div><label>Lokasi *</label><input id="facilityLocation" required placeholder="Gedung A, lantai 2"></div><div class="span2"><label>Kategori *</label><select id="facilityCategory" required></select></div><div class="span2"><label>Deskripsi</label><textarea id="facilityDescription"></textarea></div></div><div class="form-actions"><button type="button" class="btn soft" onclick="toggleInlineForm('facilityFormWrap',false)">Batal</button><button class="btn primary">Simpan fasilitas</button></div></form></div><div class="panel"><div class="panel-head"><div><h2>Daftar fasilitas</h2><p id="facilityCount">Memuat data fasilitas...</p></div><input id="facilitySearch" style="max-width:260px" placeholder="Cari fasilitas..." oninput="renderFacilities()"></div><div id="facilityTable"><div class="empty">Memuat data...</div></div></div></section>
<section class="page hidden" id="page-categories"><div class="page-head"><div><h1>Kategori Fasilitas</h1><p>Kelompokkan fasilitas berdasarkan jenisnya.</p></div><div class="head-actions admin-only hidden"><button class="btn primary" onclick="toggleInlineForm('categoryFormWrap')">＋ Tambah kategori</button></div></div><div id="categoryFormWrap" class="panel hidden" style="margin-bottom:18px;max-width:700px"><div class="panel-head"><h2>Tambah kategori</h2></div><div id="categoryMsg"></div><form onsubmit="createMaster(event,'category')"><label>Nama kategori *</label><input id="categoryName" required placeholder="Contoh: Elektronik"><label>Deskripsi</label><textarea id="categoryDescription"></textarea><div class="form-actions"><button type="button" class="btn soft" onclick="toggleInlineForm('categoryFormWrap',false)">Batal</button><button class="btn primary">Simpan kategori</button></div></form></div><div class="panel"><div class="panel-head"><div><h2>Daftar kategori</h2><p>Referensi kategori yang digunakan pada formulir laporan.</p></div></div><div id="categoryTable"><div class="empty">Memuat data...</div></div></div></section>
<section class="page hidden" id="page-users"><div class="page-head"><div><h1>Pengguna</h1><p>Daftar pengguna yang terdaftar di FasTrack.</p></div></div><div class="panel"><div class="notice">Halaman ini hanya tersedia untuk admin.</div><div id="userTable"><div class="empty">Memuat data...</div></div></div></section>
<section class="page hidden" id="page-profile"><div class="page-head"><div><h1>Profil Saya</h1><p>Informasi akun yang sedang digunakan.</p></div></div><div class="panel" style="max-width:700px"><div style="display:flex;align-items:center;gap:15px;padding-bottom:22px;border-bottom:1px solid var(--line)"><div class="avatar" style="width:58px;height:58px;font-size:21px" id="profileAvatar">F</div><div><h2 id="profileName" style="margin:0 0 5px;font-size:19px">Pengguna</h2><span class="role-chip" id="profileRole">MAHASISWA</span></div></div><div class="form-grid" style="margin-top:10px"><div><label>Nama</label><input id="profileNameField" disabled></div><div><label>Email</label><input id="profileEmailField" disabled></div><div><label>Role</label><input id="profileRoleField" disabled></div></div><div class="form-actions"><button class="btn danger" onclick="logout()">Keluar dari akun</button></div></div></section>
</main></div></div><div id="toast" class="toast hidden"></div>
<script>
const state={token:localStorage.getItem('fastrack_token'),user:null,page:'dashboard',timer:null,reports:[],facilities:[],categories:[],users:[]};const $=id=>document.getElementById(id);const pageNames={dashboard:'Dashboard',reports:'Semua Laporan',create:'Buat Laporan',facilities:'Fasilitas Kampus',categories:'Kategori Fasilitas',users:'Pengguna',profile:'Profil Saya'};
async function api(path,options={}){options.headers=Object.assign({'Accept':'application/json','Content-Type':'application/json'},options.headers||{});if(state.token)options.headers.Authorization='Bearer '+state.token;try{return await fetch('/api'+path,options)}catch(e){throw new Error('Tidak dapat terhubung ke server. Pastikan Laravel berjalan.')}}function esc(v){return String(v??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]))}function payload(d){return Array.isArray(d.data)?d.data:(d.data?.data||d.data||[])}function notify(text,error=false){const t=$('toast');t.textContent=text;t.classList.toggle('error',error);t.classList.remove('hidden');clearTimeout(state.toastTimer);state.toastTimer=setTimeout(()=>t.classList.add('hidden'),3300)}function msg(id,text,error=false){if($(id))$(id).innerHTML=`<div class="msg ${error?'error':''}">${esc(text)}</div>`}
function setAuth(mode){state.mode=mode;$('authTitle').textContent=mode==='login'?'Selamat datang kembali':'Buat akun FasTrack';$('authSubtitle').textContent=mode==='login'?'Masuk untuk mengakses monitoring fasilitas kampus.':'Daftar sebagai mahasiswa untuk mulai membuat laporan.';$('authBtn').textContent=mode==='login'?'Masuk ke FasTrack':'Buat akun';$('nameWrap').classList.toggle('hidden',mode==='login');$('confirmWrap').classList.toggle('hidden',mode==='login');$('loginTab').classList.toggle('active',mode==='login');$('registerTab').classList.toggle('active',mode==='register');$('authMsg').innerHTML=''}
async function submitAuth(e){e.preventDefault();const mode=state.mode||'login',body={email:$('email').value,password:$('password').value};if(mode==='register'){body.name=$('name').value;body.password_confirmation=$('password_confirmation').value}const b=$('authBtn');b.disabled=true;try{const r=await api('/auth/'+mode,{method:'POST',body:JSON.stringify(body)}),d=await r.json().catch(()=>({}));if(!r.ok){msg('authMsg',d.message||'Tidak dapat masuk. Periksa data yang kamu isi.',true);return}state.token=d.data.token;localStorage.setItem('fastrack_token',state.token);await loadMe()}catch(err){msg('authMsg',err.message,true)}finally{b.disabled=false}}
async function loadMe(){try{const r=await api('/auth/me');if(!r.ok){state.token=null;localStorage.removeItem('fastrack_token');$('authPage').classList.remove('hidden');$('appPage').classList.add('hidden');return}const d=await r.json();state.user=d.data;showApp();await loadAll()}catch(e){notify(e.message,true)}}function showApp(){$('authPage').classList.add('hidden');$('appPage').classList.remove('hidden');const u=state.user||{};const initial=(u.name||'F').trim().charAt(0).toUpperCase();$('sideName').textContent=u.name||'Pengguna';$('sideRole').textContent=(u.role||'mahasiswa').toUpperCase();$('avatar').textContent=initial;$('profileAvatar').textContent=initial;$('profileName').textContent=u.name||'-';$('profileNameField').value=u.name||'';$('profileEmailField').value=u.email||'';$('profileRoleField').value=u.role||'mahasiswa';$('profileRole').textContent=(u.role||'mahasiswa').toUpperCase();$('roleChip').textContent=(u.role||'mahasiswa').toUpperCase();$('helloTitle').textContent='Halo, '+(u.name||'Pengguna').split(' ')[0];$('reporterDisplay').value=u.name||'';document.querySelectorAll('.admin-only').forEach(el=>el.classList.toggle('hidden',u.role!=='admin'));go(state.page||'dashboard')}
async function logout(){try{if(state.token)await api('/auth/logout',{method:'POST'})}catch(e){}state.token=null;state.user=null;localStorage.removeItem('fastrack_token');$('appPage').classList.add('hidden');$('authPage').classList.remove('hidden');$('authForm').reset();setAuth('login')}
function go(p){if(p==='users'&&state.user?.role!=='admin'){notify('Halaman ini hanya untuk admin.',true);return}state.page=p;document.querySelectorAll('.page').forEach(el=>el.classList.add('hidden'));$('page-'+p)?.classList.remove('hidden');document.querySelectorAll('.nav-btn[data-page]').forEach(el=>el.classList.toggle('active',el.dataset.page===p));$('topTitle').textContent=pageNames[p]||'Dashboard';toggleSidebar(false);if(p==='reports')loadReports();if(p==='facilities')loadFacilities();if(p==='categories')loadCategories();if(p==='users')loadUsers();if(p==='dashboard'){loadReports();updateStats()}}
function toggleSidebar(force){const s=$('sidebar'),open=typeof force==='boolean'?force:!s.classList.contains('open');s.classList.toggle('open',open);$('overlay').classList.toggle('show',open)}function refreshCurrent(){loadAll();notify('Data diperbarui.')}
async function loadAll(){await Promise.allSettled([loadCategories(),loadFacilities(),loadReports(),updateStats()]);if(state.page==='dashboard')renderRecent()}async function loadCategories(){try{const r=await api('/categories?per_page=100');if(!r.ok)return;state.categories=payload(await r.json());renderCategories();const sel=$('facilityCategory');if(sel)sel.innerHTML='<option value="">Pilih kategori...</option>'+state.categories.map(c=>`<option value="${c.id}">${esc(c.name)}</option>`).join('')}catch(e){console.error(e)}}async function loadFacilities(){try{const r=await api('/facilities?per_page=100');if(!r.ok)return;state.facilities=payload(await r.json());renderFacilities();const sel=$('facility_id');if(sel){const old=sel.value;sel.innerHTML='<option value="">Pilih fasilitas...</option>'+state.facilities.map(f=>`<option value="${f.id}">${esc(f.name)} — ${esc(f.location)}</option>`).join('');if(old)sel.value=old}}catch(e){console.error(e)}}
function date(v){return v?new Date(v).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'}):'-'}function statusBadge(s){return `<span class="badge s-${esc(s)}">${esc((s||'menunggu').replace(/^./,c=>c.toUpperCase()))}</span>`}function priorityBadge(p){return `<span class="badge p-${esc(p)}">${p==='high'?'Tinggi':p==='medium'?'Sedang':'Rendah'}</span>`}
async function loadReports(){try{const q=new URLSearchParams({per_page:'100'});if($('search')?.value.trim())q.set('search',$('search').value.trim());if($('statusFilter')?.value)q.set('status',$('statusFilter').value);if($('priorityFilter')?.value)q.set('priority',$('priorityFilter').value);const r=await api('/reports?'+q);if(!r.ok){$('reportTable').innerHTML='<div class="empty">Gagal memuat laporan. Periksa koneksi API.</div>';return}state.reports=payload(await r.json());renderReportTable();renderRecent();}catch(e){if($('reportTable'))$('reportTable').innerHTML=`<div class="empty">${esc(e.message)}</div>`}}function debouncedReports(){clearTimeout(state.timer);state.timer=setTimeout(loadReports,300)}function clearFilters(){if($('search'))$('search').value='';if($('statusFilter'))$('statusFilter').value='';if($('priorityFilter'))$('priorityFilter').value='';loadReports()}
function reportRows(items){if(!items.length)return '<div class="empty"><div class="big">▤</div>Belum ada laporan yang cocok.</div>';return `<div class="table-wrap"><table><thead><tr><th>Laporan</th><th>Fasilitas</th><th>Prioritas</th><th>Status</th><th>Tanggal</th>${state.user?.role==='admin'?'<th>Ubah status</th>':''}</tr></thead><tbody>${items.map(x=>`<tr><td><div class="td-title">${esc(x.title)}</div><div class="td-sub">${esc(x.user?.name||'Pelapor')} · #${x.id}</div></td><td><div class="td-title">${esc(x.facility?.name||'-')}</div><div class="td-sub">${esc(x.facility?.location||'')}</div></td><td>${priorityBadge(x.priority)}</td><td>${statusBadge(x.status)}</td><td>${date(x.created_at)}</td>${state.user?.role==='admin'?`<td><select aria-label="Status laporan" onchange="updateStatus(${x.id},this.value)" style="min-width:125px;padding:8px">${['menunggu','diproses','selesai','ditolak'].map(s=>`<option value="${s}" ${x.status===s?'selected':''}>${s}</option>`).join('')}</select></td>`:''}</tr>`).join('')}</tbody></table></div>`}function renderReportTable(){if($('reportTable'))$('reportTable').innerHTML=reportRows(state.reports)}function renderRecent(){if(!$('recentReports'))return;$('recentReports').innerHTML=state.reports.length?reportRows(state.reports.slice(0,5)):'<div class="empty"><div class="big">▤</div>Belum ada laporan. Mulai dengan membuat laporan pertama.</div>'}
async function updateStats(){try{const r=await api('/reports?per_page=100');if(!r.ok)return;const a=payload(await r.json());$('statTotal').textContent=a.length;$('statWaiting').textContent=a.filter(x=>x.status==='menunggu').length;$('statProcess').textContent=a.filter(x=>x.status==='diproses').length;$('statDone').textContent=a.filter(x=>x.status==='selesai').length}catch(e){console.error(e)}}async function createReport(e){e.preventDefault();const btn=e.submitter;btn.disabled=true;const body={facility_id:Number($('facility_id').value),title:$('title').value.trim(),description:$('description').value.trim(),priority:$('priority').value};try{const r=await api('/reports',{method:'POST',body:JSON.stringify(body)}),d=await r.json().catch(()=>({}));if(!r.ok){msg('reportMsg',d.message||Object.values(d.errors||{}).flat().join(' ')||'Laporan gagal dibuat.',true);return}msg('reportMsg','Laporan berhasil dikirim. Status awal: Menunggu.');$('reportForm').reset();$('reporterDisplay').value=state.user?.name||'';await loadReports();await updateStats();notify('Laporan berhasil dibuat.');setTimeout(()=>go('reports'),600)}catch(err){msg('reportMsg',err.message,true)}finally{btn.disabled=false}}
async function updateStatus(id,status){try{const r=await api('/reports/'+id,{method:'PUT',body:JSON.stringify({status})}),d=await r.json().catch(()=>({}));if(!r.ok){notify(d.message||'Status gagal diperbarui.',true);await loadReports();return}notify('Status laporan berhasil diperbarui.');await loadReports();await updateStats()}catch(e){notify(e.message,true)}}
function renderFacilities(){const items=state.facilities.filter(f=>(f.name+' '+(f.location||'')+' '+(f.category?.name||'')).toLowerCase().includes(($('facilitySearch')?.value||'').toLowerCase()));$('facilityCount').textContent=`${items.length} fasilitas terdaftar`;if(!items.length){$('facilityTable').innerHTML='<div class="empty">Belum ada fasilitas yang cocok.</div>';return}$('facilityTable').innerHTML=`<div class="table-wrap"><table><thead><tr><th>Nama fasilitas</th><th>Lokasi</th><th>Kategori</th><th>Deskripsi</th></tr></thead><tbody>${items.map(f=>`<tr><td><div class="td-title">${esc(f.name)}</div><div class="td-sub">ID #${f.id}</div></td><td>${esc(f.location||'-')}</td><td>${esc(f.category?.name||f.category_name||'-')}</td><td>${esc(f.description||'-')}</td></tr>`).join('')}</tbody></table></div>`}
function renderCategories(){if(!$('categoryTable'))return;if(!state.categories.length){$('categoryTable').innerHTML='<div class="empty">Belum ada kategori.</div>';return}$('categoryTable').innerHTML=`<div class="table-wrap"><table><thead><tr><th>Kategori</th><th>Deskripsi</th><th>ID</th></tr></thead><tbody>${state.categories.map(c=>`<tr><td><div class="td-title">${esc(c.name)}</div></td><td>${esc(c.description||'-')}</td><td>#${c.id}</td></tr>`).join('')}</tbody></table></div>`}
async function createMaster(e,type){e.preventDefault();const isF=type==='facility',body=isF?{name:$('facilityName').value.trim(),location:$('facilityLocation').value.trim(),category_id:Number($('facilityCategory').value),description:$('facilityDescription').value.trim()}:{name:$('categoryName').value.trim(),description:$('categoryDescription').value.trim()};const id=isF?'facilityMsg':'categoryMsg';try{const r=await api(isF?'/facilities':'/categories',{method:'POST',body:JSON.stringify(body)}),d=await r.json().catch(()=>({}));if(!r.ok){msg(id,d.message||Object.values(d.errors||{}).flat().join(' ')||'Gagal menyimpan data.',true);return}$(isF?'facilityFormWrap':'categoryFormWrap').querySelector('form').reset();toggleInlineForm(isF?'facilityFormWrap':'categoryFormWrap',false);notify('Data berhasil ditambahkan.');await loadCategories();await loadFacilities()}catch(err){msg(id,err.message,true)}}function toggleInlineForm(id,force){const el=$(id);el.classList.toggle('hidden',typeof force==='boolean'?!force:!el.classList.contains('hidden'))}
async function loadUsers(){try{const r=await api('/users?per_page=100');if(!r.ok){$('userTable').innerHTML='<div class="empty">Tidak dapat memuat pengguna. Pastikan akses admin aktif.</div>';return}state.users=payload(await r.json());$('userTable').innerHTML=state.users.length?`<div class="table-wrap"><table><thead><tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Terdaftar</th></tr></thead><tbody>${state.users.map(u=>`<tr><td><div class="td-title">${esc(u.name)}</div><div class="td-sub">User #${u.id}</div></td><td>${esc(u.email)}</td><td><span class="badge ${u.role==='admin'?'s-diproses':'s-selesai'}">${esc(u.role||'mahasiswa')}</span></td><td>${date(u.created_at)}</td></tr>`).join('')}</tbody></table></div>`:'<div class="empty">Belum ada pengguna.</div>'}catch(e){$('userTable').innerHTML=`<div class="empty">${esc(e.message)}</div>`}}
if(state.token)loadMe();else setAuth('login');
</script></body></html>
=======
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
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
