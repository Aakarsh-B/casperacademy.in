<?php
// Meta Pixel, on every site and blog page. Paste the Pixel ID from Meta Events Manager; empty turns it off.
// main.js tracks taps on WhatsApp and phone links as Contact.
$meta_pixel_id = '';
if ($meta_pixel_id): ?>
  <script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?= htmlspecialchars($meta_pixel_id, ENT_QUOTES) ?>');
  fbq('track', 'PageView');
  </script>
<?php endif; ?>
