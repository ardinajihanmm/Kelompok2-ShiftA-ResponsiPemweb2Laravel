(function () {
  'use strict';
  const { $, esc } = FT;
  const state = { page: 1, seq: 0, editing: null };
  const wrap = $('#userFormWrap'), form = $('#userForm');
  function formOpen(user = null) {
    state.editing = user?.id ?? null;
    $('#userFormTitle').textContent = user ? 'Edit pengguna' : 'Tambah pengguna';
    $('#saveUserBtn').textContent = user ? 'Simpan perubahan' : 'Simpan pengguna';
    $('#uName').value = user?.name || ''; $('#uEmail').value = user?.email || '';
    $('#uRole').value = user?.role || 'mahasiswa'; $('#uPassword').value = ''; $('#uPasswordConfirmation').value = '';
    $('#uPassword').required = !user; $('#uPasswordConfirmation').required = !user;
    $('#uPasswordRequired').textContent = user ? '(opsional)' : '*'; $('#uConfirmRequired').textContent = user ? '(opsional)' : '*';
    $('#uPasswordHint').textContent = user ? 'Kosongkan jika password tidak ingin diubah.' : 'Minimal 8 karakter.';
    FT.alert('#userFormMsg', ''); wrap.classList.remove('hidden'); wrap.scrollIntoView({behavior:'smooth',block:'start'}); $('#uName').focus();
  }
  function formClose() { wrap.classList.add('hidden'); form.reset(); state.editing = null; FT.alert('#userFormMsg',''); }
  async function load() {
    const seq = ++state.seq, q = new URLSearchParams({ page: state.page, per_page: 10 });
    const search = $('#userSearch').value.trim(); if (search) q.set('search', search);
    $('#userTable').innerHTML = FT.skeletonRows(5);
    const r = await FT.api('/users?' + q); if (seq !== state.seq) return;
    if (!r.ok) { $('#userTable').innerHTML = FT.empty('shield-lock','Tidak dapat memuat pengguna',FT.errorText(r.data)); return; }
    const items = FT.list(r.data), meta = FT.meta(r.data); $('#userCount').textContent = (meta?.total ?? items.length) + ' pengguna';
    $('#userTable').innerHTML = items.length ? `<div class="table-wrap"><table><thead><tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Terdaftar</th><th>Aksi</th></tr></thead><tbody>${items.map(u=>`<tr><td><div class="cell-user"><div class="avatar">${FT.initial(u.name)}</div><div><div class="td-title">${esc(u.name)}</div><div class="td-sub">User #${u.id}</div></div></td><td>${esc(u.email)}</td><td>${FT.roleBadge(u.role)}</td><td>${FT.date(u.created_at)}</td><td><div class="head-actions"><button class="btn btn-outline btn-sm" data-edit-user="${u.id}"><i class="bi bi-pencil"></i> Edit</button><button class="btn btn-danger btn-sm" data-delete-user="${u.id}" ${u.id===FT.user?.id?'disabled title="Akun yang sedang digunakan tidak dapat dihapus"':''}><i class="bi bi-trash"></i> Hapus</button></div></td></tr>`).join('')}</tbody></table></div><div class="pagination" id="pagination"></div>` : FT.empty('people','Pengguna tidak ditemukan','Coba kata kunci lain.');
    FT.renderPager($('#pagination'),meta,p=>{state.page=p;load();});
  }
  $('#addUserBtn').addEventListener('click',()=>formOpen()); $('#cancelUserBtn').addEventListener('click',formClose);
  $('#userSearch').addEventListener('input',FT.debounce(()=>{state.page=1;load();},350));
  $('#userTable').addEventListener('click',async e=>{
    const edit=e.target.closest('[data-edit-user]'), del=e.target.closest('[data-delete-user]');
    if(edit){const id=edit.dataset.editUser; const r=await FT.api('/users/'+id); if(!r.ok){FT.toast(FT.errorText(r.data),'error');return;} formOpen(r.data.data||r.data);return;}
    if(del){const id=Number(del.dataset.deleteUser);if(id===FT.user?.id){FT.toast('Akun yang sedang digunakan tidak dapat dihapus.','error');return;}if(!await FT.confirm({title:'Hapus pengguna?',text:'Akun ini akan dihapus dan tidak dapat dipulihkan.',okText:'Ya, hapus'}))return;del.disabled=true;const r=await FT.api('/users/'+id,{method:'DELETE'});if(!r.ok){FT.toast(FT.errorText(r.data,'Gagal menghapus pengguna.'),'error');del.disabled=false;return;}FT.toast('Pengguna berhasil dihapus.');load();}
  });
  form.addEventListener('submit',async e=>{e.preventDefault();const body={name:$('#uName').value.trim(),email:$('#uEmail').value.trim(),role:$('#uRole').value};const pw=$('#uPassword').value;if(pw){body.password=pw;body.password_confirmation=$('#uPasswordConfirmation').value;}if(!state.editing&& !pw){FT.alert('#userFormMsg','Password wajib diisi untuk pengguna baru.');return;}if(pw.length>0&&pw.length<8){FT.alert('#userFormMsg','Password minimal 8 karakter.');return;}if(pw!==$('#uPasswordConfirmation').value){FT.alert('#userFormMsg','Konfirmasi password tidak sama.');return;}const btn=$('#saveUserBtn');FT.loading(btn,true);const r=await FT.api(state.editing?'/users/'+state.editing:'/users',{method:state.editing?'PUT':'POST',body:JSON.stringify(body)});FT.loading(btn,false);if(!r.ok){FT.alert('#userFormMsg',FT.errorText(r.data,'Gagal menyimpan pengguna.'));return;}FT.toast(state.editing?'Data pengguna diperbarui.':'Pengguna berhasil ditambahkan.');formClose();load();});
  FT.ready.then(load);
})();