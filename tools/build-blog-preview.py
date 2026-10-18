#!/usr/bin/env python3
"""
Saves a static copy of a locally running WordPress blog (with the casper-academy theme)
into preview/blog/ so it can be viewed on the GitHub Pages link.
Usage: python3 tools/build-blog-preview.py http://localhost:8100
Only for previews; the real blog runs on WordPress at www.casperacademy.in/blog/.
"""
import os, re, shutil, sys, urllib.parse, urllib.request

BASE = sys.argv[1].rstrip('/')
ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUT = os.path.join(ROOT, 'preview', 'blog')
LIVE = 'https://www.casperacademy.in'
MAIN_PAGES = {os.path.splitext(f)[0] for f in os.listdir(os.path.join(ROOT, 'preview')) if f.endswith('.html')}

def get(url):
    with urllib.request.urlopen(url) as r:
        return r.read()

shutil.rmtree(OUT, ignore_errors=True)
os.makedirs(OUT)

# Pages to save: blog home, every post linked from it (both pages of the list), categories found
home = get(BASE + '/blog/').decode()
page2 = get(BASE + '/blog/page/2/').decode() if '/blog/page/2/' in home else ''
# Posts = the links on the post cards
links = set(re.findall(r'class="bcard__link" href="' + re.escape(BASE) + r'/blog/([a-z0-9-]+)/"', home + page2))
cats = set(re.findall(re.escape(BASE) + r'/blog/category/([a-z0-9-]+)/', home))
pages = {'index.html': '/blog/'}
for slug in links:
    pages[f'{slug}.html'] = f'/blog/{slug}/'
for c in cats:
    pages[f'category-{c}.html'] = f'/blog/category/{c}/'
if page2:
    pages['page-2.html'] = '/blog/page/2/'
built = {v: k for k, v in pages.items()}

assets = set()

def rewrite(m):
    url = m.group(0)
    path = urllib.parse.urlparse(url).path
    query = urllib.parse.urlparse(url).query
    if path in built:
        return built[path]
    if path.startswith('/blog/wp-content/') or path.startswith('/blog/wp-includes/'):
        assets.add(path)
        return path[len('/blog/'):]
    if path.startswith('/blog/'):
        return LIVE + path + (('?' + query) if query else '')
    if path.startswith('/assets/') or path == '/favicon.ico':
        return '../..' + path
    slug = path.strip('/') or 'index'
    return f'../{slug}.html' if slug in MAIN_PAGES else '../404.html'

for name, path in pages.items():
    html = get(BASE + path).decode()
    html = re.sub(r'<link[^>]+(oembed|wp-json|EditURI|xmlrpc)[^>]*>\n?', '', html)  # WordPress API discovery tags
    html = re.sub(re.escape(BASE) + r'/[^\s"\'<>),]*', rewrite, html)
    # Root-relative links from the shared site header/footer (/ielts, /assets/...)
    html = re.sub(r'(href|src|action)="(/[^/"][^"]*|/)"', lambda m: f'{m.group(1)}="{rewrite(re.match(r".*", BASE + m.group(2)))}"', html)
    html = html.replace('action="../index.html"', f'action="{LIVE}/blog/"')
    html = re.sub(r'action="index\.html"', f'action="{LIVE}/blog/"', html)
    html = html.replace('<meta charset="UTF-8">', '<meta charset="UTF-8">\n  <meta name="robots" content="noindex">', 1)
    with open(os.path.join(OUT, name), 'w') as f:
        f.write(html)
    print('preview/blog/' + name)

for path in sorted(assets):
    dest = os.path.join(OUT, path[len('/blog/'):])
    os.makedirs(os.path.dirname(dest), exist_ok=True)
    try:
        with open(dest, 'wb') as f:
            f.write(get(BASE + urllib.parse.quote(path)))
    except Exception as e:
        print('skip', path, e)
print(len(assets), 'assets copied')
