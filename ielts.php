<?php
$course = [
  'short' => 'IELTS',
  'title' => 'IELTS Coaching in Kochi',
  'lead' => 'Enrol for IELTS Coaching in Ernakulam, Kerala at Casper Academy of Excellence and achieve a top band score. Rated as the best IELTS coaching in Kochi, we provide intensive training in every module with adequate mock tests in Listening, Reading, Writing and Speaking.',
  'image' => '/assets/img/photos/ielts-hero.jpg',
  'image_alt' => 'A student smiling at her desk while preparing for IELTS',
  'chips' => ['British Council & IDP partner', 'Online classes'],
  'intro' => [
    'Casper Academy of Excellence is a state of the art IELTS training centre in Kochi, equipped with authentic examination preparation papers from Cambridge University U.K. Training at Casper Academy of Excellence enables students to acquire high Band scores of 8 and above.',
    'Being the valued partners of British Council and IDP, our IELTS coaching programmes are designed to provide candidates sufficient practice and guaranteed results. Our customised and well planned IELTS training classes are held online. Casper Academy of Excellence is the best IELTS training Institute in Kochi, Kerala that assist students with unique coaching techniques. Our One on One Online IELTS training equip students to take the IELTS test with ease.',
    'We are the only IELTS institute in Ernakulam, Kerala to conduct one on one speaking sessions, mock tests and on the spot Essay corrections, which makes us the best IELTS institute and most preferred IELTS coaching centre in Ernakulam, Kerala.',
    'This course is designed to guide you to pass the IELTS test on the first go. Along with preparing you for all the components tested (reading, writing, listening & speaking). You will have the opportunity to gain skills and confidence in a small class with highly trained teachers and familiarize yourself with the IELTS test format in mock exams.',
  ],
  'facts' => [
    'Modules' => 'Listening, Reading, Writing, Speaking',
    'Classes' => 'Online',
    'Speaking' => 'One on one sessions',
    'Writing' => 'On the spot essay corrections',
    'Practice' => 'Weekly mock tests',
  ],
  'learn_image' => '/assets/img/photos/ielts-study.jpg',
  'learn' => [
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
  ],
  'calculator' => true,
  'achievers' => 'IELTS',
];

$page = [
  'title' => 'Best IELTS Training in Kochi | IELTS Coaching Kochi',
  'description' => 'Enrol for IELTS Coaching in Ernakulam, Kerala at Casper Academy of Excellence. Intensive training in every module with adequate mock tests in Listening, Reading, Writing and Speaking.',
  'path' => '/ielts',
  'nav' => 'ielts',
  'image' => $course['image'],
  'preload' => $course['image'],
];
include __DIR__ . '/partials/course-schema.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/course.php';
include __DIR__ . '/partials/footer.php';
