// Meta ad images, round 3: three ideas, each in its own visual format (feed, 1080x1350).
//   mistake      a handwritten essay page with red-pen corrections
//   band-needed  an airport departures board
//   accent-myth  a chat between a student and a trainer
// Run: node tools/ads/make-round3.js   (writes assets/ads/*-v3.jpg)
const { chromium } = require('playwright');
const fs = require('fs'), path = require('path');
const ASSETS = path.join(__dirname, '../../assets/');
const OUT = path.join(ASSETS, 'ads/');
const b64 = (file, type) => `data:${type};base64,` + fs.readFileSync(file).toString('base64');
const font = f => b64(path.join(__dirname, 'fonts', f), 'font/woff2');
const LOGO = b64(ASSETS + 'img/logo.png', 'image/png');
const LOGO_W = b64(ASSETS + 'img/logo-white.png', 'image/png');

const BASE = `
@font-face{font-family:Fraunces;font-weight:400 600;src:url(${b64(ASSETS + 'fonts/fraunces-latin.woff2', 'font/woff2')})}
@font-face{font-family:Figtree;font-weight:400 700;src:url(${b64(ASSETS + 'fonts/figtree-latin.woff2', 'font/woff2')})}
@font-face{font-family:Caveat;font-weight:400 700;src:url(${font('caveat.woff2')})}
@font-face{font-family:Inter;font-weight:400 700;src:url(${font('inter.woff2')})}
@font-face{font-family:SpaceMono;font-weight:400;src:url(${font('spacemono-400.woff2')})}
@font-face{font-family:SpaceMono;font-weight:700;src:url(${font('spacemono-700.woff2')})}
*{box-sizing:border-box;margin:0;padding:0}
body{width:1080px;height:1350px;overflow:hidden;-webkit-font-smoothing:antialiased}
`;

// 1. Essay page --------------------------------------------------------------
const mistake = `<style>
body{background:#2b2660;background:radial-gradient(120% 90% at 30% 20%,#3a3480 0%,#1e1a50 70%);font-family:Caveat,cursive}
.paper{position:absolute;left:90px;top:150px;width:900px;height:1020px;background:#fffdf6;border-radius:6px;transform:rotate(-2.2deg);
  box-shadow:0 40px 80px -30px rgba(0,0,0,.6);
  background-image:linear-gradient(90deg,transparent 108px,#f2a6b3 108px,#f2a6b3 111px,transparent 111px),
    repeating-linear-gradient(180deg,transparent 0 69px,#c9d8ef 69px 71px);background-position:0 0,0 110px}
.txt{position:absolute;left:140px;right:50px;top:116px;font-size:58px;line-height:70px;color:#253a7a}
.txt .h{color:#253a7a;font-weight:700}
.wrong{position:relative;display:inline-block}
.wrong svg{position:absolute;left:-18px;top:-8px;width:150px;height:84px;overflow:visible}
.fix{position:absolute;left:30px;top:-60px;color:#d0142e;font-size:62px;transform:rotate(-4deg);white-space:nowrap}
.note{position:absolute;right:90px;top:478px;color:#d0142e;font-size:50px;transform:rotate(-5deg);line-height:1}
.pen{color:#d0142e;font-size:60px;line-height:70px;position:absolute;left:150px;right:60px;bottom:70px;transform:rotate(-1.5deg)}
.sticky{position:absolute;right:58px;top:46px;width:330px;padding:28px 26px 30px;background:#ffe36e;transform:rotate(5deg);
  box-shadow:0 22px 40px -18px rgba(0,0,0,.55);font-size:62px;line-height:1;color:#1e1a50;text-align:center;font-weight:700}
.foot{position:absolute;left:0;right:0;bottom:44px;display:flex;align-items:center;justify-content:center;gap:26px;font-family:Figtree;color:#fff;font-size:30px;font-weight:600}
.foot img{height:76px}
</style>
<div class="paper">
  <div class="txt"><span class="h">Task 2</span><br>In recent years,<br>the number of students
    <span class="wrong">have<svg viewBox="0 0 150 84"><ellipse cx="75" cy="44" rx="72" ry="36" fill="none" stroke="#d0142e" stroke-width="5" transform="rotate(-6 75 44)"/></svg><span class="fix">has</span></span><br>
    increased in many countries,<br>and this trend is likely to<br>continue…</div>
  <div class="note">−1 grammar</div>
  <div class="pen">Small slips like this<br>cost you marks.<br>We correct your essays<br>live, one-on-one. ✓</div>
</div>
<div class="sticky">Can you spot the mistake?</div>
<div class="foot"><img src="${LOGO_W}" alt="">One-on-one IELTS coaching · Chat on WhatsApp</div>`;

// 2. Departures board --------------------------------------------------------
const flap = (s, cls = '') => [...s].map(c => `<i class="${cls}">${c === ' ' ? '&nbsp;' : c}</i>`).join('');
const rows = [
  ['TORONTO', 'CANADA PR · EXPRESS ENTRY · IELTS GENERAL', '6.0 EACH'],
  ['LONDON', 'NURSING · NMC · IELTS ACADEMIC (WRITING 6.5)', '7.0'],
  ['SYDNEY', 'UNIVERSITY · MOST COURSES · OVERALL', '6.0-6.5'],
];
const band = `<style>
body{background:#0e0d16;font-family:SpaceMono,monospace;color:#ffc531}
.wrap{padding:76px 56px 0}
.top{display:flex;justify-content:space-between;align-items:center;border-bottom:3px solid #2a2836;padding-bottom:26px}
.top b{font-size:58px;letter-spacing:.06em}
.top span{font-size:26px;color:#a49f8a;text-align:right;line-height:1.3}
.q{font-family:Figtree;font-weight:700;font-size:58px;line-height:1.1;color:#fff;margin:40px 0 34px}
.cols{display:flex;justify-content:space-between;font-size:22px;color:#77735f;letter-spacing:.12em;margin-bottom:16px}
.row{padding:22px 0 26px;border-bottom:2px dashed #2a2836}
.line{display:flex;justify-content:space-between;align-items:center}
.flaps{display:flex;gap:5px}
i{font-style:normal;display:grid;place-items:center;width:52px;height:76px;background:linear-gradient(180deg,#22212d 0 49%,#0e0d16 49% 51%,#1b1a24 51%);
  border-radius:6px;font-size:52px;font-weight:700;color:#ffc531;box-shadow:inset 0 -2px 0 rgba(255,255,255,.04)}
i.g{color:#5df28b}
.sub{font-size:23px;color:#c9c3a8;margin-top:14px;letter-spacing:.03em}
.you .flaps i{color:#fff}
.status{font-size:26px;font-weight:700;padding:10px 18px;border-radius:6px;background:#5df28b;color:#0e0d16}
.fine{font-family:Figtree;font-size:24px;color:#77735f;margin-top:24px}
.foot{position:absolute;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:30px 56px 40px;border-top:3px solid #2a2836;font-family:Figtree;font-size:30px;font-weight:600;color:#fff}
.foot img{height:80px}
</style>
<div class="wrap">
  <div class="top"><b>DEPARTURES</b><span>IELTS BAND<br>NEEDED</span></div>
  <div class="q">What IELTS band do you need?</div>
  <div class="cols"><span>DESTINATION</span><span>BAND</span></div>
  ${rows.map(([d, s, b]) => `<div class="row"><div class="line"><div class="flaps">${flap(d)}</div><div class="flaps">${flap(b)}</div></div><div class="sub">${s}</div></div>`).join('')}
  <div class="row you"><div class="line"><div class="flaps">${flap('YOU?')}</div><span class="status">ASK US ON WHATSAPP</span></div><div class="sub">TELL US YOUR GOAL AND TEST DATE. WE PLAN YOUR PREPARATION.</div></div>
  <div class="fine">Typical requirements. Always check your university or visa rules.</div>
</div>
<div class="foot"><span>Casper Academy · one-on-one online classes</span><img src="${LOGO_W}" alt=""></div>`;

// 3. Chat ---------------------------------------------------------------------
const tick = '<svg viewBox="0 0 18 12" width="22" height="15"><path d="M1 6.5 4.5 10 11 2M7 9.5 7.5 10 14 2" fill="none" stroke="#4f8df5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
const accent = `<style>
body{background:#ece9f6;font-family:Inter,sans-serif;color:#15132e}
.bar{height:150px;background:#1e1a50;display:flex;align-items:center;gap:24px;padding:0 44px;color:#fff}
.av{width:92px;height:92px;border-radius:50%;background:#fff;display:grid;place-items:center;overflow:hidden}
.av img{width:84px}
.bar b{display:block;font-size:36px;font-weight:600}
.bar small{font-size:25px;opacity:.75}
.chat{padding:34px 44px;display:flex;flex-direction:column;gap:16px;
  background-image:radial-gradient(#d9d4ee 1.6px,transparent 1.6px);background-size:34px 34px;height:1060px}
.day{align-self:center;font-size:22px;background:#fff;color:#6b6890;padding:8px 18px;border-radius:12px}
.m{max-width:930px;padding:18px 26px 12px;border-radius:30px;font-size:35px;line-height:1.32;box-shadow:0 2px 0 rgba(30,26,80,.06);position:relative}
.m .t{display:flex;justify-content:flex-end;align-items:center;gap:6px;font-size:21px;color:#8a87a6;margin-top:6px}
.me{align-self:flex-end;background:#d8f5c8;border-bottom-right-radius:8px}
.th{align-self:flex-start;background:#fff;border-bottom-left-radius:8px}
.big{font-family:Fraunces,serif;font-weight:600;font-size:104px;line-height:1;color:#c8183f}
.ul{list-style:none;margin-top:8px;display:grid;gap:2px}
.ul li:before{content:"✓ ";color:#1a9e5c;font-weight:700}
.foot{position:absolute;left:0;right:0;bottom:0;height:140px;background:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 44px;font-size:30px;font-weight:600;color:#1e1a50;border-top:1px solid #dcd8ec}
.foot img{height:84px}
</style>
<div class="bar"><div class="av"><img src="${LOGO}" alt=""></div><div><b>Casper Academy · IELTS trainer</b><small>online</small></div></div>
<div class="chat">
  <div class="m me">Do I need a British accent to get Band 8 in Speaking? 😟<div class="t">7:42 pm ${tick}</div></div>
  <div class="m th"><div class="big">No.</div><div class="t">7:43 pm</div></div>
  <div class="m th">Examiners don't score your accent. They score:<ul class="ul"><li>Fluency</li><li>Vocabulary</li><li>Grammar</li><li>Pronunciation (clear, not British)</li></ul><div class="t">7:43 pm</div></div>
  <div class="m me">So my Malayalam accent is fine? 😅<div class="t">7:44 pm ${tick}</div></div>
  <div class="m th">Totally fine, as long as you're clear. Let's practise together 💪<div class="t">7:44 pm</div></div>
</div>
<div class="foot"><span>One-on-one IELTS coaching, online</span><img src="${LOGO}" alt=""></div>`;

const ads = { 'mistake-v3': mistake, 'band-needed-v3': band, 'accent-myth-v3': accent };

(async () => {
  const browser = await chromium.launch();
  for (const [name, html] of Object.entries(ads)) {
    const p = await browser.newPage({ viewport: { width: 1080, height: 1350 } });
    await p.setContent(`<!doctype html><meta charset="utf-8"><style>${BASE}</style>${html}`);
    await p.evaluate(() => document.fonts.ready);
    const file = `${OUT}${name}.jpg`;
    await p.screenshot({ path: file, type: 'jpeg', quality: 90 });
    await p.close();
    console.log(file);
  }
  await browser.close();
})();
