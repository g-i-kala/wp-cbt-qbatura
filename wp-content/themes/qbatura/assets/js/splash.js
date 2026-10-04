/**
 * Strona główna: ekran 1 → ekran 2.
 * „Wejście” to link do #screen-2 — bez JS przewija do menu, z JS przełącza ekrany.
 * Przeniesione z html_design/assets/scripts.js.
 */
(function () {
  var screen1 = document.getElementById('screen-1');
  var screen2 = document.getElementById('screen-2');
  var enterBtn = document.querySelector('.js-splash-enter');

  if (!enterBtn || !screen1 || !screen2) return;

  enterBtn.addEventListener('click', function (event) {
    event.preventDefault();
    screen1.classList.add('is-hidden');
    screen2.classList.add('is-shown');

    // Zapamiętanie wejścia — przy kolejnej wizycie od razu ekran menu (S1).
    try {
      localStorage.setItem('qbatura-entered', '1');
    } catch (e) {}

    // Fokus na pierwszą pozycję menu, żeby użytkownik klawiatury nie został na ukrytym ekranie.
    var firstLink = screen2.querySelector('.wp-block-navigation-item__content');
    if (firstLink) {
      firstLink.focus({ preventScroll: true });
    }
  });
})();
