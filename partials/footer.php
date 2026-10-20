<?php include __DIR__ . '/site-footer.php'; ?>

<?php
$org = [
  '@context' => 'https://schema.org',
  '@type' => 'EducationalOrganization',
  '@id' => $site . '/#organization',
  'name' => 'Casper Academy of Excellence',
  'url' => $site . '/',
  'logo' => $site . '/assets/img/logo.png',
  'image' => $site . '/assets/img/photos/academy-2.jpg',
  'telephone' => '+91 8136835444',
  'email' => 'casperacademy006@gmail.com',
  'sameAs' => [
    'https://www.facebook.com/casperacademyofexcellencekochi/',
    'https://www.linkedin.com/company/casper-academy-of-excellence/',
    'https://www.instagram.com/casperacademy.in/',
  ],
];
?>
<script type="application/ld+json"><?= json_encode($org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script src="/assets/js/main.js?v=3"></script>
</body>
</html>
