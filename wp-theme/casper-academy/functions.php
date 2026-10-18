<?php
/**
 * Casper Academy blog theme.
 * Shares header/footer markup and the stylesheet with the main site in the folder above WordPress.
 */

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
  add_theme_support('responsive-embeds');
  add_theme_support('align-wide');
  add_image_size('casper-card', 720, 450, true);
  add_image_size('casper-hero', 1400, 788, true);
});

/** The main site's URL (the blog lives one level down, at /blog/). */
function site_root_url() {
  return preg_replace('#/blog/?$#', '', untrailingslashit(home_url()));
}

/** Main-site asset URL, e.g. /assets/css/style.css. */
function casper_asset($path) {
  return site_root_url() . $path;
}

add_action('wp_enqueue_scripts', function () {
  $v = wp_get_theme()->get('Version');
  wp_enqueue_style('casper-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Figtree:wght@400;500;600;700&display=swap', [], null);
  wp_enqueue_style('casper-site', casper_asset('/assets/css/style.css'), [], $v);
  wp_enqueue_style('casper-blog', get_template_directory_uri() . '/blog.css', ['casper-site'], $v);
  wp_enqueue_script('casper-site', casper_asset('/assets/js/main.js'), [], $v, true);
  // Block library styles are kept so existing posts render as they do today.
});

add_filter('wp_resource_hints', function ($urls, $type) {
  if ($type === 'preconnect') {
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
  }
  return $urls;
}, 10, 2);

/**
 * Include a shared part (site-header / site-footer) from the main site's /partials folder,
 * so the blog and the website always show the same header and footer.
 * The main site must be deployed in the folder above WordPress.
 */
function casper_part($name) {
  // WordPress owns the global $page, so the shared parts read $casper_page here.
  $GLOBALS['casper_page'] = ['nav' => 'blog', 'header' => 'solid'];
  $file = dirname(untrailingslashit(ABSPATH)) . "/partials/$name.php";
  if (file_exists($file)) {
    include $file;
  } elseif (current_user_can('edit_theme_options')) {
    echo '<p style="padding:120px 24px 0">Casper Academy theme: upload the main website first (missing ' . esc_html($file) . ').</p>';
  }
}

/** Excerpt length and ending. */
add_filter('excerpt_length', function () { return 26; });
add_filter('excerpt_more', function () { return '…'; });

/** Reading time in minutes. */
function casper_reading_time($post = null) {
  $words = str_word_count(wp_strip_all_tags(get_post_field('post_content', $post)));
  return max(1, (int) round($words / 220));
}

/** First category of a post, or null. */
function casper_primary_category($post = null) {
  $cats = get_the_category($post);
  return $cats ? $cats[0] : null;
}

/**
 * Accessible headings inside posts: drop empty headings, and when a post uses h3 as its
 * top level (no h2), lift every heading one level so the outline goes h1 > h2 > h3.
 * Only changes the output; the saved post is untouched.
 */
add_filter('the_content', function ($html) {
  $html = preg_replace('#<h([1-6])[^>]*>(\s|&nbsp;|<br\s*/?>)*</h\1>#i', '', $html);
  if (stripos($html, '<h2') === false && stripos($html, '<h3') !== false) {
    $html = preg_replace_callback('#<(/?)h([3-6])\b#i', function ($m) {
      return '<' . $m[1] . 'h' . ($m[2] - 1);
    }, $html);
  }
  return $html;
}, 20);

/** Comment form title as h2 so it follows the article's h1 in order. */
add_filter('comment_form_defaults', function ($d) {
  $d['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
  $d['title_reply_after'] = '</h2>';
  return $d;
});
