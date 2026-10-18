(function () {
  var header = document.getElementById('header');
  var nav = document.getElementById('nav');
  var burger = document.getElementById('burger');

  // Solid header once the page scrolls past the top
  var alwaysSolid = header.classList.contains('is-fixed-solid');
  function onScroll() {
    header.classList.toggle('is-solid', alwaysSolid || window.scrollY > 24);
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

  // IELTS score calculator: average of four bands, rounded to the nearest half band
  // (.25 rounds up to .5, .75 rounds up to the next whole band)
  var calc = document.getElementById('calc');
  if (calc) {
    var result = document.getElementById('calc-result');
    calc.addEventListener('submit', function (e) {
      e.preventDefault();
      var inputs = calc.querySelectorAll('input');
      var total = 0;
      var bad = [];
      inputs.forEach(function (input) {
        var v = parseFloat(input.value);
        var ok = input.value !== '' && v >= 0 && v <= 9 && (v * 2) % 1 === 0;
        input.setAttribute('aria-invalid', String(!ok));
        if (ok) total += v; else bad.push(input.name);
      });
      result.classList.toggle('is-error', bad.length > 0);
      if (bad.length) {
        result.textContent = 'Enter a band from 0 to 9 in steps of 0.5 for ' + bad.join(', ') + '.';
        return;
      }
      var band = Math.floor((total / 4) * 4 + 0.0001) / 4;   // quarter steps
      band = (band % 1 === 0.25 || band % 1 === 0.75) ? band + 0.25 : band;
      result.innerHTML = 'Overall band <strong>' + band.toFixed(1).replace('.0', '') + '</strong>';
    });
  }

  // Achievers carousel buttons
  var track = document.getElementById('achievers');
  if (track) {
    document.querySelectorAll('[data-scroll]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var card = track.querySelector('.achiever');
        var step = card ? card.getBoundingClientRect().width + 16 : 300;
        track.scrollBy({ left: step * parseInt(btn.dataset.scroll, 10) * 2, behavior: reduce ? 'auto' : 'smooth' });
      });
    });
  }
})();
