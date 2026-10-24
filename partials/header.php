<?php
/*
 * Shared <head> and site header.
 * Set $page before including:
 *   title, description, path (e.g. '/ielts'), nav (active menu key),
 *   image (social preview, optional), preload (hero image, optional; preload_width and preload_sizes describe it),
 *   header ('overlay' only for pages with a dark photo hero; default is the solid white header),
 *   schema (array of extra JSON-LD, optional)
 */
$site = 'https://www.casperacademy.in';
$page += ['image' => '/assets/img/photos/hero.jpg', 'preload' => null, 'preload_width' => 1400, 'preload_sizes' => '(min-width: 53.75em) 45vw, 100vw', 'header' => 'solid', 'schema' => [], 'noindex' => false];
require_once __DIR__ . '/helpers.php';
$GLOBALS['page'] = $page; // shared parts read it via page_opt(), even when included from a function
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
<?php $set = srcset($page['preload'], $page['preload_width']); ?>
  <link rel="preload" as="image" href="<?= $page['preload'] ?>"<?php if ($set): ?> imagesrcset="<?= $set ?>" imagesizes="<?= $page['preload_sizes'] ?>"<?php endif; ?> fetchpriority="high">
<?php endif; ?>
  <link rel="preload" href="/assets/fonts/fraunces-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/figtree-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="stylesheet" href="/assets/css/style.css?v=4">
<?php foreach ($page['schema'] as $schema): ?>
  <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endforeach; ?>
<?php include __DIR__ . '/meta-pixel.php'; ?>
</head>
<body id="top">

<?php include __DIR__ . '/site-header.php'; ?>
