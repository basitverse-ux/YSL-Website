# CONTENT-TODO — YSL Website

Every missing, unverified, or blocked piece of content, per CLAUDE.md §0.4 (never invent content).
Anything unresolved here that reaches a page must appear as a visible `[[TODO: …]]` placeholder.

_Last updated: 2026-09-22_

---

## Decisions locked
- **Typography:** Pairing **B — Sora (headings) / IBM Plex Sans (body)**, self-hosted (OFL). May be overridden if the firm supplies actual brand fonts.
- **Colours:** using the §5 *sampled* values (orange `#E8912A`, ink `#111111`, cream `#F5EDE6`, etc.) as **placeholders** — replace with exact brand values / logo files when supplied.

---

## Blocked content — needed before the relevant page is "done" (CLAUDE.md §10)
- [ ] **The Firm — values / approach copy** — not yet supplied by firm. Section stubbed with `[[TODO]]`.
- [ ] **Practice-area icons** — profile-PDF icon source files from firm; else fall back to Lucide/Tabler inline SVG.
- [ ] **Clients — sector descriptions** — to draft from the client list; **no client names/logos** until written consent (`clients.json → "consent": true`). Assume none set at launch.
- [ ] **Disclaimer** copy — firm must supply/approve (Claude may draft a clearly-marked first draft).
- [ ] **Privacy Policy** copy — firm must supply/approve (required: Contact + Careers collect personal data).
- [ ] **Partner photos** — usable on dark sections only; need original high-res files from firm.
- [ ] **All other photography** — none licensed; shoot recommended. Do NOT reuse the PDF's Dublin/Pantheon stock or any Finovate demo image.
- [ ] **Brand fonts / exact colours / logo files** — firm to supply (see "Decisions locked").

## Build-environment blocker (NOT content — flagged here for visibility)
- [ ] **Finovate measurements (§9 step 1) not captured** — this build environment's egress
  policy denies `finovate.vamtam.com` (403 at the proxy), so no screenshots / computed
  styles could be taken. `assets/css/site.css` `:root` ships with **placeholder** spacing,
  type-scale and motion tokens (each marked `PLACEHOLDER`), built only from constants the
  brief states (container 1280, breakpoints 1024/767, 100px pills, square cards) + a standard
  modular scale — **not measured values**. Layout will not match Finovate until these are
  replaced. To unblock, see the boxed note atop `docs/finovate-measurements.md`.

## Content to produce / verify
- [ ] Home condensed positioning paragraph (condense the full Introduction; do not duplicate The Firm).
- [ ] Practice-areas: **split** Civil & Criminal → *Civil & Commercial Litigation* + *Criminal Defence & White-Collar Crime* (divide + lightly rewrite); **merge** Employment + Industrial Disputes → *Employment, Labour & Industrial Relations* (combine + dedupe); **rename** the two "Regulatory Compliance" entries → *Taxation & Revenue Disputes* and *Regulatory & Administrative Law*.

## Copy fixes to apply while populating (CLAUDE.md §10)
- [ ] "Complaince" → "Compliance" (tagline).
- [ ] "arbitations" → "arbitrations".
- [ ] Review "leading full-service law firm" and "distinguished reputation" with partners before publishing (Rule 135, Ch. XII, Pakistan Legal Practitioners & Bar Councils Rules 1976 — advertising/solicitation).

---

## Pre-deploy blockers — resolve before go-live, NOT before build (CLAUDE.md §10, §12; structure §5)
Build with `site.json` so each is a one-line change:
- [ ] **Sohl vs Sohal** — locks domain + every email address. (Recommended: SOHL, matching the mark.)
- [ ] **Domain** — confirm YSL owns `yasinsohllaw.com` in hPanel (resolves to 2.57.91.91, so registered to *someone*).
- [ ] **Live site check** — I cannot reach `yasinsohllaw.com` from this environment (egress-blocked). **Ayan to confirm what is currently live** before anything touches `public_html`; if content exists, take a full backup first (§12.2).
- [ ] **Address** — Mall Road vs 8 Fane Road; "Centre" vs "Center". One version everywhere, matching the Google Maps pin.
- [ ] **Phone** — profile PDF `+92 322 2000053` (both) vs content doc landline `+92 324 3000053` + mobile/WhatsApp `+92 322 2000053`. Confirm landline is live/answered.
- [ ] **Mailboxes** — create at minimum `info@` and `careers@` on the domain. No Gmail anywhere on the live site.
- [ ] **Founder still in active practice?** — determines whether The Firm founder section reads as legacy vs current leadership.
- [ ] **Hostinger plan** — confirm SSH access + Git deployment enabled (needed for `app/`, `config/` above web root).

## Client-data errors in source (fix before any client link is shown; structure §5)
- [ ] Miso — in PDF logo wall (20) but missing from content-doc list (19).
- [ ] IMC — "IMC Public Health" (PDF) vs linked `imchospital.com.pk` — decide which entity is named.
- [ ] Sitara Textiles link → a LinkedIn "HR Professionals Community" page, not Sitara.
- [ ] SNGPL link → `sitemap.jsp`.
- [ ] Berger link → contact-us with a Google tracking parameter.
- [ ] Both Cantonment Boards → Facebook (one via raw numeric ID).
- [ ] Stock photography (Trinity College Long Room, Pantheon) — confirm licensing before any public reuse; also reconsider foreign landmarks for a Lahore practice.

## Content gaps flagged for later (structure §6)
- [ ] Representative matters (anonymised) — strongest credibility content for a litigation firm; none currently.
- [ ] Associates — Introduction claims a team of associates/researchers/litigators, but only 4 partners shown. Show them or soften the claim.
- [ ] Directory citations (Chambers / Legal 500 / IFLR) — the compliant alternative to a client logo wall.
