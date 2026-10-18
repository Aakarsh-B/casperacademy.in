<?php
// Course + breadcrumb structured data for a course page. Expects $course and $page.
$page['schema'] = [
  [
    '@context' => 'https://schema.org',
    '@type' => 'Course',
    'name' => $course['title'],
    'description' => $page['description'],
    'provider' => ['@id' => 'https://www.casperacademy.in/#organization'],
    'hasCourseInstance' => [
      ['@type' => 'CourseInstance', 'courseMode' => 'Online'],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
      ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://www.casperacademy.in/'],
      ['@type' => 'ListItem', 'position' => 2, 'name' => $course['short'], 'item' => 'https://www.casperacademy.in' . $page['path']],
    ],
  ],
];
