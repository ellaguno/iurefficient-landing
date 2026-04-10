/* ========================================
   Iurefficient Help Portal — Scripts
   ======================================== */

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- FAQ Accordion ---------- */
  document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.parentElement;
      const wasOpen = item.classList.contains('open');
      // close all in same list
      item.parentElement.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!wasOpen) item.classList.add('open');
    });
  });

  /* ---------- Tabs ---------- */
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.closest('.tabs-container');
      group.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      group.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
      btn.classList.add('active');
      const target = document.getElementById(btn.dataset.tab);
      if (target) target.classList.add('active');
    });
  });

  /* ---------- Global search on index ---------- */
  const searchInput = document.getElementById('globalSearch');
  if (searchInput) {
    const cards = document.querySelectorAll('#categoryCards .card');
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase().trim();
      cards.forEach(card => {
        const text = (card.dataset.search || '') + ' ' + card.textContent.toLowerCase();
        card.classList.toggle('hidden', q.length > 0 && !text.includes(q));
      });
    });
  }

  /* ---------- Scroll fade-up ---------- */
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  /* ---------- Smooth scroll for anchors ---------- */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
  });

  /* ---------- Active nav link ---------- */
  const currentPage = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.navbar-links a').forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === currentPage);
  });
});
