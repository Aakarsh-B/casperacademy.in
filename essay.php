<?php
$essays = json_decode(file_get_contents(__DIR__ . '/data/essays.json'), true);
$page = [
  'title' => 'IELTS Essay Topics With Answers | IELTS Essay Sample',
  'description' => 'IELTS Writing Task 2 essay topics with band 8 sample answers, plus a real student essay with our trainers\' corrections and band scores.',
  'path' => '/essay',
  'nav' => 'essay',
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">
  <section class="phero phero--compact">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span aria-current="page">IELTS Essays</span>
      </nav>
      <h1 class="phero__title">IELTS Essay Topics With Answers</h1>
      <p class="phero__lead">Writing Task 2 questions with band 8 sample answers. The first is a real student essay with our trainers' corrections and band scores.</p>
    </div>
  </section>

  <section class="section qa">
    <div class="wrap qa__wrap">
<?php foreach ($essays as $i => $q): ?>
      <details class="qa__item"<?= $i === 0 ? ' open' : '' ?>>
        <summary><h2 class="qa__q"><?= e($q['title']) ?></h2><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></summary>
        <div class="qa__a prose"><?= $q['html'] /* cleaned markup from data/essays.json */ ?></div>
      </details>
<?php endforeach; ?>
    </div>
  </section>

  <section class="section cta">
    <div class="wrap">
      <div class="cta__card">
        <h2 class="h2 h2--light">Get your essays corrected on the spot</h2>
        <div class="cta__actions">
          <a class="btn btn--white" href="/ielts">See the IELTS course</a>
          <a class="cta__link" href="tel:+918136835444">+91 81 36 835 444</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
