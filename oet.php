<?php
$course = [
  'short' => 'OET',
  'title' => 'OET Coaching in Kochi',
  'lead' => 'If you are looking for a job related to medical field like doctor or nurse, you may already know that you need to prove your ability in English Language. At Casper Academy of Excellence one on one training is given for OET.',
  'image' => '/assets/img/photos/oet-hero.jpg',
  'image_alt' => 'A healthcare professional in a white coat smiling outdoors',
  'chips' => ['One on one training', 'For doctors & nurses'],
  'intro' => [
    'OET was initially created for countries like Australia and New Zealand, but from 2017 onwards the NMC (Nursing and Midwifery Council) began recognizing the OET valid for registration in UK. Casper Academy is the best for OET coaching in Kochi.',
    'The difficulty level of the OET and IELTS test differs as we are expecting to be. The OET test is easier in some ways because it is more specific to healthcare. Because of this you can make use of your healthcare knowledge, vocabulary and experiences. With this the test takers can feel that the writing and speaking portions of the test is little easier as you are aware about the situations provided.',
    'There is no overall grade for OET. The four sub tests that make up the OET are reported on a scale from 0 to 500 in ten-point increments. Then this numerical score will be mapped to a separate letter grade for each sub-test ranging from A (highest) to E (lowest).',
    'At Casper Academy, this course is designed to guide the students to pass the OET test on the first go itself. Here along with preparing for all the components like Reading, Writing, Speaking and Listening, you will gain the opportunity to improve your confidence level and gain skills. The highly trained teachers here will familiarize you with the OET test format through the mock tests.',
  ],
  'facts' => [
    'For' => 'Doctors, nurses and healthcare professionals',
    'Sub-tests' => 'Listening, Reading, Writing, Speaking',
    'Scoring' => '0 to 500, grades A to E',
    'Classes' => 'One on one training',
    'Target' => 'Grade A or B',
  ],
  'learn_title' => 'At Casper Academy you will learn',
  'learn_image' => '/assets/img/photos/ielts-study.jpg',
  'learn' => [
    'To accurately use Academic English in writing.',
    'To express yourself fluently across a range of topics using appropriate linking words.',
    'To build vocabulary and good letter structure',
    'Exam strategies and techniques for the test',
    'A holistic approach to OET preparation, you will learn grammar in addition to the core skills of reading, writing, listening & speaking.',
    'Experienced OET teachers to help you achieve the best result in the shortest possible time.',
    'Help you in achieving highest grade like A or B.',
    'Participate in informal conversations, formal discussions and structured role plays in the classroom as well as plan and produce an oral presentation.',
    'Detailed individual feedback',
    'Practice test and exam preparation throughout',
    'How you must approach a writing task',
    'How you can pick relevant information from case notes',
    'How to write a letter for referral, for discharge and also for transfer',
    'How to transform notes from the case notes into full sentences in your letter',
    'How you can modify your register, tone and lexis according to your reader test criteria.',
  ],
  'cta' => 'Join the Best Institute for OET Preparation',
];
$page = [
  'title' => 'OET Coaching in Kochi | OET Coaching Centres in Ernakulam',
  'description' => 'One on one OET coaching in Kochi for doctors and nurses. Prepare for all four sub-tests with mock tests, case-note letter writing practice and detailed feedback.',
  'path' => '/oet',
  'nav' => 'oet',
  'image' => $course['image'],
  'preload' => $course['image'],
];
include __DIR__ . '/partials/course-schema.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/course.php';
include __DIR__ . '/partials/footer.php';
