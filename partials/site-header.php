<?php
// Site header markup. Used by partials/header.php and the WordPress blog theme. Reads page settings via page_opt().
require_once __DIR__ . '/helpers.php';
?>
<a class="skip" href="#main">Skip to content</a>

<!-- ============ Header ============ -->
<?php
// Two header styles: 'overlay' (transparent over the homepage hero, turns white on scroll)
// and 'solid' (white, used on every other page and the default).
$header_style = page_opt('header') === 'overlay' ? 'header--overlay' : 'header--solid is-solid';
?>
<header class="header <?= $header_style ?>" id="header">
  <div class="wrap header__inner">
    <a class="brand" href="/" aria-label="Casper Academy of Excellence home">
      <img class="brand__light" src="/assets/img/logo-white.png" alt="Casper Academy of Excellence" width="278" height="103">
      <img class="brand__dark" src="/assets/img/logo.png" alt="" width="278" height="103">
    </a>

    <nav class="nav" id="nav" aria-label="Main">
      <ul class="nav__list">
        <li><a href="/"<?= nav_current('home') ?>>Home</a></li>
        <li><a href="/about"<?= nav_current('about') ?>>About</a></li>
        <li class="nav__has-sub">
          <button class="nav__sub-toggle<?= in_array(page_opt('nav'), ['ielts','pte','oet','english','german'], true) ? ' is-current' : '' ?>" aria-expanded="false" aria-controls="sub-courses">Courses
            <svg width="10" height="10" viewBox="0 0 10 10" aria-hidden="true"><path d="M2 3.5 5 6.5 8 3.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </button>
          <ul class="nav__sub" id="sub-courses">
            <li><a href="/ielts"<?= nav_current('ielts') ?>>IELTS</a></li>
            <li><a href="/pte"<?= nav_current('pte') ?>>PTE</a></li>
            <li><a href="/oet"<?= nav_current('oet') ?>>OET</a></li>
            <li><a href="/communicative-english"<?= nav_current('english') ?>>Communicative English</a></li>
            <li><a href="/german-language"<?= nav_current('german') ?>>German Language</a></li>
          </ul>
        </li>
        <li><a href="/gallery"<?= nav_current('gallery') ?>>Gallery</a></li>
        <li><a href="/essay"<?= nav_current('essay') ?>>Essays</a></li>
        <li><a href="/blog/"<?= nav_current('blog') ?>>Blog</a></li>
        <li class="nav__cta-item"><a class="btn btn--red btn--sm" href="/contact"<?= nav_current('contact') ?>>Contact</a></li>
      </ul>
    </nav>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav">
      <span></span><span></span>
    </button>
  </div>
</header>
