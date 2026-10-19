<?php
/*
 * Builds the whole website as plain HTML into dist/ for Cloudflare Pages.
 * Run from anywhere:  php tools/build.php
 * The GitHub Action (.github/workflows/deploy.yml) runs this on every push to main.
 *
 * - Site pages: every *.php in the root, rendered once (STATIC_BUILD is defined, so contact.php
 *   uses FormSubmit instead of PHP mail()).
 * - Blog: content/blog/*.json rendered with tools/blog.php at the same addresses WordPress used.
 * - _redirects keeps every old address working (it replaces .htaccess).
 */
define('STATIC_BUILD', true);
error_reporting(E_ALL);
set_error_handler(function ($no, $msg, $file, $line) {
  if (!(error_reporting() & $no)) return false;   // warnings silenced with @
  throw new ErrorException($msg, 0, $no, $file, $line);
});

$root = dirname(__DIR__);
$out = "$root/dist";
require __DIR__ . '/blog.php';

function rrmdir($dir) {
  if (!is_dir($dir)) return;
  foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $f) {
    $f->isDir() ? rmdir($f) : unlink($f);
  }
  rmdir($dir);
}
function copy_dir($from, $to) {
  if (!is_dir($from)) return;
  foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($from, FilesystemIterator::SKIP_DOTS)) as $f) {
    $dest = $to . substr($f->getPathname(), strlen($from));
    @mkdir(dirname($dest), 0777, true);
    copy($f->getPathname(), $dest);
  }
}
function write($path, $content) {
  @mkdir(dirname($path), 0777, true);
  file_put_contents($path, $content);
}

rrmdir($out);
mkdir($out);

// 1. Static files
copy_dir("$root/assets", "$out/assets");
copy_dir("$root/blog", "$out/blog");          // blog images (old WordPress uploads + new ones)
foreach (array_merge(['favicon.ico', 'robots.txt'], array_map('basename', glob("$root/google*.html"))) as $f) {
  copy("$root/$f", "$out/$f");
}

// 2. Site pages
$pages = [];
foreach (glob("$root/*.php") as $file) {
  $name = basename($file, '.php');
  if ($name === 'router') continue;
  $page = null;
  ob_start();
  (function () use ($file) { include $file; })();
  write("$out/$name.html", ob_get_clean());
  if (!in_array($name, ['404'], true)) $pages[] = $name === 'index' ? '/' : "/$name";
  echo "$name.html\n";
}

// 3. Blog
$posts = blog_load_posts($root);
$cat_list = json_decode(file_get_contents("$root/content/blog-categories.json"), true);
$cat_names = array_column($cat_list, 'name', 'slug');
$tag_names = json_decode(file_get_contents("$root/content/blog-tags.json"), true);
$count = fn($key, $slug) => count(array_filter($posts, fn($p) => in_array($slug, $p[$key], true)));

// Category chips: up to 8 categories with posts, most posts first (as WordPress listed them)
$chips = array_values(array_filter($cat_list, fn($c) => $count('categories', $c['slug']) > 0));
usort($chips, fn($a, $b) => $count('categories', $b['slug']) <=> $count('categories', $a['slug']));
$chips = array_slice($chips, 0, 8);

$archive = function ($list, $base, $name, $current_cat, $body_class, $seo) use ($root, $posts, $chips, $out) {
  $total = max(1, (int) ceil(count($list) / BLOG_PER_PAGE));
  for ($n = 1; $n <= $total; $n++) {
    $path = $n === 1 ? $base : "{$base}page/$n/";
    $m = $seo($n, $total) + ['path' => $path];
    $main = blog_archive($root, $posts, array_slice($list, ($n - 1) * BLOG_PER_PAGE, BLOG_PER_PAGE), $n, $total, $base, $name, $current_cat, $chips);
    $bc = $body_class . ($n > 1 ? " paged paged-$n" : '') . ' wp-custom-logo wp-embed-responsive wp-theme-casper-academy';
    write("$out$path" . 'index.html', blog_page($root, $m, $bc, $main));
  }
  return $total;
};

$home_seo = json_decode(file_get_contents("$root/content/blog-home.json"), true);
$archive($posts, '/blog/', 'Blogs', null, 'blog', fn($n) => ['title' => $home_seo['seo_title'], 'description' => $home_seo['seo_description']]);

$archives = 1;
foreach ($cat_list as $c) {
  $list = array_values(array_filter($posts, fn($p) => in_array($c['slug'], $p['categories'], true)));
  if (!$list) continue;
  $archives += $archive($list, "/blog/category/{$c['slug']}/", $c['name'], $c['slug'], "archive category category-{$c['slug']}",
    fn($n, $t) => ['title' => $c['name'] . ' Archives' . ($n > 1 ? " - Page $n of $t" : '') . ' - Blogs', 'description' => $c['description'] ?? '']);
}
// Every tag WordPress had keeps its page (even with no posts left), plus any new ones
$used_tags = array_unique(array_merge(array_keys($tag_names), ...array_column($posts, 'tags')));
foreach ($used_tags as $t) {
  $list = array_values(array_filter($posts, fn($p) => in_array($t, $p['tags'], true)));
  $tname = $tag_names[$t] ?? ucwords(str_replace('-', ' ', $t));
  $archives += $archive($list, "/blog/tag/$t/", $tname, null, "archive tag tag-$t",
    fn($n, $tot) => ['title' => $tname . ' Archives' . ($n > 1 ? " - Page $n of $tot" : '') . ' - Blogs']);
}

foreach ($posts as $p) {
  $seo_title = trim($p['seo']['title'] ?? '') ?: $p['title'] . ' - Blogs';
  $og = $p['wp']['og_image'] ?? [];
  $image = $p['image'] ? ['url' => $og['url'] ?? SITE . $p['image'], 'width' => $og['width'] ?? $p['img_w'], 'height' => $og['height'] ?? $p['img_h']] : null;
  $m = [
    'path' => $p['url'], 'title' => $seo_title, 'description' => trim($p['seo']['description'] ?? '') ?: $p['excerpt'],
    'type' => 'article', 'image' => $image, 'author' => $p['author'],
    'published' => blog_iso($p), 'modified' => gmdate('Y-m-d\TH:i:sP', strtotime(($p['modified'] ?? $p['date']) . ' UTC')),
    'schema' => blog_post_schema($p),
  ];
  $bc = 'wp-singular post-template-default single single-post single-format-' . ($p['wp']['format'] ?? 'standard') . ' wp-custom-logo wp-embed-responsive wp-theme-casper-academy';
  write("$out{$p['url']}index.html", blog_page($root, $m, $bc, blog_single($p, $posts, $cat_names)));
}
echo count($posts) . " blog posts, $archives archive pages\n";

// Search index for /blog/?s= (assets/js/blog-search.js renders the results)
write("$out/blog/search.json", json_encode(array_map(fn($p) => [
  'u' => $p['url'], 't' => $p['title'], 'e' => $p['excerpt'], 'x' => mb_substr(blog_text($p['content']), 0, 4000),
  'c' => blog_card($p),
], $posts), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// RSS feed
$items = '';
foreach (array_slice($posts, 0, 20) as $p) {
  $items .= "  <item>\n    <title>" . h($p['title']) . "</title>\n    <link>" . SITE . $p['url'] . "</link>\n    <guid>" . SITE . $p['url'] . "</guid>\n"
    . '    <pubDate>' . gmdate(DATE_RSS, $p['time']) . "</pubDate>\n    <description>" . h($p['excerpt']) . "</description>\n  </item>\n";
}
write("$out/blog/feed.xml", "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<rss version=\"2.0\">\n<channel>\n  <title>Casper Academy of Excellence blog</title>\n  <link>" . SITE . "/blog/</link>\n  <description>IELTS, PTE and English tips from Casper Academy of Excellence, Kochi</description>\n$items</channel>\n</rss>\n");

// Sitemap: site pages, blog home, categories and posts
$today = gmdate('Y-m-d');
$urls = array_map(fn($p) => [SITE . $p, $today], $pages);
$urls[] = [SITE . '/blog/', $posts ? gmdate('Y-m-d', $posts[0]['time']) : $today];
foreach ($chips as $c) $urls[] = [SITE . "/blog/category/{$c['slug']}/", $today];
foreach ($posts as $p) $urls[] = [SITE . $p['url'], substr($p['modified'] ?? $p['date'], 0, 10)];
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
foreach ($urls as [$loc, $mod]) $xml .= "  <url><loc>" . h($loc) . "</loc><lastmod>$mod</lastmod></url>\n";
write("$out/sitemap.xml", $xml . "</urlset>\n");

// Redirects (Cloudflare Pages _redirects) and headers
copy("$root/_redirects", "$out/_redirects");
$extra = '';
foreach ($pages as $p) if ($p !== '/') $extra .= "$p.php $p 301\n";
file_put_contents("$out/_redirects", "\n# Old .php addresses (generated)\n$extra", FILE_APPEND);
copy("$root/_headers", "$out/_headers");

// Cloudflare Workers config (the deploy runs `npx wrangler deploy` in dist/); not served as a file
copy("$root/wrangler.jsonc", "$out/wrangler.jsonc");
file_put_contents("$out/.assetsignore", "wrangler.jsonc\n.assetsignore\n.nojekyll\n");

echo "Built into dist/\n";
