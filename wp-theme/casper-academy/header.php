<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= esc_url(site_root_url()) ?>/favicon.ico" sizes="any">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= esc_url(site_root_url()) ?>/assets/img/favicon-32.png">
  <link rel="apple-touch-icon" href="<?= esc_url(site_root_url()) ?>/assets/img/apple-touch-icon.png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">
<?php wp_body_open(); ?>
<?php casper_part('site-header'); ?>
