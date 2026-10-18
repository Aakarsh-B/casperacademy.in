<?php
http_response_code(404);
$page = [
  'title' => 'Page not found | Casper Academy of Excellence',
  'description' => 'This page does not exist. Find IELTS, PTE, OET, Communicative English and German Language courses at Casper Academy of Excellence, Kochi.',
  'path' => '/404',
  'nav' => '',
  'solid' => true,
  'noindex' => true,
];
include __DIR__ . '/partials/header.php';
?>
<main id="main" class="notfound">
  <div class="wrap">
    <h1 class="h2">Page not found</h1>
    <p class="lead">The page you're looking for has moved or doesn't exist.</p>
    <div class="notfound__actions">
      <a class="btn btn--red" href="/">Go to homepage</a>
      <a class="btn btn--outline" href="/ielts">IELTS course</a>
    </div>
  </div>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
