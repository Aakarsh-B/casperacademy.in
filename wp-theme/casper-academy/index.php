<?php
/* Blog home, category and tag archives, search results. */
get_header();

if (is_search()) {
  $title = 'Search: ' . get_search_query();
} elseif (is_category() || is_tag()) {
  $title = single_term_title('', false);
} elseif (is_author()) {
  $title = get_the_author();
} else {
  $title = 'Blogs';
}
$current_cat = is_category() ? get_queried_object_id() : 0;
$cats = get_categories(['orderby' => 'count', 'order' => 'DESC', 'number' => 8, 'hide_empty' => true]);
?>
<main id="main">
  <section class="bhero">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="<?= esc_url(site_root_url()) ?>/">Home</a>
        <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?php if (is_home() && !is_paged()) : ?>
          <span aria-current="page">Blog</span>
        <?php else : ?>
          <a href="<?= esc_url(home_url('/')) ?>">Blog</a>
        <?php endif; ?>
      </nav>
      <div class="bhero__row">
        <h1 class="phero__title"><?= esc_html($title) ?></h1>
        <?php get_search_form(); ?>
      </div>
      <?php if ($cats && !is_search()) : ?>
        <ul class="chips" aria-label="Categories">
          <li><a href="<?= esc_url(home_url('/')) ?>"<?= is_home() ? ' aria-current="page"' : '' ?>>All</a></li>
          <?php foreach ($cats as $c) : ?>
            <li><a href="<?= esc_url(get_category_link($c)) ?>"<?= $current_cat === $c->term_id ? ' aria-current="page"' : '' ?>><?= esc_html($c->name) ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </section>

  <section class="section blist">
    <div class="wrap">
      <?php if (have_posts()) : ?>
        <div class="bgrid">
          <?php while (have_posts()) : the_post(); get_template_part('template-parts/card'); endwhile; ?>
        </div>
        <?php
        the_posts_pagination([
          'mid_size' => 1,
          'prev_text' => 'Previous',
          'next_text' => 'Next',
          'class' => 'bpager',
        ]);
        ?>
      <?php else : ?>
        <div class="bempty">
          <h2 class="h2">No articles found</h2>
          <p class="lead">Try a different search, or browse all articles.</p>
          <a class="btn btn--red" href="<?= esc_url(home_url('/')) ?>">See all articles</a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
