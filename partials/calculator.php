<?php // IELTS band score calculator section (logic in assets/js/main.js). ?>
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
