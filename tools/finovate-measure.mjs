// finovate-measure.mjs — CLAUDE.md §9 step 1 capture tool. DEV-ONLY, never deployed.
//
// Prereq: web egress enabled + Playwright resolvable.
//   npm i -D playwright     (browsers are pre-installed at /opt/pw-browsers, so no re-download)
// Run:
//   node tools/finovate-measure.mjs
//
// Output:
//   reference/<name>-<width>.png          full-page screenshots (reference/ is git-ignored)
//   docs/finovate-raw-measurements.json   computed styles + transitions per page/section
//
// NOTE: URLs and SELECTORS below are best-guess and MUST be confirmed against the live demo on the
// first run (the site is a demo-switcher; the "Consulting" demo is the one layout-reference.md maps).
// Tune PAGES[].url and SELECTORS, then re-run. Nothing here is invented into tokens — it only records.

import { chromium } from 'playwright';
import { mkdir, writeFile } from 'node:fs/promises';

const BASE = 'https://finovate.vamtam.com';
const WIDTHS = [1440, 390];
const CHROMIUM = process.env.PLAYWRIGHT_CHROMIUM || '/opt/pw-browsers/chromium';

// §9 named pages — adjust paths after confirming the live nav.
const PAGES = [
  { name: 'home',        url: `${BASE}/` },
  { name: 'services',    url: `${BASE}/services/` },
  { name: 'service',     url: `${BASE}/services/` },        // → replace with one real single-service URL
  { name: 'about',       url: `${BASE}/about/` },
  { name: 'team',        url: `${BASE}/about/team/` },
  { name: 'industries',  url: `${BASE}/industries/` },
  { name: 'careers',     url: `${BASE}/about/careers/` },
  { name: 'contact',     url: `${BASE}/contact-us/` },
];

// Elements to read computed styles from. Tune to the live DOM after inspecting once.
const SELECTORS = {
  header:  'header, .site-header, [class*="header"]',
  section: 'section, .elementor-section',
  card:    '[class*="card"], article',
  button:  'a[class*="button"], .elementor-button, button',
  pill:    '[class*="pill"], [class*="chip"], [class*="tag"]',
  h1: 'h1', h2: 'h2', h3: 'h3', h4: 'h4', body: 'p',
};

// Computed-style props to record per §9 (padding, gaps, dims, radius, type, motion).
const PROPS = [
  'width', 'height', 'paddingTop', 'paddingBottom', 'paddingLeft', 'paddingRight',
  'marginTop', 'marginBottom', 'columnGap', 'rowGap', 'gap',
  'borderRadius', 'maxWidth', 'fontFamily', 'fontSize', 'fontWeight', 'lineHeight',
  'letterSpacing', 'textTransform', 'color', 'backgroundColor',
  'transitionProperty', 'transitionDuration', 'transitionTimingFunction', 'transitionDelay',
];

const result = { base: BASE, capturedAt: new Date().toISOString(), widths: WIDTHS, pages: {} };

await mkdir('reference', { recursive: true });
await mkdir('docs', { recursive: true });

const browser = await chromium.launch({ executablePath: CHROMIUM }).catch(() => chromium.launch());

for (const page of PAGES) {
  result.pages[page.name] = { url: page.url, byWidth: {} };
  for (const width of WIDTHS) {
    const ctx = await browser.newContext({ viewport: { width, height: 900 }, deviceScaleFactor: 2 });
    const pg = await ctx.newPage();
    const rec = { selectors: {}, header: {} };
    try {
      await pg.goto(page.url, { waitUntil: 'networkidle', timeout: 45000 });
      await pg.waitForTimeout(800);

      // screenshot
      await pg.screenshot({ path: `reference/${page.name}-${width}.png`, fullPage: true });

      // computed styles per selector
      for (const [key, sel] of Object.entries(SELECTORS)) {
        rec.selectors[key] = await pg.evaluate(({ sel, props }) => {
          const el = document.querySelector(sel);
          if (!el) return null;
          const cs = getComputedStyle(el);
          const out = {};
          for (const p of props) out[p] = cs[p];
          const r = el.getBoundingClientRect();
          out._rect = { w: Math.round(r.width), h: Math.round(r.height) };
          return out;
        }, { sel, props: PROPS }).catch(() => null);
      }

      // header height normal vs scrolled (sticky change point)
      const headerSel = SELECTORS.header;
      rec.header.normal = await pg.evaluate((s) => {
        const el = document.querySelector(s); return el ? Math.round(el.getBoundingClientRect().height) : null;
      }, headerSel);
      await pg.evaluate(() => window.scrollTo(0, 600));
      await pg.waitForTimeout(500);
      rec.header.scrolled = await pg.evaluate((s) => {
        const el = document.querySelector(s); return el ? Math.round(el.getBoundingClientRect().height) : null;
      }, headerSel);
    } catch (e) {
      rec.error = String(e);
      console.error(`! ${page.name} @${width}: ${e.message}`);
    }
    result.pages[page.name].byWidth[width] = rec;
    console.log(`captured ${page.name} @${width}px`);
    await ctx.close();
  }
}

await browser.close();
await writeFile('docs/finovate-raw-measurements.json', JSON.stringify(result, null, 2));
console.log('\nDone → docs/finovate-raw-measurements.json + reference/*.png');
console.log('Next: transcribe distilled tokens into docs/finovate-measurements.md, then site.css :root.');
