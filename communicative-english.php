<?php
$course = [
  'short' => 'Communicative English',
  'title' => 'Communicative English',
  'lead' => 'This course will help you if you lack the confidence to speak in English or if you find it difficult to produce a particular English sound or group of sounds.',
  'image' => '/assets/img/photos/english-hero.jpg',
  'image_alt' => 'Friends talking and laughing together around a table',
  'chips' => ['Speak with confidence', 'Stepping stone to IELTS & PTE'],
  'intro' => [
    'It is also the perfect stepping stone to courses like IELTS & PTE preparation as it will give you the confidence to speak in front of a group, helping you to progress faster.',
    'Our clean speak teaching method has helped students to communicate in English with clarity and confidence for 25 years.',
  ],
  'facts' => [
    'For' => 'Anyone who wants to speak English confidently',
    'Focus' => 'Speaking, pronunciation, grammar, vocabulary',
    'Method' => 'Clean speak teaching method',
    'Next step' => 'IELTS or PTE preparation',
  ],
  'learn_title' => 'Our Features',
  'learn' => [
    'You will learn to speak English quickly and confidently.',
    'Understand formal & informal language.',
    'To speak with more fluency and accuracy.',
    'To improve your grammar skills.',
    'Build your vocabulary.',
    'Pronunciation lessons to reduce accent and build confidence.',
  ],
  'cta' => 'Start speaking English with confidence',
];
$page = [
  'title' => 'Spoken English Classes in Kochi | Spoken English in Kochi',
  'description' => 'Communicative English classes in Kochi to speak English quickly and confidently: fluency, pronunciation, grammar and vocabulary, with our clean speak teaching method.',
  'path' => '/communicative-english',
  'nav' => 'english',
  'image' => $course['image'],
  'preload' => $course['image'],
];
include __DIR__ . '/partials/course-schema.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/course.php';
include __DIR__ . '/partials/footer.php';
