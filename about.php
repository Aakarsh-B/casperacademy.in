<?php
$page = [
  'title' => 'About Casper Academy of Excellence | IELTS Coaching Kochi',
  'description' => 'Casper academy of excellence is renowned for delivering successful services in coaching to assist our clients in establishing their bright educational as well as work career on the global platform.',
  'path' => '/about',
  'nav' => 'about',
  'image' => '/assets/img/photos/about-hero.jpg',
  'preload' => '/assets/img/photos/about-hero.jpg',
];
$teach = [
  ['Personalized coaching', 'Our teachers leave no stone unturned to polish you. Personal attention is given to all the students in all the modules.'],
  ['Structural speaking sessions', 'Our well planned speaking sessions will help you to boost your confidence and performance.'],
  ['Group discussion', 'Group discussion and group reading are additional interactive sessions to unleash your learning skills.'],
  ['Intensive course structure', 'The course structure has been designed with precision to help you attain your target score.'],
  ['Easy tips', 'Easy tips and strategies to crack the international language test.'],
  ['Continuous assessment', 'During the course students are continuously assessed by our experts who adapt their classes to the needs of individual student.'],
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">

  <section class="phero">
    <div class="wrap phero__inner">
      <div class="phero__text">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="/">Home</a>
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span aria-current="page">About</span>
        </nav>
        <h1 class="phero__title">We ensure better education for your better future</h1>
        <p class="phero__lead">Casper academy of excellence is renowned for delivering successful services in coaching to assist our clients in establishing their bright educational as well as work career on the global platform.</p>
        <div class="phero__actions">
          <a class="btn btn--red" href="/contact">Contact us</a>
          <a class="btn btn--outline" href="/gallery">See our classrooms</a>
        </div>
      </div>
      <div class="phero__media">
        <img src="/assets/img/photos/about-hero.jpg" alt="Students smiling as they work together around a laptop" width="1400" height="1100">
      </div>
    </div>
  </section>

  <div class="wrap">
    <dl class="stats stats--flat">
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><path d="M16 5 3 11l13 6 13-6-13-6Zm-8 9v6c0 2 3.6 4 8 4s8-2 8-4v-6M27 12v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"/></svg>
        <dt>Students Registered</dt><dd>18000 +</dd>
      </div>
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><circle cx="16" cy="13" r="7" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m11.5 18.5-2 9 6.5-3 6.5 3-2-9" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
        <dt>Years of Experience</dt><dd>25 +</dd>
      </div>
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><path d="m16 4 3.6 7.4 8.1 1.2-5.9 5.7 1.4 8.1L16 22.6l-7.2 3.8 1.4-8.1-5.9-5.7 8.1-1.2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
        <dt>Desired score</dt><dd>100 %</dd>
      </div>
    </dl>
  </div>

  <section class="section about-story">
    <div class="wrap about__inner">
      <div class="about__photos">
        <img class="about__photo about__photo--main" src="/assets/img/photos/academy-2.jpg" alt="Students working through study material together at Casper Academy" loading="lazy" width="1200" height="900">
        <img class="about__photo about__photo--small" src="/assets/img/photos/academy-1.jpg" alt="A class in session at Casper Academy" loading="lazy" width="1200" height="900">
      </div>
      <div class="about__text">
        <h2 class="about__title">Casper Academy of Excellence<br>Best IELTS Coaching in Kochi</h2>
        <p class="about__first">Pioneers with over 25 years of experience in the industry enable us to develop the most efficient set of strategies made with purpose of achieving targeted band scores in IELTS and PTE.</p>
        <p>Our commitment to excellence and unparalleled dedication of trainers to go the extra mile assist you to ensure full learning satisfaction.</p>
        <p>Our intensive and rigorous practice sessions empowers you to crack the international exams in the 1st attempt and achieve top scores.</p>
      </div>
    </div>
  </section>

  <section class="section features">
    <div class="wrap">
      <h2 class="h2 features__title">How we teach</h2>
      <ul class="features__grid features__grid--3">
<?php foreach ($teach as [$t, $d]): ?>
        <li class="feature">
          <h3 class="feature__title"><?= e($t) ?></h3>
          <p><?= e($d) ?></p>
        </li>
<?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="section testimonials">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">Our Testimonials</h2>
        <p class="lead">We are proud to share a selection of our favourite stories with you here. Students who join us become part of our team.</p>
      </header>
<?php include __DIR__ . '/partials/testimonials.php'; ?>
    </div>
  </section>

  <section class="section cta">
    <div class="wrap">
      <div class="cta__card">
        <h2 class="h2 h2--light">Start your Journey. Start with excellence.</h2>
        <div class="cta__actions">
          <a class="btn btn--white" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="cta__link" href="mailto:casperacademy006@gmail.com">casperacademy006@gmail.com</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
