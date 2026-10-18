<?php
get_header();
while (have_posts()) : the_post();
  $cat = casper_primary_category();
?>
<main id="main">
  <article <?php post_class('article'); ?>>
    <header class="article__head">
      <div class="wrap">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="<?= esc_url(site_root_url()) ?>/">Home</a>
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <a href="<?= esc_url(home_url('/')) ?>">Blog</a>
          <?php if ($cat) : ?>
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <a href="<?= esc_url(get_category_link($cat)) ?>"><?= esc_html($cat->name) ?></a>
          <?php endif; ?>
        </nav>
        <h1 class="article__title"><?php the_title(); ?></h1>
        <p class="article__meta">
          <?php if (get_the_author()) : ?><span>By <?php the_author(); ?></span><?php endif; ?>
          <time datetime="<?= esc_attr(get_the_date('c')) ?>"><?= esc_html(get_the_date('j F Y')) ?></time>
          <span><?= casper_reading_time() ?> min read</span>
        </p>
      </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
      <div class="wrap article__hero">
        <?php the_post_thumbnail('casper-hero', ['alt' => esc_attr(get_the_title())]); ?>
      </div>
    <?php endif; ?>

    <div class="wrap article__layout">
      <div class="article__main">
        <div class="prose">
          <?php the_content(); ?>
          <?php wp_link_pages(); ?>
        </div>
        <nav class="article__pager" aria-label="More articles">
          <?php
          $prev = get_previous_post();
          $next = get_next_post();
          if ($prev) : ?>
            <a class="article__pager-prev" href="<?= esc_url(get_permalink($prev)) ?>"><small>Previous</small><?= esc_html(get_the_title($prev)) ?></a>
          <?php endif;
          if ($next) : ?>
            <a class="article__pager-next" href="<?= esc_url(get_permalink($next)) ?>"><small>Next</small><?= esc_html(get_the_title($next)) ?></a>
          <?php endif; ?>
        </nav>
        <?php if (comments_open() || get_comments_number()) comments_template(); ?>
      </div>

      <aside class="article__aside">
        <div class="aside-cta">
          <p class="aside-cta__title">Join the Best Institute for IELTS Preparation</p>
          <a class="btn btn--white" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="aside-cta__link" href="https://api.whatsapp.com/send?phone=918136835444&amp;text=Hi" target="_blank" rel="noopener">WhatsApp us</a>
        </div>
        <?php
        $recent = new WP_Query(['posts_per_page' => 5, 'post__not_in' => [get_the_ID()], 'ignore_sticky_posts' => true, 'no_found_rows' => true]);
        if ($recent->have_posts()) : ?>
          <div class="aside-list">
            <p class="aside-list__title">Recent posts</p>
            <ul>
              <?php while ($recent->have_posts()) : $recent->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><time datetime="<?= esc_attr(get_the_date('c')) ?>"><?= esc_html(get_the_date('j M Y')) ?></time></li>
              <?php endwhile; wp_reset_postdata(); ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php get_search_form(); ?>
      </aside>
    </div>

  </article>

  <?php
  $related = $cat ? new WP_Query(['cat' => $cat->term_id, 'posts_per_page' => 3, 'post__not_in' => [get_the_ID()], 'ignore_sticky_posts' => true, 'no_found_rows' => true]) : null;
  if ($related && $related->have_posts()) : ?>
    <section class="section related">
      <div class="wrap">
        <h2 class="h2">Keep reading</h2>
        <div class="bgrid">
          <?php while ($related->have_posts()) : $related->the_post(); get_template_part('template-parts/card'); endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php
endwhile;
get_footer();
