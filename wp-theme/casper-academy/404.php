<?php get_header(); ?>
<main id="main" class="notfound">
  <div class="wrap">
    <h1 class="h2">Page not found</h1>
    <p class="lead">The article you're looking for has moved or doesn't exist.</p>
    <div class="notfound__actions">
      <a class="btn btn--red" href="<?= esc_url(home_url('/')) ?>">See all articles</a>
      <a class="btn btn--outline" href="<?= esc_url(site_root_url()) ?>/">Go to homepage</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
