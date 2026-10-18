(function () {
  var header = document.getElementById('header');
  var nav = document.getElementById('nav');
  var burger = document.getElementById('burger');

  // Solid header once the page scrolls past the top
  function onScroll() {
    header.classList.toggle('is-solid', window.scrollY > 24);
  }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu
  function setMenu(open) {
    nav.classList.toggle('is-open', open);
    header.classList.toggle('menu-open', open);
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  }
  burger.addEventListener('click', function () {
    setMenu(burger.getAttribute('aria-expanded') !== 'true');
  });
  nav.querySelectorAll('a').forEach(function (a) {
    a.addEventListener('click', function () { setMenu(false); });
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      setMenu(false);
      document.querySelectorAll('.nav__has-sub.is-open').forEach(closeSub);
    }
  });

  // Courses dropdown (click / keyboard; hover handled in CSS on desktop)
  function closeSub(li) {
    li.classList.remove('is-open');
    li.querySelector('.nav__sub-toggle').setAttribute('aria-expanded', 'false');
  }
  document.querySelectorAll('.nav__has-sub').forEach(function (li) {
    var toggle = li.querySelector('.nav__sub-toggle');
    toggle.addEventListener('click', function () {
      var open = !li.classList.contains('is-open');
      li.classList.toggle('is-open', open);
      toggle.setAttribute('aria-expanded', String(open));
    });
    document.addEventListener('click', function (e) {
      if (!li.contains(e.target)) closeSub(li);
    });
  });

  // Count-up for hero stats, once, on load
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reduce) {
    document.querySelectorAll('.count').forEach(function (el) {
      var to = parseInt(el.dataset.to, 10);
      var start = null;
      var dur = 1600;
      el.textContent = '0';
      function tick(t) {
        if (!start) start = t;
        var p = Math.min((t - start) / dur, 1);
        var eased = 1 - Math.pow(1 - p, 3);
        el.textContent = String(Math.round(to * eased));
        if (p < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    });
  }
})();
