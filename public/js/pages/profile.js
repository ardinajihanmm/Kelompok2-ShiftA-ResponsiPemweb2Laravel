(function () {
  'use strict';
  const { $ } = FT;
  FT.ready.then(u => {
    $('#pName').value = u.name || '';
    $('#pEmail').value = u.email || '';
    $('#pRole').value = (u.role || 'mahasiswa').replace(/^./, c => c.toUpperCase());
    $('#pSince').value = FT.date(u.created_at);
    $('#roleBadge').className = 'badge no-dot role-' + (u.role || 'mahasiswa');
  });
})();
