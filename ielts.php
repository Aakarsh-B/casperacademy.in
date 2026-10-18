<?php
$achievers = [
  ['vishnu-mc', 'Vishnu M C', 'IELTS', '7.5', [8, 8.5, 7, 7]],
  ['aashima-parvathi-poudhar', 'Aashima Parvathi Poudhar', 'IELTS', '8', [8.5, 9, 7, 7.5]],
  ['ronal-thomas', 'Ronal Thomas', 'IELTS', '8', [9, 8, 6.5, 9]],
  ['joji-kuruvilla', 'Joji Kuruvilla', 'IELTS', '8', [8.5, 9, 7, 7.5]],
  ['lakshmi-madhu', 'Lakshmi Madhu', 'IELTS', '8', [9, 7.5, 7, 7]],
  ['dr-sushil', 'Dr. Sushil', 'IELTS', '8', [9, 8, 7, 7]],
  ['sanu-palliyambil-kurien', 'Sanu Palliyambil Kurien', 'PTE', '90', [90, 90, 87, 90]],
  ['padmapriya-nandakumar', 'Padmapriya Nandakumar', 'IELTS', '7.5', [8, 8, 7, 7]],
  ['ipsita', 'Ipsita', 'IELTS', '7.5', [8.5, 7, 7.5, 7]],
  ['don-antony', 'Don Antony', 'IELTS', '7.5', [9, 7.5, 6.5, 7.5]],
  ['nithya-valsan', 'Nithya Valsan', 'IELTS', '7.5', [8.5, 8, 7, 7]],
];

$learn = [
  'To accurately use Academic English in writing',
  'To express yourself fluently across a range of topics using appropriate linking words',
  'To build vocabulary and good essay structure',
  'Exam strategies and techniques for the test',
  'A holistic approach to IELTS preparation, you will learn grammar in addition to the core skills of reading, writing, listening & speaking.',
  'Weekly IELTS practice test in simulated conditions to reinforce learning and highlight areas requiring improvement.',
  'Experienced IELTS teachers to help you achieve the best result in the shortest possible time.',
  'Exclusive study materials if you require a score of 7.0 or higher',
  'Participate in informal conversations, formal discussions and structured role plays in the classroom as well as plan and produce an oral presentation.',
  'Detailed individual feedback',
  'Practice test and exam preparation throughout',
];

$page = [
  'title' => 'Best IELTS Training in Kochi | IELTS Coaching Kochi',
  'description' => 'Enrol for IELTS Coaching in Ernakulam, Kerala at Casper Academy of Excellence. Intensive training in every module with adequate mock tests in Listening, Reading, Writing and Speaking.',
  'path' => '/ielts',
  'nav' => 'ielts',
  'image' => '/assets/img/photos/ielts-hero.jpg',
  'preload' => '/assets/img/photos/ielts-hero.jpg',
  'schema' => [
    [
      '@context' => 'https://schema.org',
      '@type' => 'Course',
      'name' => 'IELTS Coaching in Kochi',
      'description' => 'Intensive IELTS training in every module with adequate mock tests in Listening, Reading, Writing and Speaking. Classes held offline in Vyttila, Kochi and online.',
      'provider' => ['@id' => 'https://www.casperacademy.in/#organization'],
      'hasCourseInstance' => [
        ['@type' => 'CourseInstance', 'courseMode' => 'Onsite', 'location' => 'Vyttila, Kochi'],
        ['@type' => 'CourseInstance', 'courseMode' => 'Online'],
      ],
    ],
    [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://www.casperacademy.in/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'IELTS', 'item' => 'https://www.casperacademy.in/ielts'],
      ],
    ],
  ],
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">

  <!-- ============ Page hero ============ -->
  <section class="phero">
    <div class="wrap phero__inner">
      <div class="phero__text">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="/">Home</a>
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span aria-current="page">IELTS</span>
        </nav>
        <h1 class="phero__title">IELTS Coaching in Kochi</h1>
        <p class="phero__lead">Enrol for IELTS Coaching in Ernakulam, Kerala at Casper Academy of Excellence and achieve a top band score. Rated as the best IELTS coaching in Kochi, we provide intensive training in every module with adequate mock tests in Listening, Reading, Writing and Speaking.</p>
        <div class="phero__actions">
          <a class="btn btn--red" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="btn btn--outline" href="https://api.whatsapp.com/send?phone=918136835444&amp;text=Hi%2C%20I%27d%20like%20to%20know%20about%20IELTS%20coaching" target="_blank" rel="noopener">WhatsApp us</a>
        </div>
      </div>
      <div class="phero__media">
        <img src="/assets/img/photos/ielts-hero.jpg" alt="A student smiling at her desk while preparing for IELTS" width="1400" height="1100">
        <ul class="phero__chips" aria-label="Course highlights">
          <li>British Council &amp; IDP partner</li>
          <li>Offline &amp; online classes</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- ============ Course overview ============ -->
  <section class="section overview">
    <div class="wrap overview__inner">
      <div class="overview__text">
        <p class="overview__first">Casper Academy of Excellence is a state of the art IELTS training centre in Kochi, equipped with authentic examination preparation papers from Cambridge University U.K. Training at Casper Academy of Excellence enables students to acquire high Band scores of 8 and above.</p>
        <p>Being the valued partners of British Council and IDP, our IELTS coaching programmes are designed to provide candidates sufficient practice and guaranteed results. Our customised and well planned IELTS training classes are held offline and online. Casper Academy of Excellence is the best IELTS training Institute in Kochi, Kerala that assist students with unique coaching techniques. Our One on One Online IELTS training equip students to take the IELTS test with ease.</p>
        <p>We are the only IELTS institute in Ernakulam, Kerala to conduct one on one speaking sessions, mock tests and on the spot Essay corrections, which makes us the best IELTS institute and most preferred IELTS coaching centre in Ernakulam, Kerala.</p>
        <p>This course is designed to guide you to pass the IELTS test on the first go. Along with preparing you for all the components tested (reading, writing, listening &amp; speaking). You will have the opportunity to gain skills and confidence in a small class with highly trained teachers and familiarize yourself with the IELTS test format in mock exams.</p>
      </div>

      <aside class="facts" aria-label="At a glance">
        <dl>
          <div><dt>Modules</dt><dd>Listening, Reading, Writing, Speaking</dd></div>
          <div><dt>Classes</dt><dd>Offline in Vyttila and online</dd></div>
          <div><dt>Speaking</dt><dd>One on one sessions</dd></div>
          <div><dt>Writing</dt><dd>On the spot essay corrections</dd></div>
          <div><dt>Practice</dt><dd>Weekly mock tests</dd></div>
        </dl>
        <a class="btn btn--red" href="/contact">Join Now</a>
      </aside>
    </div>
  </section>

  <!-- ============ You will learn ============ -->
  <section class="section learn">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">You will learn</h2>
        <img class="learn__photo" src="/assets/img/photos/ielts-study.jpg" alt="" loading="lazy" width="1000" height="800">
      </header>
      <ul class="learn__list">
<?php foreach ($learn as $item): ?>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12.5 4.5 4.5L19 7.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg><span><?= e($item) ?></span></li>
<?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- ============ Score calculator ============ -->
  <section class="section calc" id="score-calculator">
    <div class="wrap calc__inner">
      <div>
        <h2 class="h2 h2--light">Score Calculator</h2>
        <p class="calc__note">Enter your band for each module (0 to 9) to see your overall IELTS band.</p>
      </div>
      <form class="calc__form" id="calc" novalidate>
        <div class="calc__fields">
<?php foreach (['Listening', 'Reading', 'Writing', 'Speaking'] as $m): ?>
          <label class="calc__field">
            <span><?= $m ?></span>
            <input type="number" name="<?= strtolower($m) ?>" min="0" max="9" step="0.5" inputmode="decimal" placeholder="0 to 9" required>
          </label>
<?php endforeach; ?>
        </div>
        <div class="calc__foot">
          <button class="btn btn--red" type="submit">Calculate</button>
          <output class="calc__result" id="calc-result" aria-live="polite"></output>
        </div>
      </form>
    </div>
  </section>

  <!-- ============ Achievers ============ -->
  <section class="section achievers">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">Our Achievers</h2>
        <div class="achievers__nav">
          <button class="round-btn" type="button" data-scroll="-1" aria-label="Previous achievers"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 6-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
          <button class="round-btn" type="button" data-scroll="1" aria-label="Next achievers"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        </div>
      </header>
    </div>
    <ul class="achievers__track" id="achievers" tabindex="0" aria-label="Our Achievers, scroll sideways for more">
<?php foreach ($achievers as [$slug, $name, $test, $overall, $s]): ?>
      <li class="achiever">
        <img src="/assets/img/achievers/<?= $slug ?>.jpg" loading="lazy" width="640" height="640"
             alt="<?= e("$name, $test overall $overall. Listening {$s[0]}, Reading {$s[1]}, Writing {$s[2]}, Speaking {$s[3]}.") ?>">
        <p><strong><?= e($name) ?></strong><span><?= $test ?> overall <?= $overall ?></span></p>
      </li>
<?php endforeach; ?>
    </ul>
  </section>

  <!-- ============ CTA ============ -->
  <section class="section cta">
    <div class="wrap">
      <div class="cta__card">
        <h2 class="h2 h2--light">Join the Best Institute for IELTS Preparation</h2>
        <div class="cta__actions">
          <a class="btn btn--white" href="tel:+918136835444">Call +91 81 36 835 444</a>
          <a class="cta__link" href="mailto:info@casperacademy.in">info@casperacademy.in</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
