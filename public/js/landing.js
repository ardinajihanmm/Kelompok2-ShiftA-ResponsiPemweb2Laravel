/* FasTrack landing: navbar scroll, menu mobile, reveal, CTA adaptif jika sudah login */
(function () {
  'use strict';
  document.documentElement.classList.add('js');
  const { $, $$ } = FT;

  const wrap = $('.nav-wrap');
  const onScroll = () => wrap?.classList.toggle('scrolled', window.scrollY > 24);
  onScroll(); window.addEventListener('scroll', onScroll, { passive: true });

  const toggle = $('#navToggle'), links = $('#navLinks');
  toggle?.addEventListener('click', () => {
    const open = links.classList.toggle('open');
    toggle.innerHTML = `<i class="bi bi-${open ? 'x-lg' : 'list'}"></i>`;
    toggle.setAttribute('aria-expanded', open);
  });
  $$('a', links || document).forEach(a => a.addEventListener('click', () => links?.classList.remove('open')));

  // Reveal on scroll
  const items = $$('.reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }), { threshold: .12 });
    items.forEach(el => io.observe(el));
  } else items.forEach(el => el.classList.add('in'));

  // Highlight menu sesuai section
  const sections = ['beranda', 'tentang', 'fitur', 'alur', 'faq'].map(id => document.getElementById(id)).filter(Boolean);
  window.addEventListener('scroll', () => {
    const y = window.scrollY + 140; let cur = sections[0]?.id;
    sections.forEach(s => { if (s.offsetTop <= y) cur = s.id; });
    $$('.nav-links a').forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + cur));
  }, { passive: true });

  // Sudah login? tombol berubah jadi "Buka Dashboard"
  if (FT.token()) {
    $$('[data-guest]').forEach(el => el.classList.add('hidden'));
    $$('[data-authed]').forEach(el => el.classList.remove('hidden'));
  }
})();
