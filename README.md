# Casper Academy of Excellence website

Plain PHP pages sharing one header and footer. No build step, no database.
WordPress stays separate in `/blog/`.

```
index.php            homepage
ielts.php            IELTS course page            -> /ielts
404.php              page-not-found
partials/header.php  <head>, SEO tags, site header (each page sets $page first)
partials/footer.php  site footer, organisation schema, scripts
assets/              css, js, images
.htaccess            https + www, clean URLs, old .php links -> new, 404
sitemap.xml, robots.txt
router.php           local preview only
```

## Preview locally
```
php -S localhost:8000 router.php
```
Then open http://localhost:8000

## Add a page
Copy `ielts.php`, change the `$page` array (title, description, path, nav) and the content,
add it to `sitemap.xml`. `/new-page` is served from `new-page.php` automatically.

## Deploy to Hostinger
Upload everything except `router.php` and `README.md` to `public_html`
(keep the existing `blog/` folder), or connect this repo under **Websites → Advanced → Git**.

## Photos
- `assets/img/photos/academy-*.jpg`: Casper Academy's own classroom photos.
- `assets/img/achievers/*.jpg`: Casper Academy's own student result posters.
- All other photos are from Unsplash (free under the Unsplash License, no attribution required).
