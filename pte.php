<?php
$course = [
  'short' => 'PTE',
  'title' => 'PTE Coaching in Kochi',
  'lead' => 'The Pearson Test of English (PTE) is a premier English language proficiency test recognized by institutions and governments around the world. At Casper Academy of Excellence, we offer specialized PTE coaching designed to help you achieve your best possible score.',
  'image' => '/assets/img/photos/pte-hero.jpg',
  'image_alt' => 'A student with headphones practising at a laptop',
  'chips' => ['One-on-one online coaching', 'Students scoring 90'],
  'intro' => [
    'Our students consistently achieve exceptional results. Many of our candidates have scored 90 in all sections of the PTE exam, and numerous others have achieved scores above 78. This success is a testament to the effectiveness of our coaching strategies and the dedication of our trainers.',
    'Our one-on-one online coaching is tailored to provide personalized attention, focusing on your specific needs and learning style. This format allows you to receive targeted support from our experienced trainers, who have over 25 years of experience in English language coaching.',
  ],
  'facts' => [
    'Sections' => 'Speaking & Writing, Reading, Listening',
    'Classes' => 'One-on-one online',
    'Study plan' => 'Customised to your level',
    'Schedule' => 'Flexible, around your time',
    'Support' => 'Regular feedback throughout',
  ],
  'features_title' => "Here's why our program is your best choice",
  'features' => [
    ['title' => 'Comprehensive Test Preparation', 'text' => 'The PTE exam is divided into three main sections: Speaking & Writing, Reading, and Listening. Our coaching covers each section thoroughly:', 'list' => [
      '<strong>Speaking &amp; Writing:</strong> From personal introductions to essay writing, we ensure you are well-prepared for every task.',
      '<strong>Reading:</strong> Develop your skills in answering multiple-choice questions, re-ordering paragraphs, and filling in blanks.',
      '<strong>Listening:</strong> Enhance your ability to summarize spoken text, highlight correct summaries, and more.',
    ]],
    ['title' => 'Customized Study Plans', 'text' => 'We create personalized study plans based on your current proficiency level. Our focus is on improving your weaknesses and building on your strengths, ensuring that you are fully prepared for the test.'],
    ['title' => 'Flexible and Convenient Learning', 'text' => 'Our online sessions are designed to fit around your schedule, providing you with the flexibility to learn from the comfort of your home without compromising on the quality of your preparation.'],
    ['title' => 'Continuous Support and Feedback', 'text' => 'Throughout your coaching journey, you will receive regular feedback and guidance. Our trainers are committed to helping you refine your skills and boost your confidence.'],
  ],
  'closing' => 'Whether you’re aiming for academic admission or a visa, our PTE coaching at Casper Academy of Excellence is designed to help you achieve your goals. Enroll now and take the first step towards PTE success!',
  'achievers' => 'PTE',
  'cta' => 'Join Us Today',
];
$page = [
  'title' => 'PTE Training in Kochi | PTE Course in Ernakulam',
  'description' => 'Specialised PTE coaching in Kochi with one-on-one online classes, customised study plans and regular feedback. Many of our students have scored 90 in all sections.',
  'path' => '/pte',
  'nav' => 'pte',
  'image' => $course['image'],
  'preload' => $course['image'],
];
include __DIR__ . '/partials/course-schema.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/course.php';
include __DIR__ . '/partials/footer.php';
