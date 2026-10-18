<?php
$course = [
  'short' => 'German Language',
  'title' => 'German Language Classes in Kochi',
  'lead' => 'German language certifications adhere to the CEFR (Common European Framework of Reference for Languages) standards for language learning. It uses a six-point scale to evaluate the reading, writing, listening, and talking abilities of language students.',
  'image' => '/assets/img/photos/german-hero.jpg',
  'image_alt' => 'The Brandenburg Gate in Berlin lit up at dusk',
  'chips' => ['CEFR levels A1 to C2', 'For study, work & residency'],
  'intro' => [
    'Whether you are applying for a visa, permanent residency, citizenship or a German-language university course, the level you need is set on the CEFR scale. Here is what each level means and how long it usually takes.',
  ],
  'facts' => [
    'Levels' => 'A1, A2, B1, B2, C1, C2',
    'Visa / residency' => 'A1 to A2',
    'Citizenship' => 'At least B1',
    'University courses' => 'C2 (some accept B2 or C1)',
  ],
  'features_title' => 'The six CEFR levels',
  'features' => [
    ['title' => 'Grade A (Basic User)', 'text' => 'This is the minimum proficiency level necessary to apply for a visa or permanent residency in Germany and is divided into two sub-levels: A1 (Beginner) and A2 (Elementary). 60–200 hours of classroom instruction (including homework) is the norm.'],
    ['title' => 'Grade B (Independent User)', 'text' => 'Both B1 (Intermediate) and B2 (Upper intermediate) exist within the B level. To be eligible for German citizenship, you must reach at least B1 proficiency in the language. Up to 650 hours of study are needed to achieve B2 proficiency.'],
    ['title' => 'Grade C (Proficient User)', 'text' => 'The highest proficiency level, C, is further subdivided into C1 (Advanced) and C2 (Proficient, near-native) to better reflect actual use in real-world contexts. Although some universities may accept students with a B2 or C1 certificate, all German institutions recognize C2 as the minimum level of language competency necessary for entry into German-language courses. To get proficiency at C2, as many as 1,200 hours of study may be required.'],
  ],
  'cta' => 'Start learning German at Casper Academy',
];
$page = [
  'title' => 'German Coaching in Kochi | German Language Training in Kochi',
  'description' => 'German language classes in Kochi for study, work, visa and citizenship. Learn what each CEFR level (A1 to C2) means and how long it takes, at Casper Academy of Excellence.',
  'path' => '/german-language',
  'nav' => 'german',
  'image' => $course['image'],
  'preload' => $course['image'],
];
include __DIR__ . '/partials/course-schema.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/course.php';
include __DIR__ . '/partials/footer.php';
