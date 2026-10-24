<?php
/*
 * Blog templates for the static build (tools/build.php).
 * Same markup as the old WordPress theme (casper-academy), so the blog looks exactly as it did.
 * Posts live in content/blog/*.json and are edited with Pages CMS (see .pages.yml).
 */

const SITE = 'https://www.casperacademy.in';
const BLOG_PER_PAGE = 10;
const BLOG_ROBOTS = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
const CRUMB_ARROW = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';

function h($s) { return htmlspecialchars((string) $s, ENT_QUOTES); }

/** Load posts, newest first, with the values the templates need. */
function blog_load_posts($root) {
  $posts = [];
  foreach (glob("$root/content/blog/*.json") as $file) {
    $p = json_decode(file_get_contents($file), true);
    if (!$p || empty($p['slug']) || !empty($p['draft'])) continue;
    $p += ['author' => '', 'categories' => [], 'tags' => [], 'image' => '', 'excerpt' => '', 'seo' => [], 'wp' => []];
    $p['time'] = strtotime($p['date'] . ' UTC');
    $p['url'] = "/blog/{$p['slug']}/";
    // Imported posts keep WordPress's reading time until their text is edited
    $p['minutes'] = isset($p['wp']['minutes'], $p['wp']['content_md5']) && md5($p['content']) === $p['wp']['content_md5']
      ? $p['wp']['minutes'] : blog_reading_time($p['content']);
    if (trim($p['excerpt']) === '') $p['excerpt'] = blog_auto_excerpt($p['content']);
    [$p['img_w'], $p['img_h']] = blog_image_size($root, $p);
    $posts[] = $p;
  }
  usort($posts, fn($a, $b) => $b['time'] <=> $a['time'] ?: strcmp($b['slug'], $a['slug']));
  return $posts;
}

function blog_text($html) {
  return trim(html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
}

/** Minutes to read, as the old theme counted them (220 words a minute). */
function blog_reading_time($html) {
  return max(1, (int) round(str_word_count(strip_tags($html)) / 220));
}

/** First 26 words, like WordPress excerpts. */
function blog_auto_excerpt($html) {
  $words = preg_split('/\s+/', blog_text(preg_replace('#<(script|style)\b.*?</\1>#is', '', $html)), -1, PREG_SPLIT_NO_EMPTY);
  return count($words) > 26 ? implode(' ', array_slice($words, 0, 26)) . '…' : implode(' ', $words);
}

function blog_image_size($root, $p) {
  if (!empty($p['wp']['image_width'])) return [$p['wp']['image_width'], $p['wp']['image_height']];
  $file = $root . rawurldecode($p['image']);
  if ($p['image'] && is_file($file) && ($s = @getimagesize($file))) return [$s[0], $s[1]];
  return [0, 0];
}

/** Fit an image inside a box without upscaling (WordPress wp_constrain_dimensions). */
function blog_fit($w, $h, $maxw, $maxh) {
  if (!$w || !$h || ($w <= $maxw && $h <= $maxh)) return [$w, $h];
  $r = min($maxw / $w, $maxh / $h);
  $nw = max(1, (int) round($w * $r)); $nh = max(1, (int) round($h * $r));
  // WordPress nudges by a pixel when rounding lands on the box edge from the other side
  if ($nw > $maxw) $nw = $maxw;
  if ($nh > $maxh) $nh = $maxh;
  return [$nw, $nh];
}

/** Featured image tag: 'casper-card' (720x450, lazy) or 'casper-hero' (1400x788). */
function blog_thumb($p, $size) {
  if (!$p['image']) return '';
  $card = $size === 'casper-card';
  [$w, $h] = $card ? ($p['wp']['card_size'] ?? blog_fit($p['img_w'], $p['img_h'], 720, 450))
                   : ($p['wp']['hero_size'] ?? blog_fit($p['img_w'], $p['img_h'], 1400, 788));
  $attrs = ($w ? "width=\"$w\" height=\"$h\" " : '') . 'src="' . h($p['image']) . "\" class=\"attachment-$size size-$size wp-post-image\" alt=\"" . ($card ? '' : h($p['title'])) . '"';
  $attrs .= $card ? ' loading="lazy" decoding="async"' : ' decoding="async" fetchpriority="high"';
  $srcset = (!$card && isset($p['wp']['hero_srcset'])) ? $p['wp']['hero_srcset'] : ($p['wp']['image_srcset'] ?? '');
  if ($srcset !== '') $attrs .= ' srcset="' . h($srcset) . '" sizes="' . ($card ? 'auto, ' : '') . "(max-width: {$w}px) 100vw, {$w}px\"";
  return "<img $attrs />";
}

function blog_post_class($p, $extra) {
  $c = [$extra, 'post-' . ($p['wp']['id'] ?? $p['slug']), 'post', 'type-post', 'status-publish', 'format-' . ($p['wp']['format'] ?? 'standard')];
  if ($p['image']) $c[] = 'has-post-thumbnail';
  $c[] = 'hentry';
  foreach ($p['categories'] as $s) $c[] = "category-$s";
  foreach ($p['tags'] as $s) $c[] = "tag-$s";
  $format = $p['wp']['format'] ?? 'standard';
  if ($format !== 'standard') $c[] = "post_format-post-format-$format";
  // Imported posts: keep WordPress's class order while the categories and tags are unchanged
  $wp = $p['wp']['class_list'] ?? null;
  if ($wp) {
    $a = array_values(array_filter(array_slice($c, 1), fn($x) => !str_starts_with($x, 'post_format-'))); $b = $wp; sort($a); sort($b);
    if ($a === $b) return implode(' ', array_merge([$extra], $wp, $format !== 'standard' ? ["post_format-post-format-$format"] : []));
  }
  return implode(' ', $c);
}

function blog_date($p, $format) { return gmdate($format, $p['time']); }
function blog_iso($p) { return gmdate('Y-m-d\TH:i:sP', $p['time']); }

function blog_card($p, $heading = 'h2') {
  ob_start(); ?>
<article class="<?= h(blog_post_class($p, 'bcard')) ?>">
  <a class="bcard__link" href="<?= h($p['url']) ?>">
    <div class="bcard__media">
      <?php if ($p['image']) : echo blog_thumb($p, 'casper-card'); else : ?>
        <span class="bcard__placeholder" aria-hidden="true"></span>
      <?php endif; ?>
    </div>
    <div class="bcard__body">
      <p class="bcard__meta">
        <time datetime="<?= blog_iso($p) ?>"><?= blog_date($p, 'j M Y') ?></time>
        <span><?= $p['minutes'] ?> min read</span>
      </p>
      <<?= $heading ?> class="bcard__title"><?= h($p['title']) ?></<?= $heading ?>>
      <p class="bcard__excerpt"><?= h($p['excerpt']) ?></p>
    </div>
  </a>
</article>
<?php return ob_get_clean();
}

function blog_searchform() {
  return '<form role="search" method="get" class="bsearch" action="/blog/">
  <label class="screen-reader-text" for="bsearch-1">Search the blog</label>
  <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
  <input type="search" name="s" value="" placeholder="Search articles">
</form>';
}

/** Page links, like WordPress the_posts_pagination() with mid_size 1. */
function blog_pagination($current, $total, $base) {
  if ($total < 2) return '';
  $url = fn($n) => $n === 1 ? $base : "{$base}page/$n/";
  $links = [];
  if ($current > 1) $links[] = '<a class="prev page-numbers" href="' . $url($current - 1) . '">Previous</a>';
  $dots = false;
  for ($n = 1; $n <= $total; $n++) {
    if ($n === $current) {
      $links[] = "<span aria-current=\"page\" class=\"page-numbers current\">$n</span>"; $dots = true;
    } elseif ($n <= 1 || ($n >= $current - 1 && $n <= $current + 1) || $n > $total - 1) {
      $links[] = "<a class=\"page-numbers\" href=\"{$url($n)}\">$n</a>"; $dots = true;
    } elseif ($dots) {
      $links[] = '<span class="page-numbers dots">&hellip;</span>'; $dots = false;
    }
  }
  if ($current < $total) $links[] = '<a class="next page-numbers" href="' . $url($current + 1) . '">Next</a>';
  return "\n\t<nav class=\"navigation bpager\" aria-label=\"Posts pagination\">\n\t\t<h2 class=\"screen-reader-text\">Posts pagination</h2>\n\t\t<div class=\"nav-links\">" . implode("\n", $links) . "</div>\n\t</nav>";
}

/** <head>, site header, then the page body, then site footer. $m holds the SEO values. */
function blog_page($root, $m, $body_class, $main) {
  $m += ['type' => 'website', 'image' => null, 'published' => null, 'modified' => null, 'author' => '', 'minutes' => null, 'schema' => null];
  $canonical = SITE . $m['path'];
  ob_start(); ?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
  <meta name='robots' content='<?= BLOG_ROBOTS ?>' />
	<title><?= h($m['title']) ?></title>
<?php if (!empty($m['description'])) : ?>
	<meta name="description" content="<?= h($m['description']) ?>" />
<?php endif; ?>
	<link rel="canonical" href="<?= h($canonical) ?>" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="<?= $m['type'] ?>" />
	<meta property="og:title" content="<?= h($m['title']) ?>" />
<?php if (!empty($m['description'])) : ?>
	<meta property="og:description" content="<?= h($m['description']) ?>" />
<?php endif; ?>
	<meta property="og:url" content="<?= h($canonical) ?>" />
	<meta property="og:site_name" content="Blogs" />
<?php if ($m['published']) : ?>
	<meta property="article:published_time" content="<?= $m['published'] ?>" />
	<meta property="article:modified_time" content="<?= $m['modified'] ?>" />
<?php endif; ?>
<?php if ($m['image']) : ?>
	<meta property="og:image" content="<?= h($m['image']['url']) ?>" />
<?php if (!empty($m['image']['width'])) : ?>
	<meta property="og:image:width" content="<?= $m['image']['width'] ?>" />
	<meta property="og:image:height" content="<?= $m['image']['height'] ?>" />
<?php endif; ?>
<?php endif; ?>
<?php if ($m['author']) : ?>
	<meta name="author" content="<?= h($m['author']) ?>" />
<?php endif; ?>
	<meta name="twitter:card" content="summary_large_image" />
<?php if ($m['author']) : ?>
	<meta name="twitter:label1" content="Written by" />
	<meta name="twitter:data1" content="<?= h($m['author']) ?>" />
<?php endif; ?>
<?php if ($m['schema']) : ?>
	<script type="application/ld+json"><?= json_encode($m['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>
<link rel="preload" href="/assets/fonts/fraunces-latin.woff2" as="font" type="font/woff2" crossorigin />
<link rel="preload" href="/assets/fonts/figtree-latin.woff2" as="font" type="font/woff2" crossorigin />
<link rel="alternate" type="application/rss+xml" title="Casper Academy blog" href="/blog/feed.xml" />
<?php readfile("$root/partials/blog-wp-styles.html"); ?>
<link rel='stylesheet' id='casper-site-css' href='/assets/css/style.css?ver=1.1.0' media='all' />
<link rel='stylesheet' id='casper-blog-css' href='/assets/css/blog.css?ver=1.0.0' media='all' />
<link rel="icon" href="/blog/wp-content/uploads/2021/09/logo-shortcut.png" sizes="32x32" />
<link rel="icon" href="/blog/wp-content/uploads/2021/09/logo-shortcut.png" sizes="192x192" />
<link rel="apple-touch-icon" href="/blog/wp-content/uploads/2021/09/logo-shortcut.png" />
<?php include "$root/partials/meta-pixel.php"; ?>
</head>
<body class="<?= h($body_class) ?>" id="top">
<?php
  $GLOBALS['casper_page'] = ['nav' => 'blog', 'header' => 'solid'];
  include "$root/partials/site-header.php";
  echo $main;
  include "$root/partials/site-footer.php";
?>
<script id="casper-site-js" src="/assets/js/main.js?ver=1.1.0"></script>
<script src="/assets/js/blog-search.js?ver=1.0.0" defer></script>
</body>
</html>
<?php return ob_get_clean();
}

/** Blog home, category and tag archives (index.php in the old theme). */
function blog_archive($root, $all, $list, $page, $total_pages, $base, $title, $current_cat, $cats) {
  $is_home = $base === '/blog/';
  ob_start(); ?>
<main id="main">
  <section class="bhero">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <?= CRUMB_ARROW ?>
        <?php if ($is_home && $page === 1) : ?>
          <span aria-current="page">Blog</span>
        <?php else : ?>
          <a href="/blog/">Blog</a>
        <?php endif; ?>
      </nav>
      <div class="bhero__row">
        <h1 class="phero__title"><?= h($title) ?></h1>
        <?= blog_searchform() ?>
      </div>
      <?php if ($cats) : ?>
        <ul class="chips" aria-label="Categories">
          <li><a href="/blog/"<?= $is_home ? ' aria-current="page"' : '' ?>>All</a></li>
          <?php foreach ($cats as $c) : ?>
            <li><a href="/blog/category/<?= h($c['slug']) ?>/"<?= $current_cat === $c['slug'] ? ' aria-current="page"' : '' ?>><?= h($c['name']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </section>

  <section class="section blist">
    <div class="wrap">
      <?php if ($list) : ?>
        <div class="bgrid">
          <?php foreach ($list as $p) echo blog_card($p); ?>
        </div>
        <?= blog_pagination($page, $total_pages, $base) ?>
      <?php else : ?>
        <div class="bempty">
          <h2 class="h2">No articles found</h2>
          <p class="lead">Try a different search, or browse all articles.</p>
          <a class="btn btn--red" href="/blog/">See all articles</a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php return ob_get_clean();
}

/** One article (single.php in the old theme). */
function blog_single($p, $all, $cat_names) {
  $i = array_search($p['slug'], array_column($all, 'slug'), true);
  $prev = $all[$i + 1] ?? null;   // older
  $next = $all[$i - 1] ?? null;   // newer
  $cat = $p['categories'][0] ?? null;
  $others = array_values(array_filter($all, fn($o) => $o['slug'] !== $p['slug']));
  $recent = array_slice($others, 0, 5);
  $related = $cat ? array_slice(array_values(array_filter($others, fn($o) => in_array($cat, $o['categories'], true))), 0, 3) : [];
  ob_start(); ?>
<main id="main">
  <article class="<?= h(blog_post_class($p, 'article')) ?>">
    <header class="article__head">
      <div class="wrap">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="/">Home</a>
          <?= CRUMB_ARROW ?>
          <a href="/blog/">Blog</a>
          <?php if ($cat) : ?>
            <?= CRUMB_ARROW ?>
            <a href="/blog/category/<?= h($cat) ?>/"><?= h($cat_names[$cat] ?? $cat) ?></a>
          <?php endif; ?>
        </nav>
        <h1 class="article__title"><?= h($p['title']) ?></h1>
        <p class="article__meta">
          <?php if ($p['author']) : ?><span>By <?= h($p['author']) ?></span><?php endif; ?>
          <time datetime="<?= blog_iso($p) ?>"><?= blog_date($p, 'j F Y') ?></time>
          <span><?= $p['minutes'] ?> min read</span>
        </p>
      </div>
    </header>

    <?php if ($p['image']) : ?>
      <div class="wrap article__hero">
        <?= blog_thumb($p, 'casper-hero') ?>
      </div>
    <?php endif; ?>

    <div class="wrap article__layout">
      <div class="article__main">
        <div class="prose">
          <?= $p['content'] ?>
        </div>
        <nav class="article__pager" aria-label="More articles">
          <?php if ($prev) : ?>
            <a class="article__pager-prev" href="<?= h($prev['url']) ?>"><small>Previous</small><?= h($prev['title']) ?></a>
          <?php endif;
          if ($next) : ?>
            <a class="article__pager-next" href="<?= h($next['url']) ?>"><small>Next</small><?= h($next['title']) ?></a>
          <?php endif; ?>
        </nav>
      </div>

      <div class="article__aside">
        <div class="aside-cta">
          <p class="aside-cta__title">Join the Best Institute for IELTS Preparation</p>
          <a class="btn btn--white" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="aside-cta__link" href="https://api.whatsapp.com/send?phone=918136835444&amp;text=Hi" target="_blank" rel="noopener">WhatsApp us</a>
        </div>
        <?php if ($recent) : ?>
          <div class="aside-list">
            <p class="aside-list__title">Recent posts</p>
            <ul>
              <?php foreach ($recent as $r) : ?>
                <li><a href="<?= h($r['url']) ?>"><?= h($r['title']) ?></a><time datetime="<?= blog_iso($r) ?>"><?= blog_date($r, 'j M Y') ?></time></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?= blog_searchform() ?>
      </div>
    </div>

  </article>

  <?php if ($related) : ?>
    <section class="section related">
      <div class="wrap">
        <h2 class="h2">Keep reading</h2>
        <div class="bgrid">
          <?php foreach ($related as $r) echo blog_card($r, 'h3'); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php return ob_get_clean();
}

function blog_post_schema($p) {
  $url = SITE . $p['url'];
  return [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $p['title'],
    'mainEntityOfPage' => $url,
    'url' => $url,
    'datePublished' => blog_iso($p),
    'dateModified' => gmdate('Y-m-d\TH:i:sP', strtotime(($p['modified'] ?? $p['date']) . ' UTC')),
    'image' => $p['image'] ? SITE . $p['image'] : null,
    'author' => $p['author'] ? ['@type' => 'Person', 'name' => $p['author']] : ['@id' => SITE . '/#organization'],
    'publisher' => ['@id' => SITE . '/#organization'],
    'description' => $p['seo']['description'] ?? $p['excerpt'],
  ];
}
