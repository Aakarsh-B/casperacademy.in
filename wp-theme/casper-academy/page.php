<?php get_header(); while (have_posts()) : the_post(); ?>
<main id="main">
  <article <?php post_class('article'); ?>>
    <header class="article__head">
      <div class="wrap wrap--article"><h1 class="article__title"><?php the_title(); ?></h1></div>
    </header>
    <div class="wrap wrap--article"><div class="prose"><?php the_content(); ?></div></div>
  </article>
</main>
<?php endwhile; get_footer(); ?>
