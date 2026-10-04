/**
 * Animacja wejścia sekcji z klasą .qbatura-reveal (IntersectionObserver).
 * Bez IntersectionObserver lub przy prefers-reduced-motion: reduce — wszystko widoczne od razu.
 */
(function () {
  var animated = document.querySelectorAll('.qbatura-reveal:not(.is-visible)');
  if (!animated.length) return;

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
