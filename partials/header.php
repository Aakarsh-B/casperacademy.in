<?php
/*
 * Shared <head> and site header.
 * Set $page before including:
 *   title, description, path (e.g. '/ielts'), nav (active menu key),
 *   image (social preview, optional), preload (hero image, optional),
 *   solid (true for pages without a dark hero), schema (array of extra JSON-LD, optional)
 */
$site = 'https://www.casperacademy.in';
$page += ['image' => '/assets/img/photos/hero.jpg', 'preload' => null, 'solid' => false, 'schema' => [], 'noindex' => false];
function nav_current($key) {
  global $page;
  return ($page['nav'] ?? '') === $key ? ' aria-current="page"' : '';
}
function e($s) { return htmlspecialchars($s, ENT_QUOTES); }
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page['title']) ?></title>
  <meta name="description" content="<?= e($page['description']) ?>">
<?php if ($page['noindex']): ?>
  <meta name="robots" content="noindex">
<?php endif; ?>
  <link rel="canonical" href="<?= $site . $page['path'] ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Casper Academy of Excellence">
  <meta property="og:title" content="<?= e($page['title']) ?>">
  <meta property="og:description" content="<?= e($page['description']) ?>">
  <meta property="og:url" content="<?= $site . $page['path'] ?>">
  <meta property="og:image" content="<?= $site . $page['image'] ?>">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/favicon-192.png">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
<?php if ($page['preload']): ?>
  <link rel="preload" as="image" href="<?= $page['preload'] ?>">
<?php endif; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css?v=3">
<?php foreach ($page['schema'] as $schema): ?>
  <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endforeach; ?>
</head>
<body id="top">

<a class="skip" href="#main">Skip to content</a>

<!-- ============ Header ============ -->
<header class="header<?= !empty($page['solid']) ? ' is-solid is-fixed-solid' : '' ?>" id="header">
  <div class="wrap header__inner">
    <a class="brand" href="/" aria-label="Casper Academy of Excellence home">
      <img class="brand__light" src="/assets/img/logo-white.png" alt="Casper Academy of Excellence" width="278" height="103">
      <img class="brand__dark" src="/assets/img/logo.png" alt="" width="278" height="103">
    </a>

    <nav class="nav" id="nav" aria-label="Main">
      <ul class="nav__list">
        <li><a href="/"<?= nav_current('home') ?>>Home</a></li>
        <li><a href="/about"<?= nav_current('about') ?>>About</a></li>
        <li class="nav__has-sub">
          <button class="nav__sub-toggle<?= in_array($page['nav'] ?? '', ['ielts','pte','oet','english','german']) ? ' is-current' : '' ?>" aria-expanded="false" aria-controls="sub-courses">Courses
            <svg width="10" height="10" viewBox="0 0 10 10" aria-hidden="true"><path d="M2 3.5 5 6.5 8 3.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </button>
          <ul class="nav__sub" id="sub-courses">
            <li><a href="/ielts">IELTS</a></li>
            <li><a href="/pte">PTE</a></li>
            <li><a href="/oet">OET</a></li>
            <li><a href="/communicative-english">Communicative English</a></li>
            <li><a href="/german-language">German Language</a></li>
          </ul>
        </li>
        <li><a href="/services"<?= nav_current('services') ?>>Services</a></li>
        <li><a href="/gallery"<?= nav_current('gallery') ?>>Gallery</a></li>
        <li><a href="/essay"<?= nav_current('essay') ?>>Essay</a></li>
        <li><a href="/faq"<?= nav_current('faq') ?>>FAQ</a></li>
        <li><a href="/blog/"<?= nav_current('blog') ?>>Blog</a></li>
        <li class="nav__cta-item"><a class="btn btn--red btn--sm" href="/contact">Contact</a></li>
      </ul>
    </nav>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav">
      <span></span><span></span>
    </button>
  </div>
</header>
