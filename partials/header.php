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
require_once __DIR__ . '/helpers.php';
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

<?php include __DIR__ . '/site-header.php'; ?>
