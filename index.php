<?php
$page = [
  'title' => 'Best IELTS Training in Ernakulam | IELTS Coaching Kochi',
  'description' => 'Training every module with adequate mock tests in listening, speaking, reading and writing, Casper academy provides the Best IELTS training in Ernakulam.',
  'path' => '/',
  'nav' => 'home',
  'preload' => '/assets/img/photos/hero.jpg',
  'header' => 'overlay',
];
include __DIR__ . '/partials/header.php';
?>

<main id="main">

  <!-- ============ Hero ============ -->
  <section class="hero">
    <img class="hero__photo" src="/assets/img/photos/hero.jpg" alt="Students in a classroom, one holding a folder and smiling" width="2000" height="1333">
    <div class="wrap hero__content">
      <p class="hero__kicker">Best IELTS Institute in Kochi</p>
      <h1 class="hero__title">Your Mission - Better lifestyle</h1>
      <div class="hero__actions">
        <a class="btn btn--red" href="#courses">Find courses</a>
        <a class="hero__call" href="tel:+918136835444">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1z" fill="currentColor"/></svg>
          +91 81 36 835 444
        </a>
      </div>
    </div>
  </section>

  <div class="wrap">
    <dl class="stats">
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><path d="M16 5 3 11l13 6 13-6-13-6Zm-8 9v6c0 2 3.6 4 8 4s8-2 8-4v-6M27 12v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"/></svg>
        <dt>Students Registered</dt>
        <dd><span class="count" data-to="18000">18000</span> +</dd>
      </div>
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><circle cx="16" cy="13" r="7" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m11.5 18.5-2 9 6.5-3 6.5 3-2-9" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
        <dt>Years of Experience</dt>
        <dd><span class="count" data-to="25">25</span> +</dd>
      </div>
      <div class="stat">
        <svg class="stat__icon" viewBox="0 0 32 32" aria-hidden="true"><path d="m16 4 3.6 7.4 8.1 1.2-5.9 5.7 1.4 8.1L16 22.6l-7.2 3.8 1.4-8.1-5.9-5.7 8.1-1.2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
        <dt>Desired score</dt>
        <dd><span class="count" data-to="100">100</span> %</dd>
      </div>
    </dl>
  </div>

  <!-- ============ Courses ============ -->
  <section class="section courses" id="courses">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">Our Courses</h2>
        <p class="lead">We endure to provide highly interactive and customized classes to clients aspiring to study and work abroad.</p>
      </header>

      <ul class="course-grid">
        <li class="course course--feature">
          <a href="/ielts">
            <img src="/assets/img/photos/course-ielts.jpg" alt="" loading="lazy" width="900" height="1100">
            <span class="course__name">IELTS</span>
            <svg class="course__go" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </li>
        <li class="course">
          <a href="/pte">
            <img src="/assets/img/photos/course-pte.jpg" alt="" loading="lazy" width="900" height="700">
            <span class="course__name">PTE</span>
            <svg class="course__go" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </li>
        <li class="course">
          <a href="/oet">
            <img src="/assets/img/photos/course-oet.jpg" alt="" loading="lazy" width="900" height="700">
            <span class="course__name">OET</span>
            <svg class="course__go" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </li>
        <li class="course">
          <a href="/communicative-english">
            <img src="/assets/img/photos/course-english.jpg" alt="" loading="lazy" width="900" height="700">
            <span class="course__name">Communicative English</span>
            <svg class="course__go" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </li>
        <li class="course">
          <a href="/german-language">
            <img src="/assets/img/photos/course-german.jpg" alt="" loading="lazy" width="900" height="700">
            <span class="course__name">German Language</span>
            <svg class="course__go" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </li>
      </ul>

      <div class="center">
        <a class="btn btn--outline" href="/ielts">Read more details</a>
      </div>
    </div>
  </section>

  <!-- ============ About ============ -->
  <section class="about" id="about">
    <div class="wrap about__inner">
      <div class="about__photos">
        <img class="about__photo about__photo--main" src="/assets/img/photos/academy-2.jpg" alt="Students working through study material together at Casper Academy, Vyttila" loading="lazy" width="1200" height="900">
        <img class="about__photo about__photo--small" src="/assets/img/photos/academy-1.jpg" alt="A class in session at Casper Academy" loading="lazy" width="1200" height="900">
      </div>
      <div class="about__text">
        <h2 class="about__title">Casper Academy of Excellence<br>Best IELTS Coaching in Kochi</h2>
        <p class="about__first">Pioneers with over 25 years of experience in the industry enable us to develop the most efficient set of strategies made with purpose of achieving targeted band scores in IELTS, OET and PTE.</p>
        <p>Casper academy of excellence is the best IELTS coaching centre in Kochi. Our intensive practice sessions and dedicated trainers help you crack the international exams in the 1st attempt and achieve top scores.</p>
      </div>
    </div>
  </section>

  <!-- ============ Testimonials ============ -->
  <section class="section testimonials">
    <div class="wrap">
      <header class="section__head">
        <h2 class="h2">Our Testimonials</h2>
        <p class="lead">We are proud to share a selection of our favourite stories with you here. Students who join us become part of our team.</p>
      </header>

      <div class="quotes">
        <figure class="quote">
          <div class="stars" role="img" aria-label="5 out of 5 stars">★★★★★</div>
          <blockquote>I really admire Casper Academy of Excellence for its dedicated approach, care and consideration towards those really aspire for IELTS. This is the best institute in town and they excel in every aspect..</blockquote>
          <figcaption>
            <span class="avatar" aria-hidden="true">BS</span>
            <span><strong>Bibin Samuel</strong><small>Student</small></span>
          </figcaption>
        </figure>
        <figure class="quote">
          <div class="stars" role="img" aria-label="5 out of 5 stars">★★★★★</div>
          <blockquote>Casper academy provides excellent coaching for IELTS examination. After joining here I could improve my language skills with the help of faculties over here. So I would recommend this institute for IELTS training.</blockquote>
          <figcaption>
            <span class="avatar avatar--red" aria-hidden="true">JA</span>
            <span><strong>Jainy Abraham</strong><small>Student</small></span>
          </figcaption>
        </figure>
        <figure class="quote">
          <div class="stars" role="img" aria-label="5 out of 5 stars">★★★★★</div>
          <blockquote>Great place to learn IELTS! There are various techniques involved while approaching reading, listening, writing and speaking tests. We tried learning these aspects online which was time taking.</blockquote>
          <figcaption>
            <span class="avatar" aria-hidden="true">JK</span>
            <span><strong>John Kurian</strong><small>Student</small></span>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- ============ Join ============ -->
  <section class="join">
    <div class="wrap">
      <div class="join__card">
        <div class="join__media">
          <img src="/assets/img/photos/join.jpg" alt="Students gathered around a laptop, smiling" loading="lazy" width="1400" height="1050">
        </div>
        <div class="join__text">
          <h2 class="h2 h2--light">Join the Best Institute for IELTS Preparation</h2>
          <p>Casper Academy of Excellence provides the most effective IELTS training available. Professional, result-oriented coaching can help you attain your targeted IELTS and OET scores. Here, you can find the most effective tactics and advice for improving your speaking, writing, reading, and listening abilities. As a result, it has become the leading centre in Kochi for IELTS coaching. Casper Academy also offers training in communicative English and German to assist students create careers in foreign countries.</p>
          <a class="btn btn--white" href="/contact">Join Now</a>
        </div>
      </div>

      <div class="videos">
        <a class="video" href="https://www.youtube.com/watch?v=OZNkn7bPemI" target="_blank" rel="noopener" aria-label="Play IDP IELTS video (opens YouTube)">
          <img src="/assets/img/photos/video-1.jpg" alt="" loading="lazy" width="900" height="600">
          <span class="video__play" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor"/></svg></span>
          <span class="video__label">IDP IELTS</span>
        </a>
        <a class="video" href="https://www.youtube.com/watch?v=PBqUCD-K6Mw" target="_blank" rel="noopener" aria-label="Play IDP IELTS video (opens YouTube)">
          <img src="/assets/img/photos/video-2.jpg" alt="" loading="lazy" width="900" height="600">
          <span class="video__play" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor"/></svg></span>
          <span class="video__label">IDP IELTS</span>
        </a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
