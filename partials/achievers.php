<?php // Achievers carousel. Expects $list (rows from data/achievers.php). ?>
  <!-- ============ Achievers ============ -->
  <section class="section achievers">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">Our Achievers</h2>
<?php if (count($list) > 3): ?>
        <div class="achievers__nav">
          <button class="round-btn" type="button" data-scroll="-1" aria-label="Previous achievers"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 6-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
          <button class="round-btn" type="button" data-scroll="1" aria-label="Next achievers"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        </div>
<?php endif; ?>
      </header>
    </div>
    <ul class="achievers__track" id="achievers" tabindex="0" aria-label="Our Achievers, scroll sideways for more">
<?php foreach ($list as [$slug, $name, $test, $overall, $s]): ?>
      <li class="achiever">
        <img src="/assets/img/achievers/<?= $slug ?>.jpg" loading="lazy" width="640" height="640"
             alt="<?= e("$name, $test overall $overall. Listening {$s[0]}, Reading {$s[1]}, Writing {$s[2]}, Speaking {$s[3]}.") ?>">
        <p><strong><?= e($name) ?></strong><span><?= $test ?> overall <?= $overall ?></span></p>
      </li>
<?php endforeach; ?>
    </ul>
  </section>
