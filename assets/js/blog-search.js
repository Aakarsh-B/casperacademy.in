// Blog search for the static site: /blog/?s=words shows matching articles.
// Uses /blog/search.json, which tools/build.php writes with every build.
(function () {
  var q = new URLSearchParams(location.search).get('s');
  if (location.pathname !== '/blog/' || q === null) return;
  q = q.trim();

  document.querySelectorAll('.bsearch input[name="s"]').forEach(function (i) { i.value = q; });
  document.title = 'You searched for ' + q + ' - Blogs';
  var title = document.querySelector('.bhero .phero__title');
  if (title) title.textContent = 'Search: ' + q;
  var chips = document.querySelector('.bhero .chips');
  if (chips) chips.remove();
  var crumb = document.querySelector('.bhero .crumbs [aria-current="page"]');
  if (crumb) {
    var a = document.createElement('a');
    a.href = '/blog/'; a.textContent = 'Blog';
    crumb.replaceWith(a);
  }

  var wrap = document.querySelector('.blist .wrap');
  if (!wrap) return;
  wrap.innerHTML = '';

  fetch('/blog/search.json').then(function (r) { return r.json(); }).then(function (posts) {
    var words = q.toLowerCase().split(/\s+/).filter(Boolean);
    var hits = posts.filter(function (p) {
      var text = (p.t + ' ' + p.e + ' ' + p.x).toLowerCase();
      return words.every(function (w) { return text.indexOf(w) !== -1; });
    });
    if (hits.length) {
      wrap.innerHTML = '<div class="bgrid">' + hits.map(function (p) { return p.c; }).join('') + '</div>';
    } else {
      wrap.innerHTML = '<div class="bempty"><h2 class="h2">No articles found</h2>' +
        '<p class="lead">Try a different search, or browse all articles.</p>' +
        '<a class="btn btn--red" href="/blog/">See all articles</a></div>';
    }
  });
})();
