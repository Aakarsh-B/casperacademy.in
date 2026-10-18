<?php
$ACHIEVERS = require __DIR__ . '/data/achievers.php';
$photos = [
  ['/assets/img/gallery/class-2.jpg', 'Students studying in a Casper Academy classroom', 1400, 1050],
  ['/assets/img/photos/academy-2.jpg', 'Students working through study material together', 1200, 900],
  ['/assets/img/photos/academy-3.jpg', 'A trainer guiding a class', 1200, 900],
  ['/assets/img/photos/academy-1.jpg', 'A class in session', 1200, 900],
  ['/assets/img/gallery/class-1.jpg', 'A Casper Academy classroom with blue chairs and writing desks', 1280, 960],
  ['/assets/img/gallery/class-3.jpg', 'The Thevannathu Building on S.A. Road, Vyttila, home of Casper Academy', 1087, 816],
];
$page = [
  'title' => 'Gallery | Casper Academy of Excellence, Vyttila, Kochi',
  'description' => 'Photos of Casper Academy of Excellence classrooms in Vyttila, Kochi, and the IELTS and PTE results of our students.',
  'path' => '/gallery',
  'nav' => 'gallery',
  'image' => '/assets/img/gallery/class-2.jpg',
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">
  <section class="phero phero--compact">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span aria-current="page">Gallery</span>
      </nav>
      <h1 class="phero__title">Gallery</h1>
    </div>
  </section>

  <section class="section gallery">
    <div class="wrap">
      <h2 class="h2 gallery__title">Our classrooms</h2>
      <ul class="gallery__grid">
<?php foreach ($photos as $i => [$src, $alt, $w, $h]): ?>
        <li><button class="gallery__item" type="button" data-lightbox="<?= e($src) ?>" data-alt="<?= e($alt) ?>" aria-label="View larger: <?= e($alt) ?>">
          <img src="<?= e($src) ?>" alt="" loading="<?= $i < 2 ? 'eager' : 'lazy' ?>" width="<?= $w ?>" height="<?= $h ?>">
        </button></li>
<?php endforeach; ?>
      </ul>

      <h2 class="h2 gallery__title">Our Achievers</h2>
      <ul class="gallery__grid gallery__grid--square">
<?php foreach ($ACHIEVERS as [$slug, $name, $test, $overall, $s]):
  $alt = "$name, $test overall $overall. Listening {$s[0]}, Reading {$s[1]}, Writing {$s[2]}, Speaking {$s[3]}."; ?>
        <li><button class="gallery__item" type="button" data-lightbox="/assets/img/achievers/<?= $slug ?>.jpg" data-alt="<?= e($alt) ?>" aria-label="View larger: <?= e($alt) ?>">
          <img src="/assets/img/achievers/<?= $slug ?>.jpg" alt="" loading="lazy" width="640" height="640">
        </button></li>
<?php endforeach; ?>
      </ul>
    </div>
  </section>

  <dialog class="lightbox" id="lightbox" aria-label="Photo viewer">
    <form method="dialog"><button class="lightbox__close" aria-label="Close photo viewer">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </button></form>
    <img class="lightbox__img" src="" alt="">
    <p class="lightbox__caption"></p>
  </dialog>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
