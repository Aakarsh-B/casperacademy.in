const { chromium } = require('playwright');
const fs = require('fs'), path = require('path');
const ROOT = path.join(__dirname, '../../assets/img/');
const OUT = path.join(__dirname, '../../social/2026-10-instagram/');
const b64 = f => 'data:image/' + (f.endsWith('png') ? 'png' : 'jpeg') + ';base64,' + fs.readFileSync(ROOT + f).toString('base64');
const LOGO_W = b64('logo-white.png'), LOGO = b64('logo.png');
const CSS = `
@import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Figtree:wght@400;500;600;700&display=swap');
*{box-sizing:border-box;margin:0}
body{width:1080px;height:1350px;overflow:hidden;font-family:Figtree,sans-serif;-webkit-font-smoothing:antialiased}
.s{width:1080px;height:1350px;position:relative;display:flex;flex-direction:column;padding:96px 92px 84px}
.navy{background:#1e1a50;color:#fff}.light{background:#f7f6fb;color:#1e1a50}.white{background:#fff;color:#1e1a50}
.eyebrow{font-weight:700;font-size:26px;letter-spacing:.14em;text-transform:uppercase;color:#c8183f}
.navy .eyebrow{color:#ff8fa6}
h1{font-family:Fraunces,serif;font-weight:600;font-size:112px;line-height:1.04;letter-spacing:-.01em;margin-top:28px}
h2{font-family:Fraunces,serif;font-weight:600;font-size:86px;line-height:1.08;margin-top:24px}
.lead{font-size:46px;line-height:1.4;margin-top:36px;opacity:.9;max-width:860px}
.big{font-family:Fraunces,serif;font-weight:600;font-size:180px;line-height:1;color:#c8183f;margin-top:40px}
.navy .big{color:#ff6f8d}
.mid{margin:auto 0;display:flex;flex-direction:column}.top .mid{margin:0}
.foot{margin-top:auto;display:flex;align-items:flex-end;justify-content:space-between;gap:24px;font-size:26px;font-weight:600}
.foot img{height:96px}
.pg{font-size:26px;font-weight:700;opacity:.55}
.swipe{display:inline-flex;align-items:center;gap:14px;margin-top:56px;font-weight:700;font-size:34px;color:#fff;background:#c8183f;border-radius:999px;padding:18px 34px;align-self:flex-start}
.list{list-style:none;padding:0;margin-top:44px;display:grid;gap:26px}
.list li{font-size:48px;line-height:1.3;display:flex;gap:22px;align-items:flex-start}
.list li b{flex:none;width:72px;height:72px;border-radius:50%;background:#c8183f;color:#fff;display:grid;place-items:center;font-size:30px}
.pair{margin-top:40px;display:grid;gap:26px}
.bad,.good{border-radius:28px;padding:36px 40px;font-size:50px;line-height:1.35}
.bad{background:#fde8ed;color:#7d0f28}.good{background:#e3f4ec;color:#0d5a3f}
.bad small,.good small{display:block;font-size:24px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;margin-bottom:8px}
.cols{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:48px}
.col{border-radius:28px;padding:40px 36px;background:#fff;color:#1e1a50}
.col.r{background:#c8183f;color:#fff}
.col h3{font-family:Fraunces,serif;font-size:64px;font-weight:600;margin-bottom:24px}
.col p{font-size:38px;line-height:1.35;padding:16px 0;border-top:2px solid rgba(30,26,80,.12)}
.col.r p{border-color:rgba(255,255,255,.3)}
.photo{position:absolute;inset:0 0 auto 0;height:640px;background-size:cover;background-position:center 30%}
.photo:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(30,26,80,0) 40%,#1e1a50 100%)}
.chips{display:flex;flex-wrap:wrap;gap:16px;margin-top:40px}
.chips span{font-size:30px;font-weight:600;border:2px solid rgba(255,255,255,.4);border-radius:999px;padding:14px 26px}
.calc{margin-top:48px;background:#fff;color:#1e1a50;border-radius:32px;padding:44px 48px;display:grid;gap:4px}
.calc div{display:flex;justify-content:space-between;font-size:42px;padding:16px 0;border-bottom:2px solid #ecebf3}
.calc div b{font-variant-numeric:tabular-nums}
.calc .tot{border:0;margin-top:12px;font-family:Fraunces,serif;font-size:58px;color:#c8183f}
.stars{font-size:110px;letter-spacing:12px;color:#f5b301;margin-top:20px}
.accent{color:#c8183f}.navy .accent{color:#ff8fa6}
.note{margin-top:44px;font-size:40px;line-height:1.45;border-left:8px solid #c8183f;padding-left:30px}
`;
const foot = (dark, pg) => `<div class="foot"><img src="${dark ? LOGO_W : LOGO}" alt=""><span class="pg">${pg || 'WhatsApp +91 81 36 835 444'}</span></div>`;
const S = (cls, inner, pg) => `<div class="s ${cls}"><div class="mid">${inner}</div>${foot(cls.startsWith('navy'), pg)}</div>`;
const posts = {
 '01-online-intro': [S('navy top', `<div class="photo" style="background-image:url(${b64('photos/ielts-hero.jpg')})"></div><div style="margin-top:500px;position:relative"><div class="eyebrow">Casper Academy of Excellence</div><h1 style="font-size:84px">25+ years of coaching.<br>Now <span class="accent">fully online.</span></h1><p class="lead" style="font-size:36px">One-on-one IELTS, PTE and Communicative English classes, from anywhere in Kerala.</p><div class="chips"><span>Personal speaking practice</span><span>On-the-spot essay corrections</span><span>Weekly mock tests</span></div></div>`, 'casperacademy.in')],
 '02-ielts-tfng': [
  S('navy', `<div class="eyebrow">IELTS Reading</div><h1>True, False or <span class="accent">Not Given?</span></h1><p class="lead">The IELTS Reading question that traps most students.</p><span class="swipe">Swipe →</span>`, '1 / 5'),
  S('light', `<div class="eyebrow">Answer</div><div class="big">TRUE</div><h2>The passage says the same thing.</h2><p class="lead">Usually in different words, so look for synonyms, not exact matches.</p>`, '2 / 5'),
  S('light', `<div class="eyebrow">Answer</div><div class="big">FALSE</div><h2>The passage says the opposite.</h2><p class="lead">It directly contradicts the statement.</p>`, '3 / 5'),
  S('light', `<div class="eyebrow">Answer</div><div class="big" style="font-size:130px">NOT GIVEN</div><h2>The passage does not say it at all.</h2><p class="lead">Never use your own knowledge. Only the passage counts.</p>`, '4 / 5'),
  S('navy', `<div class="eyebrow">Quick tip</div><h2 style="font-size:76px">Underline the keyword, then hunt for its synonym in the passage.</h2><p class="lead">Read the full guide on our blog:<br><b>casperacademy.in/blog</b></p>`, '5 / 5')],
 '03-pte-describe-image': [
  S('navy', `<div class="eyebrow">PTE Academic</div><h1>Describe Image in <span class="accent">4 steps</span></h1><p class="lead">25 seconds to prepare. 40 seconds to speak.</p><span class="swipe">Swipe →</span>`, '1 / 5'),
  S('light', `<div class="eyebrow">Step 1</div><h2>Topic</h2><p class="lead">Say what the image shows, using its own title and labels.</p><p class="note">“This bar chart compares daily screen time across four age groups.”</p>`, '2 / 5'),
  S('light', `<div class="eyebrow">Step 2</div><h2>Main feature</h2><p class="lead">The highest value, the biggest change or the first stage of a process.</p>`, '3 / 5'),
  S('light', `<div class="eyebrow">Steps 3 and 4</div><h2>Details, then a conclusion</h2><p class="lead">Compare two or three points with real numbers. Finish with one short takeaway, before 40 seconds.</p>`, '4 / 5'),
  S('navy', `<div class="eyebrow">Important</div><h2 style="font-size:70px">Never memorise a script.</h2><p class="lead">Pearson can score a memorised answer zero for content. Use a structure, not a speech.</p><p class="lead"><b>PTE coaching: casperacademy.in/pte</b></p>`, '5 / 5')],
 '04-ielts-or-pte': [S('light', `<div class="eyebrow">Choosing your test</div><h1 style="font-size:88px">IELTS or PTE?</h1><div class="cols"><div class="col"><h3>IELTS</h3><p>Paper or computer</p><p>Speaking with a real examiner</p><p>Very widely accepted</p></div><div class="col r"><h3>PTE</h3><p>Computer only</p><p>Speaking scored by AI</p><p>Results usually in about 2 days</p></div></div><p class="lead" style="font-size:34px">Not sure which fits your plan? Message us and we will help you choose.</p>`)],
 '05-ielts-grammar': [
  S('navy', `<div class="eyebrow">IELTS Writing</div><h1 style="font-size:88px">5 grammar mistakes that <span class="accent">cost you marks</span></h1><p class="lead">Check yours before test day.</p><span class="swipe">Swipe →</span>`, '1 / 6'),
  S('light', `<div class="eyebrow">Mistake 1 · Agreement</div><div class="pair"><div class="bad"><small>Wrong</small>The number of students have increased.</div><div class="good"><small>Right</small>The number of students has increased.</div></div>`, '2 / 6'),
  S('light', `<div class="eyebrow">Mistake 2 · Comma splice</div><div class="pair"><div class="bad"><small>Wrong</small>Technology is useful, it saves time.</div><div class="good"><small>Right</small>Technology is useful because it saves time.</div></div>`, '3 / 6'),
  S('light', `<div class="eyebrow">Mistake 3 · Uncountable nouns</div><div class="pair"><div class="bad"><small>Wrong</small>Many informations are available online.</div><div class="good"><small>Right</small>A lot of information is available online.</div></div>`, '4 / 6'),
  S('light', `<div class="eyebrow">Mistakes 4 and 5 · Articles and pronouns</div><div class="pair"><div class="bad"><small>Wrong</small>Government should invest in education.</div><div class="good"><small>Right</small>The government should invest in education.</div><div class="bad"><small>Wrong</small>People which live in cities…</div><div class="good"><small>Right</small>People who live in cities…</div></div>`, '5 / 6'),
  S('navy', `<div class="eyebrow">Fix them faster</div><h2>Get your essays corrected on the spot.</h2><p class="lead">One-on-one online IELTS classes with 25+ years of experience behind them.</p><p class="lead"><b>casperacademy.in/ielts</b></p>`, '6 / 6')],
 '06-crack-ielts-first-attempt': [
  S('navy', `<div class="eyebrow">Save this</div><h1>Crack IELTS in your <span class="accent">first attempt</span></h1><p class="lead">7 steps our students follow.</p><span class="swipe">Swipe →</span>`, '1 / 4'),
  S('light', `<div class="eyebrow">Before you start</div><ul class="list"><li><b>1</b>Know the test format inside out</li><li><b>2</b>Take a full mock test first to find your level</li><li><b>3</b>Set a target band for each module</li></ul>`, '2 / 4'),
  S('light', `<div class="eyebrow">Every week</div><ul class="list"><li><b>4</b>Use English every day, not just in class</li><li><b>5</b>Get your writing corrected, not just checked</li><li><b>6</b>Practise speaking with a real person</li><li><b>7</b>Take a timed mock test</li></ul>`, '3 / 4'),
  S('navy', `<div class="eyebrow">Last step</div><h2>Book your exam when your mock scores are steady.</h2><p class="lead">Full guide on our blog:<br><b>casperacademy.in/blog</b></p>`, '4 / 4')],
 '07-band-calculator': [S('navy', `<div class="eyebrow">Free tool</div><h1 style="font-size:84px">What is your overall <span class="accent">IELTS band?</span></h1><div class="calc"><div>Listening<b>7.5</b></div><div>Reading<b>7.0</b></div><div>Writing<b>6.5</b></div><div>Speaking<b>7.0</b></div><div class="tot">Overall<b>7.0</b></div></div><p class="lead" style="font-size:34px">Enter your four scores and our free calculator does the rounding. <b>casperacademy.in/ielts</b></p>`, 'Free, no sign-up')],
 '08-google-review': [S('light', `<div class="eyebrow">A small favour</div><div class="stars">★★★★★</div><h1 style="font-size:84px">Studied with us? Tell others how it went.</h1><p class="lead">Your Google review helps the next student find the right coaching. Mention your test and band score if you are happy to.</p><p class="note">Search <b>Casper Academy of Excellence</b> on Google and tap <b>Write a review</b>.</p>`, 'Thank you for 25+ years of trust')],
};
(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage({ viewport: { width: 1080, height: 1350 } });
  for (const [name, slides] of Object.entries(posts)) {
    for (let i = 0; i < slides.length; i++) {
      await page.setContent(`<!doctype html><html><head><meta charset="utf-8"><style>${CSS}</style></head><body>${slides[i]}</body></html>`, { waitUntil: 'networkidle' });
      await page.evaluate(() => document.fonts.ready);
      const file = path.join(OUT, slides.length > 1 ? `${name}-${i + 1}.png` : `${name}.png`);
      await page.screenshot({ path: file });
    }
  }
  await browser.close();
  console.log('done');
})();
