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
wp-theme/casper-academy/  WordPress theme for /blog/ (same header, footer and styles)
```

## Preview locally
```
php -S localhost:8000 router.php
```
Then open http://localhost:8000

## GitHub Pages preview link
GitHub Pages can't run PHP, so `preview/` holds static HTML copies of the pages and `index.html`
forwards there. After changing a page, rebuild it with `php tools/build-preview.php` and commit.
The blog preview (`preview/blog/`) is saved from a local WordPress running this theme:
`python3 tools/build-blog-preview.py http://localhost:8100`.
The preview is marked noindex; on Hostinger, `.htaccess` ignores `index.html` and hides `preview/`.

## Add a page
Copy `ielts.php`, change the `$page` array (title, description, path, nav) and the content,
add it to `sitemap.xml`, then run `php tools/build-preview.php`. `/new-page` is served from `new-page.php` automatically.

## Deploy to Hostinger
Upload everything except `router.php` and `README.md` to `public_html`
(keep the existing `blog/` folder), or connect this repo under **Websites → Advanced → Git**.

## Photos
- `assets/img/photos/academy-*.jpg`: Casper Academy's own classroom photos.
- `assets/img/achievers/*.jpg`: Casper Academy's own student result posters.
- All other photos are from Unsplash (free under the Unsplash License, no attribution required).

## Blog (WordPress in /blog/)
The blog stays on WordPress so posts can be published daily from the dashboard.
`wp-theme/casper-academy` is a lightweight theme that reuses this site's header, footer
(`partials/site-header.php`, `partials/site-footer.php`) and `assets/css/style.css`,
so the blog and the website always match. Blog-only styles are in `blog.css`.

Install: zip the `casper-academy` folder, then in WordPress go to
**Appearance → Themes → Add New → Upload Theme**, and activate it.
Deploy the main website first: the theme reads its header and footer from the folder above `/blog/`.
Posts, URLs, categories, Yoast SEO settings and images are untouched by a theme change.

## Accessibility (WCAG 2.2 AA)
Checked on every page at desktop and mobile with axe-core (0 violations), plus manual checks:
keyboard-only navigation with visible focus, skip link, menu opens/closes by keyboard (Esc closes),
focused items never hidden under the sticky header, 200% and 400% zoom without sideways scrolling,
colour contrast of every text/background pair (4.5:1 text, 3:1 controls), reduced-motion respected.
Breakpoints are in `em` so the layout adapts when people enlarge their browser text size.
Header styles: `'header' => 'overlay'` only on pages with a dark photo hero (homepage); every other page
gets the solid white header by default.
