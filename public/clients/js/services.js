/* ================================================================
   SERVICES.JS – Trang Dịch Vụ Toyota VN
   ================================================================ */

document.addEventListener('DOMContentLoaded', () => {
  // Init loan calculator on load
  calcLoan();

  // Tab switcher for service content
  initServiceTabs();
});

function initServiceTabs() {
  const tabs = document.querySelectorAll('.service-tab-btn');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // Remove active from all tabs in same container
      const container = tab.closest('.tabs-wrap') || tab.closest('.service-tabs').parentElement;
      const allTabs = tab.closest('.service-tabs').querySelectorAll('.service-tab-btn');
      allTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      // Show correct panel
      const target = tab.getAttribute('data-tab');
      const panels = container.querySelectorAll('[data-tab-panel]');
      panels.forEach(p => p.classList.remove('active'));
      const targetPanel = container.querySelector(`[data-tab-panel="${target}"]`);
      if (targetPanel) targetPanel.classList.add('active');
    });
  });
}
