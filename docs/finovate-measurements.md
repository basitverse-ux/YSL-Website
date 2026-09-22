# Finovate Measurements (source for spacing + motion tokens)

> **Captured values supplied via YSL build handoff (2026-09-22).** The live-demo
> Playwright capture (§9 step 1) is still blocked in this environment (egress policy
> denies `finovate.vamtam.com`), but the handoff provided real measured values from
> the live demo at 1440px & 375px. Those are transcribed below and applied to
> `assets/css/site.css` `:root`. Full-page Finovate reference screenshots live in
> `reference/finovate/` (git-ignored). H3/H4 sizes and scroll-reveal timing are the
> only values NOT in the handoff — they are marked *(derived)* and remain to be
> confirmed visually.
>
> ⚠️ **Two contradictions between the handoff's numbers and its own screenshots**
> (flagged to the user, awaiting confirmation):
> 1. **Button shape.** Handoff says buttons are square (0px). Every reference
>    screenshot shows **rounded pill** buttons. Applied **square 0px** per the
>    explicit written instruction; one-token reversal if it was a slip.
> 2. **Header colour.** Handoff says the header turns **solid `--ink` (dark)**.
>    The screenshots show a **light/cream** header with dark nav text. Kept the
>    **light** header (matches screenshots); hide-on-scroll behaviour applied.

---

## 1. Typography (measured — 1440 / 375)
Family is YSL's: **Sora** headings, **IBM Plex Sans** body (self-hosted). Sentence
case except the 11px eyebrow. Headings are **light (weight 400)**, line-height ~1.1.
Body line-height 1.4.

| Role | Desktop (1440) | Mobile (375) | Weight | Case | Token |
|---|---|---|---|---|---|
| Hero heading (home) | 58px / lh 58 (1.0) | 32px / lh 38.4 | 500 | none | `--fs-hero` |
| Display heading (section) | 52px / lh 57.2 (1.1) | 32px / lh 38.4 | 400 | none | `--fs-h1` |
| Page title (inner hero) | 52px / lh 57.2 | 32px / lh 38.4 | 400 | none | `--fs-h1` |
| Sub-heading (service section) | 48px / lh 57.6 (1.2) | 28px / lh 36.4 | 400 | none | `--fs-h2` |
| Contact title | 48px | 28px | 400 | none | `--fs-h2` |
| Card / minor heading *(derived)* | ~24px | ~20px | 400 | none | `--fs-h3` |
| Small heading *(derived)* | ~20px | ~18px | 500 | none | `--fs-h4` |
| Eyebrow label | 11px / lh 19.8 | 11px | 500 | **UPPERCASE** | `--fs-eyebrow` |
| Body | 16px / lh 22.4 (1.4) | 16px | 400 | none | `--fs-body` |
| Body (service/inner pages) | 18px / lh 25.2 (1.4) | 18px | 400 | none | `--fs-body-lg` |

## 2. Buttons (measured)
- Padding: **18px top / 20px sides / 20px bottom** → `--btn-pad: 18px 20px 20px`.
- Border-radius: **0px (square)** → `--radius-btn: 0`. *(Contradicts screenshots — see box above.)*
- Transition: **0.3s** → `--dur: 300ms`.
- **Chips** (Authorities & Forums) stay **pill** (`--radius-pill: 100px`), per CLAUDE.md §5
  and the screenshots.

## 3. Colour & section rhythm (measured)
- YSL palette unchanged: `--ink #111`, `--cream #F5EDE6`, `--paper` near-white, `--accent` orange.
- Sections are **full-bleed backgrounds with a boxed 1280 inner container**, alternating
  **paper/white ↔ cream**, with occasional **dark (`--ink`) bands** for emphasis.
  (Finovate uses `#F6F5F2` light + `#1C4B42` dark band → mapped to YSL paper/cream/ink.)

## 4. Header (measured)
- **Desktop:** home **110px**, starts transparent, turns solid on scroll-up reveal;
  inner pages **80px** solid. **Hides on scroll-down, reveals on scroll-up.**
  Transitions: `transform / top / opacity 0.15s linear`, `background-color 0.35s`.
  No shadow, no blur. → `--header-h: 80px`, `--header-h-home: 110px`,
  `--dur-header: 150ms`, `--dur-header-bg: 350ms`.
- **Mobile:** **~66px**, solid, fixed, always visible → `--header-h-mobile: 66px`.
- No `backdrop-filter` (correct; removed in Milestone 1). *(Colour: kept light per
  screenshots — see box above.)*

## 5. Layout & spacing (measured)
- **Content container: 1280px** (→ 80px gutter each side at 1440 via auto-margins) → `--container: 1280px`.
- **Half-column ~630px** for two-up rows inside the container.
- **Section vertical padding (desktop):** outer sections **~48px**, hero/feature **~50px**,
  inner sub-blocks **~30px**, thin accent/stat bands **~20px**. Adjacent sections stack to a
  **~70–80px visual gap** — the target rhythm. →
  `--section-pad-y: clamp(30px, 3.3vw, 48px)`, `--section-pad-y-sm: clamp(20px, 2.2vw, 30px)`.
- **Mobile section padding:** ~30px outer / ~20px inner.
- **Cards:** `32px` padding / `24px` gap → `--card-pad: 32px`, `--grid-gap: 24px`. Corners
  **square** (YSL brand; Finovate's own cards are ~9px rounded).
- Breakpoints: **1024px** and **767px**.

## 6. Motion
| Interaction | Duration | Easing | Notes |
|---|---|---|---|
| Button / link / card hover | 300ms | ease-out | measured 0.3s |
| Header hide/reveal (transform, opacity) | 150ms | linear | measured |
| Header background change | 350ms | — | measured |
| Mobile menu open/close | ~300ms | ease-in-out | tune vs demo |
| Scroll-in reveal *(derived)* | ~500ms | ease-out | offset/stagger not in handoff — confirm visually |

All motion respects `prefers-reduced-motion` (off).

---

## Per-page reference screenshots (in `reference/finovate/`)
`home-desktop-2`, `home-mobile-1/3/5`, `service-single-desktop`, `service-single-mobile-1/2`,
`team-desktop`, `contact-desktop`, `contact-mobile-1/2/3`. Match spacing/whitespace/proportion
to these by eye; the numbers above are the anchors.
