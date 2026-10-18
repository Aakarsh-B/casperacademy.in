<?php
/*
 * Contact page with an enquiry form. The form posts back here and is emailed to info@casperacademy.in
 * with PHP mail() (works on Hostinger; the From address must be a mailbox on casperacademy.in).
 */
$to = 'info@casperacademy.in';
$courses = ['IELTS', 'PTE', 'OET', 'Communicative English', 'German Language', 'Not sure yet'];
$errors = [];
$old = ['name' => '', 'phone' => '', 'email' => '', 'course' => '', 'message' => ''];
$status = $_GET['sent'] ?? null;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  foreach ($old as $k => $_) $old[$k] = trim((string) ($_POST[$k] ?? ''));
  $is_bot = !empty($_POST['website']) || (time() - (int) ($_POST['t'] ?? 0)) < 3;   // honeypot + too-fast submit

  if ($old['name'] === '') $errors['name'] = 'Enter your name.';
  if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $old['phone'])) $errors['phone'] = 'Enter a phone number, for example +91 81 36 835 444.';
  if ($old['email'] !== '' && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter an email address like name@example.com, or leave it empty.';
  if ($old['course'] !== '' && !in_array($old['course'], $courses, true)) $old['course'] = '';

  if (!$errors) {
    if (!$is_bot) {
      $clean = fn($s) => str_replace(["\r", "\n"], ' ', $s);
      $body = "New enquiry from casperacademy.in\n\n"
        . "Name: {$old['name']}\nPhone: {$old['phone']}\nEmail: {$old['email']}\n"
        . "Course: {$old['course']}\n\nMessage:\n{$old['message']}\n";
      $headers = "From: Casper Academy website <$to>\r\nContent-Type: text/plain; charset=UTF-8";
      if ($old['email'] !== '') $headers .= "\r\nReply-To: " . $clean($old['email']);
      $ok = @mail($to, 'Website enquiry: ' . $clean($old['name']) . ($old['course'] ? " ({$old['course']})" : ''), $body, $headers);
    } else {
      $ok = true;
    }
    header('Location: /contact?sent=' . ($ok ? '1' : '0') . '#enquiry', true, 303);
    exit;
  }
}

$page = [
  'title' => 'Contact Casper Academy of Excellence | Online IELTS Coaching',
  'description' => 'Call +91 81 36 835 444, WhatsApp us or send an enquiry about online IELTS, PTE, OET, Communicative English or German classes at Casper Academy of Excellence.',
  'path' => '/contact',
  'nav' => 'contact',
  'image' => '/assets/img/photos/contact-hero.jpg',
];
include __DIR__ . '/partials/header.php';
$err = fn($k) => isset($errors[$k]) ? ' aria-invalid="true" aria-describedby="' . $k . '-error"' : '';
?>

<main id="main">

  <section class="phero phero--contact">
    <div class="wrap">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <svg viewBox="0 0 16 16" aria-hidden="true"><path d="m6 3.5 4.5 4.5L6 12.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span aria-current="page">Contact</span>
      </nav>
      <h1 class="phero__title">We Are Glad We Can Help You</h1>
      <p class="phero__lead">Seeing you succeed is what motivates us. Start your Journey. Start with excellence.</p>

      <ul class="contact-cards">
        <li class="ccard">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1z" fill="currentColor"/></svg>
          <h2 class="ccard__title">Phone</h2>
          <a href="tel:+918136835444">+91 81 36 835 444</a>
        </li>
        <li class="ccard">
          <svg viewBox="0 0 32 32" aria-hidden="true"><path fill="currentColor" d="M16 3a13 13 0 0 0-11.2 19.6L3 29l6.6-1.7A13 13 0 1 0 16 3Zm0 23.6c-2 0-4-.5-5.6-1.6l-.4-.2-3.9 1 1-3.8-.3-.4A10.6 10.6 0 1 1 16 26.6Zm5.8-7.9c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2l-1 1.2c-.2.2-.4.2-.7.1a8.7 8.7 0 0 1-4.3-3.8c-.3-.6.3-.5.9-1.7.1-.2 0-.4 0-.5l-1-2.4c-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5 0-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.3 5.2 4.6 1.9.8 2.7.9 3.6.7.6-.1 1.9-.8 2.1-1.5.3-.7.3-1.3.2-1.5l-.2-.3Z"/></svg>
          <h2 class="ccard__title">WhatsApp</h2>
          <a href="https://api.whatsapp.com/send?phone=918136835444&amp;text=Hi" target="_blank" rel="noopener">Chat with us</a>
        </li>
        <li class="ccard">
          <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="m4 7 8 6 8-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
          <h2 class="ccard__title">Email</h2>
          <a href="mailto:info@casperacademy.in">info@casperacademy.in</a>
        </li>
      </ul>
    </div>
  </section>

  <section class="section enquiry" id="enquiry">
    <div class="wrap enquiry__inner">
      <div>
        <h2 class="h2">Send us an enquiry</h2>
        <p class="lead">Tell us which course you're interested in and we'll call you back.</p>
        <figure class="enquiry__photo">
          <img src="/assets/img/photos/contact-hero.jpg" alt="Students smiling as they work together around a laptop" loading="lazy" width="1400" height="1100">
        </figure>
      </div>

      <div class="form-card">
<?php if ($status === '1'): ?>
        <div class="form-status form-status--ok" role="status" tabindex="-1" id="form-status">
          <h3>Enquiry sent</h3>
          <p>Thank you. We'll call you back soon. For anything urgent, call <a href="tel:+918136835444">+91 81 36 835 444</a>.</p>
        </div>
<?php elseif ($status === '0'): ?>
        <div class="form-status form-status--err" role="alert" tabindex="-1" id="form-status">
          <h3>Your enquiry wasn't sent</h3>
          <p>Our email isn't working right now. Please call <a href="tel:+918136835444">+91 81 36 835 444</a> or <a href="https://api.whatsapp.com/send?phone=918136835444&amp;text=Hi">WhatsApp us</a>.</p>
        </div>
<?php endif; ?>
<?php if ($errors): ?>
        <div class="form-status form-status--err" role="alert" tabindex="-1" id="form-status">
          <h3>Check <?= count($errors) === 1 ? 'one field' : count($errors) . ' fields' ?> below</h3>
        </div>
<?php endif; ?>
        <form class="enquiry-form" method="post" action="/contact#enquiry" novalidate>
          <div class="field">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" autocomplete="name" required value="<?= e($old['name']) ?>"<?= $err('name') ?>>
            <?php if (isset($errors['name'])): ?><p class="field__error" id="name-error"><?= e($errors['name']) ?></p><?php endif; ?>
          </div>
          <div class="field">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" required value="<?= e($old['phone']) ?>"<?= $err('phone') ?>>
            <?php if (isset($errors['phone'])): ?><p class="field__error" id="phone-error"><?= e($errors['phone']) ?></p><?php endif; ?>
          </div>
          <div class="field">
            <label for="email">Email <span class="field__opt">(optional)</span></label>
            <input id="email" name="email" type="email" autocomplete="email" value="<?= e($old['email']) ?>"<?= $err('email') ?>>
            <?php if (isset($errors['email'])): ?><p class="field__error" id="email-error"><?= e($errors['email']) ?></p><?php endif; ?>
          </div>
          <div class="field">
            <label for="course">Course</label>
            <select id="course" name="course">
              <option value="">Choose a course</option>
<?php foreach ($courses as $c): ?>
              <option<?= $old['course'] === $c ? ' selected' : '' ?>><?= e($c) ?></option>
<?php endforeach; ?>
            </select>
          </div>
          <div class="field field--full">
            <label for="message">Message <span class="field__opt">(optional)</span></label>
            <textarea id="message" name="message" rows="4"><?= e($old['message']) ?></textarea>
          </div>
          <div class="hp" aria-hidden="true"><label for="website">Leave this empty</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
          <input type="hidden" name="t" value="<?= time() ?>">
          <button class="btn btn--red field--full" type="submit">Send enquiry</button>
        </form>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
