<?php
// Local preview only (php -S localhost:8000 router.php). Mimics .htaccess rule 5 and the 404 page.
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && is_file(__DIR__ . $path)) return false;
$slug = trim($path, '/');
if ($slug === '') { include __DIR__ . '/index.php'; return; }
if (preg_match('/^[a-z0-9-]+$/', $slug) && is_file(__DIR__ . "/$slug.php")) { include __DIR__ . "/$slug.php"; return; }
http_response_code(404);
include __DIR__ . '/404.php';
