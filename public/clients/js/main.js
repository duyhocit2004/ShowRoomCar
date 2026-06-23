/* ================================================================
   MAIN.JS – Global JS Utilities & Animations
   Toyota VN Website
   ================================================================ */

// ----------------------------------------------------------------
// PAGE LOADER
// ----------------------------------------------------------------
function initLoader() {
  const loader = document.getElementById('pageLoader');
  const bar = document.getElementById('loaderBar');
  if (!loader || !bar) return;

  let w = 0;
  const iv = setInterval(() => {
    w += Math.random() * 18;
    if (w >= 100) { w = 100; clearInterval(iv); }
    bar.style.width = w + '%';
    if (w >= 100) {
      setTimeout(() => {
        loader.classList.add('hidden');
        setTimeout(() => loader.remove(), 600);
      }, 250);
    }
  }, 80);
}

// ----------------------------------------------------------------
// NAVBAR SCROLL EFFECT
// ----------------------------------------------------------------
function initNavbar() {
  const nav = document.getElementById('mainNav');
  if (!nav) return;
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  });
}

// ----------------------------------------------------------------
// SCROLL TO TOP
// ----------------------------------------------------------------
function initScrollTop() {
  const btn = document.getElementById('scrollTop');
  if (!btn) return;
  window.addEventListener('scroll', () => {
    btn.classList.toggle('show', window.scrollY > 400);
  });
  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ----------------------------------------------------------------
// MOBILE MENU
// ----------------------------------------------------------------
function toggleMobile() {
  const menu = document.getElementById('mobileMenu');
  const ham = document.querySelector('.hamburger');
  if (!menu) return;
  menu.classList.toggle('open');
  if (ham) ham.classList.toggle('open');
}

function closeMobile() {
  const menu = document.getElementById('mobileMenu');
  const ham = document.querySelector('.hamburger');
  if (menu) menu.classList.remove('open');
  if (ham) ham.classList.remove('open');
}

// ----------------------------------------------------------------
// ANIMATE ON SCROLL (Custom AOS)
// ----------------------------------------------------------------
function initAOS() {
  const elements = document.querySelectorAll('[data-aos]');
  if (!elements.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = entry.target.getAttribute('data-aos-delay') || 0;
        setTimeout(() => {
          entry.target.classList.add('aos-animate');
        }, parseInt(delay));
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  elements.forEach(el => observer.observe(el));
}

// ----------------------------------------------------------------
// COUNTER ANIMATION
// ----------------------------------------------------------------
function animateCounter(el, target, duration = 2000, suffix = '') {
  const start = 0;
  const startTime = performance.now();
  const isDecimal = target.toString().includes('.');
  const targetNum = parseFloat(target);

  const update = (currentTime) => {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
    const current = start + (targetNum - start) * eased;
    el.textContent = isDecimal ? current.toFixed(1) : Math.floor(current).toLocaleString();
    if (progress < 1) requestAnimationFrame(update);
    else el.textContent = isDecimal ? targetNum.toFixed(1) : targetNum.toLocaleString() + suffix;
  };
  requestAnimationFrame(update);
}

function initCounters() {
  const counters = document.querySelectorAll('[data-counter]');
  if (!counters.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = entry.target.getAttribute('data-counter');
        const suffix = entry.target.getAttribute('data-counter-suffix') || '';
        animateCounter(entry.target, target, 2000, suffix);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(el => observer.observe(el));
}

// ----------------------------------------------------------------
// FORM SUBMIT HANDLER (Generic)
// ----------------------------------------------------------------
function submitForm(btn, successMsg = 'Gửi Thành Công!') {
  const form = btn.closest('form') || btn.parentElement;
  const originalHTML = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
  btn.disabled = true;

  setTimeout(() => {
    btn.innerHTML = `<i class="fas fa-check"></i> ${successMsg}`;
    btn.style.background = '#1a7a4a';
    showToastGlobal('Đăng ký thành công! Chúng tôi sẽ liên hệ sớm nhất.', 'success');
    setTimeout(() => {
      btn.innerHTML = originalHTML;
      btn.style.background = '';
      btn.disabled = false;
    }, 4000);
  }, 1200);
}

// ----------------------------------------------------------------
// TOAST NOTIFICATIONS (Global)
// ----------------------------------------------------------------
function showToastGlobal(msg, type = 'success') {
  let wrap = document.getElementById('toastWrap');
  if (!wrap) {
    wrap = document.createElement('div');
    wrap.id = 'toastWrap';
    document.body.appendChild(wrap);
  }
  const t = document.createElement('div');
  const icons = { success: 'fa-check-circle', info: 'fa-info-circle', warn: 'fa-exclamation-triangle', error: 'fa-times-circle' };
  const colors = { success: '#1a7a4a', info: '#1a5276', warn: '#CC0000', error: '#CC0000' };
  t.className = 'toast-msg';
  t.style.borderLeftColor = colors[type] || colors.success;
  t.innerHTML = `<i class="fas ${icons[type] || icons.success}" style="color:${colors[type] || colors.success}"></i> ${msg}`;
  wrap.appendChild(t);
  setTimeout(() => t.classList.add('show'), 10);
  setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3500);
}

// ----------------------------------------------------------------
// ACCORDION
// ----------------------------------------------------------------
function initAccordion(containerSelector = '.accordion-wrap') {
  const containers = document.querySelectorAll(containerSelector);
  containers.forEach(container => {
    const items = container.querySelectorAll('.accordion-item');
    items.forEach(item => {
      const header = item.querySelector('.accordion-header');
      const body = item.querySelector('.accordion-body');
      if (!header || !body) return;

      header.addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        // Close all
        items.forEach(i => {
          i.classList.remove('open');
          const b = i.querySelector('.accordion-body');
          if (b) b.style.maxHeight = '0';
        });
        // Open clicked
        if (!isOpen) {
          item.classList.add('open');
          body.style.maxHeight = body.scrollHeight + 'px';
        }
      });
    });
  });
}

// ----------------------------------------------------------------
// TABS
// ----------------------------------------------------------------
function initTabs(containerSelector = '.tabs-wrap') {
  const containers = document.querySelectorAll(containerSelector);
  containers.forEach(container => {
    const tabs = container.querySelectorAll('[data-tab]');
    const panels = container.querySelectorAll('[data-tab-panel]');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const target = tab.getAttribute('data-tab');
        tabs.forEach(t => t.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        const panel = container.querySelector(`[data-tab-panel="${target}"]`);
        if (panel) panel.classList.add('active');
      });
    });
  });
}

// ----------------------------------------------------------------
// LOAN CALCULATOR
// ----------------------------------------------------------------
function calcLoan() {
  const price = parseFloat(document.getElementById('loanPrice')?.value) || 0;
  const down = parseFloat(document.getElementById('loanDown')?.value) || 0;
  const rate = parseFloat(document.getElementById('loanRate')?.value) || 7;
  const term = parseInt(document.getElementById('loanTerm')?.value) || 60;

  const principal = (price - down) * 1000000; // convert triệu to đồng
  const monthlyRate = rate / 100 / 12;
  let monthly = 0;

  if (monthlyRate === 0) {
    monthly = principal / term;
  } else {
    monthly = principal * (monthlyRate * Math.pow(1 + monthlyRate, term)) / (Math.pow(1 + monthlyRate, term) - 1);
  }

  const totalPay = monthly * term;
  const totalInterest = totalPay - principal;

  const fmtM = (num) => (num / 1000000).toFixed(1);

  const monthlyEl = document.getElementById('loanMonthly');
  const totalEl = document.getElementById('loanTotal');
  const interestEl = document.getElementById('loanInterest');

  if (monthlyEl) monthlyEl.textContent = fmtM(monthly) + ' Triệu';
  if (totalEl) totalEl.textContent = fmtM(totalPay) + ' Triệu';
  if (interestEl) interestEl.textContent = fmtM(totalInterest) + ' Triệu';
}

// ----------------------------------------------------------------
// IMAGE LIGHTBOX (Simple)
// ----------------------------------------------------------------
function initLightbox() {
  const images = document.querySelectorAll('[data-lightbox]');
  if (!images.length) return;

  const overlay = document.createElement('div');
  overlay.style.cssText = `
    position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,0.95);
    display:none;align-items:center;justify-content:center;padding:20px;
  `;
  overlay.innerHTML = `
    <button onclick="this.parentElement.style.display='none'" style="
      position:absolute;top:20px;right:20px;background:none;border:1px solid rgba(255,255,255,0.3);
      color:white;width:48px;height:48px;cursor:pointer;font-size:20px;
      display:flex;align-items:center;justify-content:center;
    "><i class="fas fa-times"></i></button>
    <img id="lightboxImg" src="" alt="" style="max-width:90vw;max-height:85vh;object-fit:contain;border-radius:4px;">
  `;
  document.body.appendChild(overlay);

  images.forEach(img => {
    img.style.cursor = 'pointer';
    img.addEventListener('click', () => {
      document.getElementById('lightboxImg').src = img.getAttribute('data-lightbox') || img.src;
      overlay.style.display = 'flex';
    });
  });

  overlay.addEventListener('click', e => { if (e.target === overlay) overlay.style.display = 'none'; });
}

// ----------------------------------------------------------------
// INIT ALL
// ----------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
  initLoader();
  initNavbar();
  initScrollTop();
  initAOS();
  initCounters();
  initAccordion();
  initTabs();
  initLightbox();
});
