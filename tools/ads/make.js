// Meta ad images: feed (1080x1350, 4:5) and Stories/Reels (1080x1920, 9:16) for each ad.
// Run: node tools/ads/make.js   (writes assets/ads/*.jpg, served at www.casperacademy.in/assets/ads/)
const { chromium } = require('playwright');
const fs = require('fs'), path = require('path');
const ASSETS = path.join(__dirname, '../../assets/');
const OUT = path.join(ASSETS, 'ads/');
const data = (f, type) => `data:${type};base64,` + fs.readFileSync(ASSETS + f).toString('base64');
const img = f => data('img/' + f, f.endsWith('png') ? 'image/png' : 'image/jpeg');
const LOGO_W = img('logo-white.png');

const CSS = `
@font-face{font-family:Fraunces;font-weight:400 600;src:url(${data('fonts/fraunces-latin.woff2', 'font/woff2')})}
@font-face{font-family:Figtree;font-weight:400 700;src:url(${data('fonts/figtree-latin.woff2', 'font/woff2')})}
*{box-sizing:border-box;margin:0}
body{width:1080px;overflow:hidden;font-family:Figtree,sans-serif;-webkit-font-smoothing:antialiased;background:#1e1a50;color:#fff}
.ad{width:1080px;position:relative;display:flex;flex-direction:column;overflow:hidden}
.photo{position:absolute;inset:0 0 auto 0;background-size:cover}
.photo:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(30,26,80,.15) 0%,rgba(30,26,80,0) 35%,#1e1a50 96%)}
.body{position:relative;margin-top:auto;padding:0 84px}
.eyebrow{font-weight:700;font-size:28px;letter-spacing:.14em;text-transform:uppercase;color:#ff8fa6}
h1{font-family:Fraunces,serif;font-weight:600;font-size:96px;line-height:1.04;letter-spacing:-.01em;margin-top:22px}
h1 em{font-style:normal;color:#ff6f8d}
.chips{display:flex;flex-wrap:wrap;gap:14px;margin-top:34px}
.chips span{font-size:30px;font-weight:600;border:2px solid rgba(255,255,255,.45);border-radius:999px;padding:12px 24px}
.cta{display:inline-flex;align-items:center;gap:16px;margin-top:40px;font-weight:700;font-size:36px;background:#25d366;color:#0b3d22;border-radius:999px;padding:20px 36px}
.cta svg{width:42px;height:42px}
.band{position:relative;margin-top:48px;background:#c8183f;display:flex;align-items:center;justify-content:space-between;padding:26px 84px}
.band span{font-size:30px;font-weight:600}
.band img{height:90px}
.story .body{padding-bottom:40px}
.story h1{font-size:104px}
.story .band{padding-bottom:150px}
`;
const WA = '<svg viewBox="0 0 32 32"><path fill="currentColor" d="M16 3a13 13 0 0 0-11.2 19.6L3 29l6.6-1.7A13 13 0 1 0 16 3Zm5.8 15.7c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2l-1 1.2c-.2.2-.4.2-.7.1a8.7 8.7 0 0 1-4.3-3.8c-.3-.6.3-.5.9-1.7.1-.2 0-.4 0-.5l-1-2.4c-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5 0-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.3 5.2 4.6 1.9.8 2.7.9 3.6.7.6-.1 1.9-.8 2.1-1.5.3-.7.3-1.3.2-1.5Z"/></svg>';

const ads = {
  'ielts': { photo: 'photos/ielts-hero.jpg', pos: 'center 25%', eyebrow: 'IELTS coaching · fully online',
    title: 'Your own IELTS trainer. <em>Not a crowded batch.</em>',
    chips: ['One-on-one classes', 'Essays corrected live', 'Weekly mock tests'] },
  'pte': { photo: 'photos/pte-hero.jpg', pos: 'center 30%', eyebrow: 'PTE Academic · fully online',
    title: 'PTE coaching that fits <em>your schedule.</em>',
    chips: ['One-on-one classes', 'Speaking practice', 'Full mock tests'] },
  'trust': { photo: 'photos/hero.jpg', pos: '70% 30%', eyebrow: 'Casper Academy of Excellence',
    title: '25+ years. 18,000+ students. <em>Now online.</em>',
    chips: ['IELTS', 'PTE', 'Communicative English'] },
};

const page = (a, story) => {
  const h = story ? 1920 : 1350, ph = story ? 1180 : 760;
  return `<!doctype html><style>${CSS}</style><div class="ad ${story ? 'story' : ''}" style="height:${h}px">
  <div class="photo" style="height:${ph}px;background-image:url(${img(a.photo)});background-position:${a.pos}"></div>
  <div class="body"><div class="eyebrow">${a.eyebrow}</div><h1>${a.title}</h1>
  <div class="chips">${a.chips.map(c => `<span>${c}</span>`).join('')}</div>
  <div class="cta">${WA}Chat with us on WhatsApp</div></div>
  <div class="band"><span>casperacademy.in</span><img src="${LOGO_W}" alt=""></div></div>`;
};

// Round 2: three different ideas, feed only (Click-to-WhatsApp ads use one image for all placements)
const CSS2 = `
.v{width:1080px;height:1350px;display:flex;flex-direction:column;font-family:Figtree,sans-serif}
.v .in{flex:1;display:flex;flex-direction:column;padding:96px 84px 0}
.v .k{font-weight:700;font-size:28px;letter-spacing:.14em;text-transform:uppercase;color:#c8183f}
.v h2{font-family:Fraunces,serif;font-weight:600;font-size:92px;line-height:1.05;letter-spacing:-.01em;margin-top:22px;color:#1e1a50}
.v p{font-size:38px;line-height:1.4;color:#3a3760}
.v .cta{align-self:flex-start;margin-top:auto;margin-bottom:56px}
.card{border-radius:28px;padding:34px 40px;font-size:50px;line-height:1.3}
.card small{display:block;font-size:24px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;margin-bottom:10px}
.bad{background:#fde8ed;color:#7d0f28}.good{background:#e3f4ec;color:#0d5a3f}
.bad s{text-decoration-thickness:4px;text-decoration-color:#c8183f}
.rows{margin-top:44px;display:grid;gap:18px}
.row{display:flex;justify-content:space-between;align-items:center;gap:24px;background:#fff;border-radius:24px;padding:40px 38px;box-shadow:0 10px 30px -18px rgba(30,26,80,.35)}
.row span{font-size:40px;font-weight:600;color:#1e1a50;line-height:1.25}
.row span small{display:block;font-size:28px;margin-top:4px;font-weight:500;color:#6b6890}
.row b{font-family:Fraunces,serif;font-size:70px;color:#c8183f;white-space:nowrap}
.fine{font-size:24px!important;color:#6b6890!important;margin-top:22px}
.red{background:#c8183f}.red .k{color:#ffd0da}.red h2,.red p{color:#fff}
.no{font-family:Fraunces,serif;font-weight:600;font-size:330px;line-height:.9;color:#fff;margin-top:24px}
.crit{display:flex;flex-wrap:wrap;gap:14px;margin-top:36px}
.crit span{font-size:30px;font-weight:600;color:#fff;border:2px solid rgba(255,255,255,.55);border-radius:999px;padding:12px 24px}
.navyband{background:#1e1a50}
`;
const band = cls => `<div class="band ${cls || ''}" style="margin-top:0"><span>casperacademy.in</span><img src="${LOGO_W}" alt=""></div>`;
const cta = `<div class="cta">${WA}Chat with us on WhatsApp</div>`;
const round2 = {
  'mistake': `<div class="v" style="background:#f7f6fb"><div class="in">
    <div class="k">IELTS Writing</div><h2>Can you spot the mistake?</h2>
    <div class="rows" style="gap:24px">
      <div class="card bad"><small>Wrong</small>The number of students <s>have</s> increased.</div>
      <div class="card good"><small>Right</small>The number of students <b>has</b> increased.</div></div>
    <p style="margin-top:40px">Small slips like this cost you marks. In our one-on-one classes, your essays are corrected live.</p>
    ${cta}</div>${band()}</div>`,
  'band-needed': `<div class="v" style="background:#f7f6fb"><div class="in" style="padding-top:84px">
    <div class="k">Planning to go abroad?</div><h2 style="font-size:84px">What IELTS band do you need?</h2>
    <div class="rows">
      <div class="row"><span>Canada Express Entry<small>CLB 7, IELTS General</small></span><b>6.0 each</b></div>
      <div class="row"><span>Nursing in the UK<small>NMC, IELTS Academic (writing 6.5)</small></span><b>7.0</b></div>
      <div class="row"><span>University in the UK, Canada or Australia<small>Most courses, overall score</small></span><b>6.0–6.5</b></div></div>
    <p class="fine" style="font-size:26px!important">Typical requirements. Always check your university or visa rules.</p>
    ${cta}</div>${band()}</div>`,
  'accent-myth': `<div class="v red"><div class="in">
    <div class="k">IELTS Speaking myth</div><h2>Do you need a British accent for Band 8?</h2>
    <div class="no">No.</div>
    <p style="margin-top:20px">Examiners score how clearly and fluently you speak, not your accent:</p>
    <div class="crit"><span>Fluency</span><span>Vocabulary</span><span>Grammar</span><span>Pronunciation</span></div>
    ${cta}</div>${band('navyband')}</div>`,
};

(async () => {
  fs.mkdirSync(OUT, { recursive: true });
  const b2 = await chromium.launch();
  for (const [name, html] of Object.entries(round2)) {
    const p = await b2.newPage({ viewport: { width: 1080, height: 1350 } });
    await p.setContent(`<!doctype html><style>${CSS}${CSS2}</style>${html}`);
    await p.evaluate(() => document.fonts.ready);
    const file = `${OUT}${name}-feed.jpg`;
    await p.screenshot({ path: file, type: 'jpeg', quality: 90 });
    await p.close();
    console.log(file);
  }
  await b2.close();
  const browser = await chromium.launch();
  for (const [name, a] of Object.entries(ads)) {
    for (const story of [false, true]) {
      const p = await browser.newPage({ viewport: { width: 1080, height: story ? 1920 : 1350 } });
      await p.setContent(page(a, story));
      await p.evaluate(() => document.fonts.ready);
      const file = `${OUT}${name}-${story ? 'story' : 'feed'}.jpg`;
      await p.screenshot({ path: file, type: 'jpeg', quality: 90 });
      await p.close();
      console.log(file);
    }
  }
  await browser.close();
})();
