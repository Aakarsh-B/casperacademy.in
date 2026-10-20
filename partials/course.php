<?php
/*
 * Course page body. Each course file sets $course and includes this between the site header and footer.
 *   title, lead, image, image_alt, chips[]           hero
 *   intro[] (first paragraph is shown larger)        overview text
 *   facts[label => value]                             "at a glance" card
 *   features[] [title, text, list[]?]                 cards (optional)
 *   features_title                                    heading for the cards (optional)
 *   learn_title, learn[], learn_image                 checklist (optional)
 *   closing                                           paragraph after the cards (optional)
 *   calculator (bool)                                 IELTS band calculator
 *   achievers (test name: 'IELTS' / 'PTE' / null)     result posters
 */
$ACHIEVERS = require __DIR__ . '/../data/achievers.php';
$wa_text = rawurlencode("Hi, I'd like to know about " . $course['short'] . ' coaching');
?>
<main id="main">

  <section class="phero">
    <div class="wrap phero__inner">
      <div class="phero__text">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="/">Home</a>
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span aria-current="page"><?= e($course['short']) ?></span>
        </nav>
        <h1 class="phero__title"><?= e($course['title']) ?></h1>
        <p class="phero__lead"><?= e($course['lead']) ?></p>
        <div class="phero__actions">
          <a class="btn btn--red" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="btn btn--outline" href="https://api.whatsapp.com/send?phone=918136835444&amp;text=<?= $wa_text ?>" target="_blank" rel="noopener">WhatsApp us</a>
        </div>
      </div>
      <div class="phero__media">
        <img src="<?= e($course['image']) ?>" alt="<?= e($course['image_alt']) ?>" width="1400" height="1100">
<?php if (!empty($course['chips'])): ?>
        <ul class="phero__chips" aria-label="Course highlights">
<?php foreach ($course['chips'] as $chip): ?>
          <li><?= e($chip) ?></li>
<?php endforeach; ?>
        </ul>
<?php endif; ?>
      </div>
    </div>
  </section>

  <section class="section overview">
    <div class="wrap overview__inner">
      <div class="overview__text">
<?php foreach ($course['intro'] as $i => $para): ?>
        <p<?= $i === 0 ? ' class="overview__first"' : '' ?>><?= e($para) ?></p>
<?php endforeach; ?>
      </div>
      <aside class="facts" aria-label="At a glance">
        <dl>
<?php foreach ($course['facts'] as $label => $value): ?>
          <div><dt><?= e($label) ?></dt><dd><?= e($value) ?></dd></div>
<?php endforeach; ?>
        </dl>
        <a class="btn btn--red" href="/contact">Join Now</a>
      </aside>
    </div>
  </section>

<?php if (!empty($course['features'])): ?>
  <section class="section features">
    <div class="wrap">
<?php if (!empty($course['features_title'])): ?>
      <h2 class="h2 features__title"><?= e($course['features_title']) ?></h2>
<?php endif; ?>
      <ul class="features__grid">
<?php foreach ($course['features'] as $f): ?>
        <li class="feature">
          <h3 class="feature__title"><?= e($f['title']) ?></h3>
          <p><?= e($f['text']) ?></p>
<?php if (!empty($f['list'])): ?>
          <ul class="feature__list">
<?php foreach ($f['list'] as $item): ?>
            <li><?= $item /* trusted markup: <strong> labels */ ?></li>
<?php endforeach; ?>
          </ul>
<?php endif; ?>
        </li>
<?php endforeach; ?>
      </ul>
<?php if (!empty($course['closing'])): ?>
      <p class="features__closing"><?= e($course['closing']) ?></p>
<?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<?php if (!empty($course['learn'])): ?>
  <section class="section learn">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2"><?= e($course['learn_title'] ?? 'You will learn') ?></h2>
<?php if (!empty($course['learn_image'])): ?>
        <img class="learn__photo" src="<?= e($course['learn_image']) ?>" alt="" loading="lazy" width="1000" height="800">
<?php endif; ?>
      </header>
      <ul class="learn__list">
<?php foreach ($course['learn'] as $item): ?>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12.5 4.5 4.5L19 7.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg><span><?= e($item) ?></span></li>
<?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endif; ?>

<?php if (!empty($course['calculator'])) include __DIR__ . '/calculator.php'; ?>

<?php
$list = array_values(array_filter($ACHIEVERS, fn($a) => empty($course['achievers']) ? false : $a[2] === $course['achievers']));
if ($list) include __DIR__ . '/achievers.php';
?>

  <section class="section cta">
    <div class="wrap">
      <div class="cta__card">
        <h2 class="h2 h2--light"><?= e($course['cta'] ?? 'Join the Best Institute for IELTS Preparation') ?></h2>
        <div class="cta__actions">
          <a class="btn btn--white" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="cta__link" href="mailto:casperacademy006@gmail.com">casperacademy006@gmail.com</a>
        </div>
      </div>
    </div>
  </section>

</main>
