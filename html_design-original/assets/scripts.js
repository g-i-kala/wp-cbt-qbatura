/* ─── INDEX: SCREEN 1 → 2 TOGGLE ─── */
(function () {
  var screen1 = document.getElementById('screen-1');
  var screen2 = document.getElementById('screen-2');
  var enterBtn = document.getElementById('enter-btn');

  if (enterBtn && screen1 && screen2) {
    enterBtn.addEventListener('click', function () {
      screen1.classList.add('hidden');
      screen2.classList.add('visible');
    });
  }
})();

/* ─── MOBILE OVERLAY MENU ─── */
(function () {
  var overlay = document.getElementById('mobile-menu');
  var openBtns = document.querySelectorAll('.js-menu-open');
  var closeBtns = document.querySelectorAll('.js-menu-close');

  if (!overlay) return;

  openBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      overlay.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  });

  closeBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    });
  });

  overlay.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
})();

/* ─── INTERSECTION OBSERVER: SCROLL ANIMATIONS ─── */
(function () {
  var animated = document.querySelectorAll('.section-animate');
  if (!animated.length) return;

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  animated.forEach(function (el) { observer.observe(el); });
})();
