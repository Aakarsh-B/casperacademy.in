<?php
/*
 * Builds a static HTML copy of the site into /preview for the GitHub Pages link
 * (GitHub Pages can't run PHP). Hostinger serves the real PHP pages; this is only for previews.
 * Run from the repo root:  php tools/build-preview.php
 */
$root = dirname(__DIR__);
$out = "$root/preview";
@mkdir($out);
array_map('unlink', glob("$out/*.html"));

$pages = [];
foreach (glob("$root/*.php") as $file) {
  $name = basename($file, '.php');
  if ($name !== 'router') $pages[] = $name;
}
$built = array_flip($pages);

foreach ($pages as $name) {
  $page = null;
  ob_start();
  (function () use ($root, $name) { include "$root/$name.php"; })();
  $html = ob_get_clean();

  // Root-absolute links -> paths that work from /preview on GitHub Pages
  $html = preg_replace_callback('#(href|src)="/([^"]*)"#', function ($m) use ($built) {
    [$all, $attr, $path] = $m;
    if (str_starts_with($path, 'assets/') || $path === 'favicon.ico') return "$attr=\"../$path\"";
    if (str_starts_with($path, 'blog')) return "$attr=\"https://www.casperacademy.in/$path\"";
    if ($path === '') return "$attr=\"index.html\"";
    [$slug, $hash] = array_pad(explode('#', $path, 2), 2, null);
    $slug = trim($slug, '/');
    if (isset($built[$slug])) return "$attr=\"$slug.html" . ($hash ? "#$hash" : '') . '"';
    return "$attr=\"404.html\"";
  }, $html);
  // Keep the preview out of Google; the real site is www.casperacademy.in
  $html = str_replace('<meta charset="utf-8">', "<meta charset=\"utf-8\">\n  <meta name=\"robots\" content=\"noindex\">", $html);

  file_put_contents("$out/$name.html", $html);
  echo "preview/$name.html\n";
}
