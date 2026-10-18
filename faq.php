<?php
$faqs = json_decode(file_get_contents(__DIR__ . '/data/faq.json'), true);
$page = [
  'title' => 'IELTS FAQ: Fees, Test Format, Results and Tips | Casper Academy Kochi',
  'description' => 'Answers to common IELTS questions: test fee in India, computer vs paper test, registration, test rules, results, and tips for Listening, Reading, Writing and Speaking.',
  'path' => '/faq',
  'nav' => 'faq',
  'schema' => [[
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn($q) => [
      '@type' => 'Question',
      'name' => $q['title'],
      'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($q['html'], '<p><ul><ol><li><strong><em><br>')],
    ], $faqs),
  ]],
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">
  <section class="phero phero--compact">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span aria-current="page">FAQ</span>
      </nav>
      <h1 class="phero__title">Frequently Asked Questions</h1>
      <p class="phero__lead">Everything students usually ask us about the IELTS test. Can't find your question? <a href="/contact">Ask us</a>.</p>
    </div>
  </section>

  <section class="section qa">
    <div class="wrap qa__wrap">
<?php foreach ($faqs as $i => $q): ?>
      <details class="qa__item"<?= $i === 0 ? ' open' : '' ?>>
        <summary><h2 class="qa__q"><?= e($q['title']) ?></h2><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></summary>
        <div class="qa__a prose"><?= $q['html'] /* cleaned markup from data/faq.json */ ?></div>
      </details>
<?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
