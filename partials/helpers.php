<?php
// Shared by the site pages and the WordPress blog theme.
// Page settings: $page on the site pages, $casper_page inside WordPress (which uses $page itself).
if (!function_exists('page_opt')) {
  function page_opt($key, $default = null) {
    $p = $GLOBALS['casper_page'] ?? $GLOBALS['page'] ?? [];
    return is_array($p) && array_key_exists($key, $p) ? $p[$key] : $default;
  }
}
if (!function_exists('nav_current')) {
  function nav_current($key) {
    return page_opt('nav') === $key ? ' aria-current="page"' : '';
  }
}
if (!function_exists('e')) {
  function e($s) { return htmlspecialchars($s, ENT_QUOTES); }
}
