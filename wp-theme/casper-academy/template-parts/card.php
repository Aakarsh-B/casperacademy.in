<?php $cat = casper_primary_category(); ?>
<article <?php post_class('bcard'); ?>>
  <a class="bcard__link" href="<?php the_permalink(); ?>">
    <div class="bcard__media">
      <?php if (has_post_thumbnail()) : the_post_thumbnail('casper-card', ['loading' => 'lazy', 'alt' => '']); else : ?>
        <span class="bcard__placeholder" aria-hidden="true"></span>
      <?php endif; ?>
    </div>
    <div class="bcard__body">
      <p class="bcard__meta">
        <time datetime="<?= esc_attr(get_the_date('c')) ?>"><?= esc_html(get_the_date('j M Y')) ?></time>
        <span><?= casper_reading_time() ?> min read</span>
      </p>
      <h3 class="bcard__title"><?php the_title(); ?></h3>
      <p class="bcard__excerpt"><?= esc_html(get_the_excerpt()) ?></p>
    </div>
  </a>
</article>
