/* ─── INDEX: SCREEN 1 → 2 TOGGLE ─── */
/* „Wejście” to link do #screen-2 — bez JS przewija do menu, z JS przełącza ekrany. */
(function () {
  var screen1 = document.getElementById('screen-1');
  var screen2 = document.getElementById('screen-2');
  var enterBtn = document.getElementById('enter-btn');

  if (enterBtn && screen1 && screen2) {
    enterBtn.addEventListener('click', function (event) {
      event.preventDefault();
      screen1.classList.add('is-hidden');
      screen2.classList.add('is-shown');

      // Zapamiętanie wejścia — przy kolejnej wizycie od razu ekran menu (S1).
      try {
        localStorage.setItem('qbatura-entered', '1');
      } catch (e) {}

      // Fokus na pierwszą pozycję menu, żeby użytkownik klawiatury nie został na ukrytym ekranie.
      var firstLink = screen2.querySelector('.s2-menu a');
      if (firstLink) {
        firstLink.focus({ preventScroll: true });
      }
    });
  }
})();

/* ─── MOBILE OVERLAY MENU ─── */
(function () {
  var overlay = document.getElementById('mobile-menu');
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
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    setExpanded('true');
    document.addEventListener('keydown', onKeydown);

    var closeBtn = overlay.querySelector('.js-menu-close');
    if (closeBtn) closeBtn.focus();
  }

  function closeMenu(restoreFocus) {
    overlay.classList.remove('open');
    document.body.style.overflow = '';
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

/* ─── INTERSECTION OBSERVER: SCROLL ANIMATIONS ─── */
(function () {
  var animated = document.querySelectorAll('.section-animate:not(.is-visible)');
  if (!animated.length) return;

  // Bez IntersectionObserver lub przy ograniczonym ruchu — pokaż wszystko od razu.
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!('IntersectionObserver' in window) || reduceMotion) {
    animated.forEach(function (el) { el.classList.add('is-visible'); });
    return;
  }

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

/* ─── REALIZACJE: FILTR KATEGORII ─── */
/* Symulacja archiwum kategorii: realizacje.html?kategoria=<slug>. „Wszystkie” lub ponowne kliknięcie aktywnej kategorii pokazuje całą listę. */
(function () {
  var grid = document.querySelector('.js-projects');
  if (!grid || !window.URLSearchParams) return;

  var category = new URLSearchParams(window.location.search).get('kategoria');
  if (!category) return;

  // „Wszystkie” przestaje być aktywne, gdy wybrano kategorię.
  var allLink = document.querySelector('.js-filter-all');
  if (allLink) allLink.removeAttribute('aria-current');

  document.querySelectorAll('.js-filter').forEach(function (link) {
    if (link.getAttribute('data-category') === category) {
      link.setAttribute('aria-current', 'page');
      link.setAttribute('href', 'realizacje.html');
    }
  });

  // Karty spoza kategorii są usuwane z DOM, żeby linie siatki (:nth-child) liczyły się poprawnie.
  var shown = 0;
  grid.querySelectorAll('.project-card').forEach(function (card) {
    if (card.getAttribute('data-category') === category) {
      shown++;
    } else {
      card.parentNode.removeChild(card);
    }
  });

  var empty = document.querySelector('.js-projects-empty');
  if (empty) empty.hidden = shown > 0;
})();

/* ─── DEMO FORM ─── */
/* Formularz w wersji HTML nic nie wysyła; pokazuje tylko komunikat po wysłaniu (K5). */
(function () {
  document.querySelectorAll('.js-demo-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      var status = form.querySelector('.js-form-status');
      if (status) status.hidden = false;
      form.reset();
    });
  });
})();
