# Finovate Measurements (source for spacing + motion tokens)

Per CLAUDE.md §9 step 1. **All values below are `[[TODO: measure]]` until captured from the live demo**
(https://finovate.vamtam.com) with Playwright once web egress is enabled — see `tools/finovate-measure.mjs`.
Only sections we KEEP (per `docs/layout-reference.md`) are measured. No value here may be invented; unmeasured
tokens must not ship silently.

Capture at breakpoints **1440px** and **390px** (theme breakpoints 1024 / 767 also noted where they differ).
Raw output lands in `docs/finovate-raw-measurements.json`; distilled tokens are transcribed here, then fed into
`assets/css/site.css` `:root`.

---

## Global (measure once)
| Token | 1440px | 390px | Notes |
|---|---|---|---|
| Container max-width | `[[TODO]]` (brief states 1280) | — | content width |
| Page side gutter | `[[TODO]]` | `[[TODO]]` | |
| Header height — normal | `[[TODO]]` | `[[TODO]]` | |
| Header height — scrolled | `[[TODO]]` | `[[TODO]]` | sticky shrink target |
| Header scroll trigger point | `[[TODO]]` | | px scrolled before shrink/bg change |
| Section padding — top/bottom (default) | `[[TODO]]` | `[[TODO]]` | the section rhythm |
| Section padding — compact variant | `[[TODO]]` | `[[TODO]]` | if any |
| Grid column gap | `[[TODO]]` | `[[TODO]]` | |
| Grid row gap | `[[TODO]]` | `[[TODO]]` | |

## Cards & tiles
| Token | 1440px | 390px | Notes |
|---|---|---|---|
| Practice-area card — padding | `[[TODO]]` | `[[TODO]]` | corners: SQUARE (YSL, not Finovate 9px) |
| Practice-area card — min height / ratio | `[[TODO]]` | `[[TODO]]` | |
| Partner card — dimensions / image ratio | `[[TODO]]` | `[[TODO]]` | |
| Related card — dimensions | `[[TODO]]` | `[[TODO]]` | |
| Grid columns (practice areas) | `[[TODO]]` | `[[TODO]]` | e.g. 3 / 2 / 1 |

## Buttons & pills
| Token | Value | Notes |
|---|---|---|
| Button padding (x / y) | `[[TODO]]` | |
| Button height | `[[TODO]]` | |
| Button radius | `[[TODO]]` | pill (brief: 100px) |
| Pill/chip padding | `[[TODO]]` | Authorities & Forums chips |
| Pill radius | `[[TODO]]` | 100px |

## Type scale (relative sizes + line-heights, per breakpoint)
Follow Finovate's RHYTHM, adjusted for Sora/IBM Plex Sans. **Never** its uppercase transform.
| Role | 1440 size / line-height | 390 size / line-height |
|---|---|---|
| H1 | `[[TODO]]` | `[[TODO]]` |
| H2 | `[[TODO]]` | `[[TODO]]` |
| H3 | `[[TODO]]` | `[[TODO]]` |
| H4 | `[[TODO]]` | `[[TODO]]` |
| Body | `[[TODO]]` | `[[TODO]]` |
| Small / caption | `[[TODO]]` | `[[TODO]]` |

## Motion (record property · duration · easing · delay/stagger)
Only for kept sections. Respect `prefers-reduced-motion` (all off).
| Interaction | Property | Duration | Easing | Delay / stagger | Notes |
|---|---|---|---|---|---|
| Sticky header shrink/bg | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | trigger point above |
| Nav hover / active | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |
| Button hover (+ arrow) | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |
| Card hover (practice / partner / related) | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |
| Scroll-in reveal (section/card) | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | start offset + entrance distance |
| Mobile menu open/close | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |
| Link / pill hover | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |
| Form field focus | `[[TODO]]` | `[[TODO]]` | `[[TODO]]` | — | |

---

## Per-page section confirmation
Confirm each KEEP section from `layout-reference.md` renders as expected on the live demo, and note the exact
demo URL captured (the §9 list uses generic paths; real URLs to be recorded on first capture):
- [ ] Home (Consulting) — `[[TODO: url]]`
- [ ] Services / Practice-areas hub — `[[TODO: url]]`
- [ ] Single service — `[[TODO: url]]`
- [ ] About / The Firm — `[[TODO: url]]`
- [ ] About → Team — `[[TODO: url]]`
- [ ] Industries / Clients — `[[TODO: url]]`
- [ ] About → Careers — `[[TODO: url]]`
- [ ] Contact — `[[TODO: url]]`
