/**
 * Nakładka menu w nagłówku (#qbatura-menu): otwieranie/zamykanie, Esc, focus trap,
 * powrót fokusu do przycisku „Menu”. Przeniesione z html_design/assets/scripts.js.
 */
(function () {
  var overlay = document.getElementById('qbatura-menu');
  var openBtns = document.querySelectorAll('.js-menu-open');
  var closeBtns = document.querySelectorAll('.js-menu-close');
  var lastTrigger = null;

  if (!overlay) return;

  function getFocusable() {
    return overlay.querySelectorAll('a[href], button:not([disabled])');
  }

  function setExpanded(value) {
    openBtns.forEach(function (btn) {
      btn.setAttribute('aria-expanded', value);
    });
  }

  function onKeydown(event) {
    if (event.key === 'Escape') {
      closeMenu(true);
      return;
    }

    // Focus trap: Tab / Shift+Tab krąży wewnątrz otwartego menu.
    if (event.key !== 'Tab') return;

    var focusable = getFocusable();
    var first = focusable[0];
    var last = focusable[focusable.length - 1];

    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  }

  function openMenu(trigger) {
    lastTrigger = trigger;
    overlay.classList.add('is-open');
    document.documentElement.classList.add('qbatura-menu-is-open');
    setExpanded('true');
    document.addEventListener('keydown', onKeydown);

    var closeBtn = overlay.querySelector('.js-menu-close');
    if (closeBtn) closeBtn.focus();
  }

  function closeMenu(restoreFocus) {
    overlay.classList.remove('is-open');
    document.documentElement.classList.remove('qbatura-menu-is-open');
    setExpanded('false');
    document.removeEventListener('keydown', onKeydown);

    if (restoreFocus && lastTrigger) lastTrigger.focus();
  }

  openBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      openMenu(btn);
    });
  });

  closeBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      closeMenu(true);
    });
  });

  overlay.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      closeMenu(false);
    });
  });
})();
