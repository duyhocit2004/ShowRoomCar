/* ================================================================
   SHOWROOM.JS – Trang Showroom Toyota VN
   ================================================================ */

const MAP_URLS = {
  mk: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6!2d105.85!3d21.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abc!2zTWluaCBLaGFp!5e0!3m2!1svi!2svn!4v1700000001',
  cg: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8!2d105.79!3d21.03!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135b3!2zQ2F1IEdpYXk!5e0!3m2!1svi!2svn!4v1700000002',
  lb: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5!2d105.88!3d21.04!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135bc!2zTG9uZyBCaWVu!5e0!3m2!1svi!2svn!4v1700000003',
  hcm: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.3!2d106.69!3d10.77!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752!2zSENNIFF1YW4gMQ!5e0!3m2!1svi!2svn!4v1700000004',
};

function switchMap(key, btn) {
  const frame = document.getElementById('mapFrame');
  const tabs = document.querySelectorAll('.map-tab');
  if (frame && MAP_URLS[key]) frame.src = MAP_URLS[key];
  tabs.forEach(t => t.classList.remove('active'));
  if (btn) btn.classList.add('active');
}

function filterShowrooms(region, btn) {
  const cards = document.querySelectorAll('#showroomGrid > [data-region]');
  const btns = document.querySelectorAll('.showroom-filter-btn');

  btns.forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');

  cards.forEach(card => {
    if (region === 'all' || card.dataset.region === region) {
      card.style.display = '';
      // Re-trigger AOS
      setTimeout(() => card.querySelector('[data-aos]')?.classList.add('aos-animate'), 50);
    } else {
      card.style.display = 'none';
    }
  });
}
