# YSL Website — Claude Code Build Brief
Decision (22 Sep 2026): Custom PHP site built with Claude Code, hosted on Hostinger (Unlimited Web Hosting plan). Not WordPress, not Finovate/Elementor. Visual approach (locked 22 Sep 2026): Recreate Finovate's layout, spacing, proportions and interactions. Use YSL's colours, typography and card style (from the company profile PDF), YSL's content, and YSL's sitemap and section structure. See §5. Maintained by: Ayan, via Claude Code. The firm does not self-edit. Companion docs: website-structure.md (sitemap and content decisions: still authoritative) · layout-reference.md (section-by-section layout for every page, taken from the theme's own demo data; follow it for structure) · theme-mapping.md (superseded as build method; its Authorities & Forums table still applies)
Hand this whole document to Claude Code as the project brief. Save it in the repo as CLAUDE.md, and put layout-reference.md and website-structure.md in the repo's docs/ folder.

## 0. Ground rules for Claude Code
	1	Recreate Finovate's look and feel. Never copy its code. Match its layout, grid, spacing, proportions, section rhythm and interactions as closely as possible, by measuring the live demo (§9 step 1) and writing fresh CSS/JS. Do not copy Finovate's HTML, CSS, JS, icons, fonts files or images: its CSS is Elementor-generated and unusable outside WordPress. Colours, typography and card style come from YSL, not Finovate (§5).
	2	Build once, fill from data. One header, one footer, one practice-area template, one partner template. Content lives in data files. Never hand-copy a page to make another page.
	3	No frameworks, no build step, no page builder. Plain PHP 8.x, hand-written CSS, minimal vanilla JS. The site must run by uploading the files.
	4	Never invent content. No made-up stats, testimonials, case results, client quotes or credentials. Where copy is missing, insert a visible [[TODO: …]] placeholder and list it in CONTENT-TODO.md.
	5	Show, don't claim. Before saying a page is done, run it locally and screenshot it at 390px and 1440px widths, next to the matching Finovate reference screenshot.

## 1. Architecture
Front controller + clean URLs. Every request goes through index.php, which maps the path to a template. LiteSpeed on Hostinger honours .htaccess.
repo/
├── public_html/                  ← deployed to Hostinger public_html
│   ├── .htaccess                 rewrite → index.php, https, security headers
│   ├── index.php                 front controller / router
│   ├── robots.txt
│   ├── assets/
│   │   ├── css/site.css          one stylesheet, design tokens at top
│   │   ├── js/site.js            mobile menu, sticky header, scroll reveals, hover helpers
│   │   ├── img/                  WebP, pre-sized
│   │   └── fonts/                self-hosted
│   └── contact-handler.php       form POST endpoint
├── app/                          ← NOT web-accessible (outside public_html, or denied via .htaccess)
│   ├── routes.php
│   ├── helpers.php               escaping, meta, schema, url helpers
│   ├── mailer.php                SMTP send
│   ├── templates/
│   │   ├── layout/header.php
│   │   ├── layout/footer.php
│   │   ├── home.php
│   │   ├── the-firm.php
│   │   ├── practice-areas-index.php
│   │   ├── practice-area.php     ← ONE template, 12 pages
│   │   ├── people-index.php
│   │   ├── person.php            ← ONE template, 4 pages
│   │   ├── clients.php
│   │   ├── contact.php
│   │   ├── careers.php
│   │   ├── disclaimer.php
│   │   ├── privacy-policy.php
│   │   └── 404.php
│   └── data/
│       ├── site.json             name, address, phones, emails, map URL, socials
│       ├── practice-areas.json   12 entries
│       ├── people.json           4 partners + founder
│       └── clients.json          sectors + consented logos only
├── config/
│   └── config.example.php        SMTP settings template (real config.php never committed)
├── docs/                         layout-reference.md, website-structure.md, finovate-measurements.md
├── reference/                    Finovate screenshots (git-ignored)
├── CLAUDE.md                     this brief
└── CONTENT-TODO.md               every missing piece of content
Why this shape: changing the phone number is one edit in site.json. Adding a partner is one entry in people.json. Nothing else is touched.
Data file shapes
practice-areas.json: each entry:
{
  "slug": "banking-finance",
  "title": "Banking & Finance",
  "descriptor": "one line for hero and hub card",
  "icon": "bank",
  "overview": ["paragraph 1", "paragraph 2"],
  "authorities": ["Banking Courts", "State Bank of Pakistan (SBP)", "SECP", "FBR"],
  "related": ["corporate-commercial-advisory", "arbitration-dispute-resolution"],
  "meta_description": "≤155 chars"
}
people.json: each entry: slug, name, honorific ("Barrister" or empty), role, strapline, summary, profile (array of paragraphs), principal_areas (array), photo, order, group ("partner" | "founder").
The founder entry has group: "founder". It renders on The Firm page, not on People.

## 2. Routes (must match website-structure.md exactly)
URL|Template|
/|home|
/the-firm/|the-firm|
/practice-areas/|practice-areas-index|
/practice-areas/{slug}/|practice-area (404 if slug not in data)|
/people/|people-index|
/people/{slug}/|person (partners only; 404 otherwise)|
/clients/|clients|
/contact/|contact|
/careers/|careers|
/disclaimer/|disclaimer|
/privacy-policy/|privacy-policy|
/sitemap.xml|generated from routes + data|
anything else|404 with correct HTTP status|
Trailing slash enforced by 301. Non-www ↔ www: pick one, 301 the other. HTTP → HTTPS 301.
The 12 practice-area slugs
civil-commercial-litigation
criminal-defence-white-collar
corporate-commercial-advisory
mergers-acquisitions
banking-finance
taxation-revenue-disputes
regulatory-administrative
healthcare-pharmaceutical
real-estate-construction-engineering
employment-labour-industrial-relations
intellectual-property-trademarks
arbitration-dispute-resolution
Person slugs
haaris-sohl · asharib-sohl · hussain-iqbal · roshaan-javaid-cheema

## 3. Navigation
	•	Primary: Home · The Firm · Practice Areas · People · Clients · Contact
	•	Footer: Careers · Disclaimer · Privacy Policy · address · phone · WhatsApp · email · map link · © year
	•	Header layout, height and sticky behaviour recreated from Finovate. No mega-menu. Mobile: hamburger → full-screen menu, styled after Finovate's mobile menu. Must work with keyboard and close on Escape.

## 4. Page specifications
Section order and keep/cut decisions for every page are in docs/layout-reference.md. It's extracted from the theme's demo data, so it's exact. Each kept section should look and behave like its Finovate counterpart (in YSL colours and typography). The summaries below are the content contract.
Home: funnel, not duplicate
	1	Hero: wordmark lock-up, tagline Litigation • Corporate Advisory • Regulatory Compliance, one CTA "Contact Us". Static, no tabs/slider
	2	Short positioning paragraph (condensed Introduction, not the full text) → link to The Firm
	3	Facts strip, verifiable facts only: Established 1991 · 12 Practice Areas · Trial Courts, High Courts & Supreme Court of Pakistan
	4	Practice-area grid: 12 cards from data, icon + title + descriptor, each linked
	5	Partners strip: 4 cards from data, linked
	6	Clients teaser: sector names → link to Clients
	7	Contact CTA band
The Firm
	1	Page hero
	2	Full Introduction (3 paragraphs)
	3	Founder section: Muhammad Yasin Sohl, photo + bio from profile PDF p.04, on a dark section
	4	Courts & forums of practice
	5	[[TODO: values / approach copy — not yet supplied]]
Practice Areas hub
Hero + intro line + the 12-card grid (same component as Home).
Practice area template (×12)
	1	Hero: title + descriptor + breadcrumb
	2	Overview: the paragraphs
	3	Authorities & Forums: rendered from authorities array as pills/chips (Finovate's pill-button pattern)
	4	Related practice areas: 2–3 cards from related
	5	Contact CTA band
That's all. No process steps, no testimonials, no why-us grid.
People hub
Hero + intro paragraph (from content doc "At Yasin Sohl Law Firm, our strength lies…") + 4 partner cards in a grid, not a carousel (photo, name, role, strapline, "View Full Profile →"). Card hover behaviour from Finovate's team cards.
Person template (×4)
Photo, honorific + name, role, strapline, full profile paragraphs, Principal Areas as pills, grid of the other partners, back link to People, Contact CTA.
Clients
Sector-grouped layout (reference: Finovate /industries/ section 4). Unattributed descriptions per sector. A logo appears only if clients.json marks "consent": true for that client. At launch assume no consent flags are set until the firm confirms in writing.
Contact
Address, landline, mobile/WhatsApp (as https://wa.me/ link), email, embedded map (Google Maps embed iframe, lazy-loaded), contact form (§6).
Careers
Copy from the content doc. Two cards: Associates · Internship Program. At launch: email application link, not an upload form (§6).
Disclaimer / Privacy Policy
Templates with [[TODO]] copy. The firm (being lawyers) must supply or approve final text. Claude Code may draft a clearly marked first draft for their review.
404
Branded, Finovate 404 layout, with links to Home, Practice Areas, Contact.

## 5. Design system
What comes from where
Element|Source|
Page and section layouts, grid, column structure|Finovate (measured)|
Spacing: section padding, gaps, margins, container width|Finovate (measured)|
Proportions: hero height, card sizes, image ratios, header height|Finovate (measured)|
Interactions and motion (list below)|Finovate (observed and measured)|
Button and pill shapes|Finovate|
Colours|YSL profile PDF|
Typography: fonts, case, weights|YSL profile PDF|
Card and tile corners|YSL: square, as in the profile|
Brand motifs (wordmark rule, orange numerals, partner layout)|YSL profile PDF|
Icons|YSL profile icons, else Lucide/Tabler|
Content, sitemap, section selection|YSL (website-structure.md, layout-reference.md)|
Colours: YSL
Values are sampled approximations from the profile PDF. Replace them with exact values from original brand files if the firm has them.
:root {
  --ink:      #111111;  /* charcoal, dark sections */
  --ink-2:    #1A1A1A;  /* card surfaces on dark */
  --cream:    #F5EDE6;  /* light sections */
  --paper:    #FAF7F4;  /* card surfaces on light */
  --accent:   #E8912A;  /* orange, rules, numbers, highlights */
  --accent-dk:#7A4A12;  /* brown tag backgrounds (partner straplines) */
  --muted:    #6B6B6B;
  --line:     #D9D0C7;
}
Where Finovate uses its red accent (#C10723), use --accent. Where it uses #191919, use --ink. Where it uses #F3F5F2 / #F3EDE3, use --cream / --paper.
Typography: YSL
Geometric sans for headings, humanist sans for body, sentence case as in the profile. Do not use Finovate's Bebas Neue (uppercase) or Helvetica. Font names are not confirmed. Ask the firm for the brand fonts; if unavailable, propose two self-hosted Google Font pairings and let Ayan choose. Self-host fonts; no Google Fonts CDN calls (performance + privacy).
Finovate's type scale and rhythm may be followed (relative sizes of H1–H6, line lengths, spacing between heading and body), adjusted so the YSL fonts sit comfortably. Its uppercase transform must not be.
Brand motifs: YSL
	•	Wordmark: "YASIN SOHL" over "LAW FIRM" with a thin vertical orange rule to the left
	•	Thin horizontal rule under the page header
	•	Orange two-digit numerals ("01", "02") on cards
	•	Icon + label practice-area tiles, alternating orange/grey icon blocks
	•	Partner layout: photo left with orange baseline rule, name in orange, role beneath, strapline tag in brown
	•	Alternating dark (ink) and light (cream) sections
Layout constants: Finovate
Content max-width 1280px; breakpoints 1024px and 767px. All other spacing values come from measurement (§9 step 1). Cards and tiles square (YSL). Pill shape for chips and buttons as in Finovate.
Interactions to recreate from Finovate
Only interactions belonging to sections we keep. Recreate each one, matching timing and easing from the demo:
	•	Sticky header: behaviour on scroll (shrink / background change), as Finovate
	•	Nav hover and active states
	•	Button hover (including Finovate's arrow-button treatment)
	•	Card hover: practice-area cards, partner cards, related cards
	•	Scroll-in reveal animations on sections and cards (entrance style, distance, duration, stagger)
	•	Mobile menu: open/close transition
	•	Link and pill hover states
	•	Form field focus and validation states
Not recreated (their sections are cut): tabbed hero slider, testimonial and success-story carousels, animated headline, mega-menu, popups/modals, loop carousels (replaced with static grids).
All motion must respect prefers-reduced-motion: reveals and transitions off for users who request it.
Icons, photography, accessibility
Icons: Finovate's icon font is finance/UI-only and must not be used. Use the profile PDF's practice-area icon set if the firm has source files; otherwise an open-licence set (Lucide or Tabler) as inline SVG.
Photography: partner headshots are cut-outs on black. Place them on --ink sections only. Do not reuse the Dublin/Pantheon stock images from the PDF unless licensing is confirmed, and do not use any Finovate demo image. Where Finovate has an image slot and YSL has no photo, either drop the slot or leave a neutral placeholder logged in CONTENT-TODO.md.
Accessibility: orange on cream fails contrast for body text. Use orange only for large text, numerals, rules and accents; body text stays ink/cream. Visible focus states. Alt text on every image.

## 6. Forms
Contact form
Fields: name, email, phone (optional), subject/practice area (select from data), message, consent checkbox linking to Privacy Policy.
Requirements:
	•	POST to contact-handler.php; server-side validation of every field
	•	CSRF token
	•	Honeypot field + minimum time-to-submit check
	•	Basic rate limit per IP (file-based is fine)
	•	Send via SMTP using the firm's own domain mailbox (Hostinger email). Use PHPMailer (vendored or Composer). Never PHP mail()
	•	SMTP credentials in config/config.php, outside the repo and outside public_html; commit only config.example.php
	•	No submissions stored on the server
	•	Success and error states on the page; no raw errors shown to users
	•	Notification email includes a line reminding staff that no solicitor-client relationship exists until engagement is confirmed
Careers
Launch with mailto:careers@<domain> + instructions. No CV upload.
Reason: file upload from the public is the riskiest component of the site (malicious files, storage of personal data). Revisit only if application volume justifies it; if built later, it needs type allow-list (PDF/DOCX), size cap, renaming, storage outside public_html or email-and-delete, and the same spam controls.

## 7. SEO & metadata
	•	Unique <title> and meta description per page (practice areas/people from data)
	•	Canonical URL on every page
	•	Open Graph + Twitter card tags (default OG image: branded card)
	•	sitemap.xml generated from routes + data; robots.txt references it
	•	JSON-LD LegalService on every page: name, address, telephone, url, areaServed Lahore/Punjab/Pakistan
	•	JSON-LD Person on each partner page
	•	One <h1> per page, logical heading order
	•	Breadcrumb JSON-LD on practice-area and person pages
	•	Submit sitemap to Google Search Console after launch (Ayan)

## 8. Security & performance
.htaccess: force HTTPS · canonical host redirect · rewrite to front controller · deny access to app/, config/, docs/, dotfiles, .json data · disable directory listing · headers: Strict-Transport-Security, X-Content-Type-Options: nosniff, Referrer-Policy: strict-origin-when-cross-origin, X-Frame-Options: SAMEORIGIN, a Content-Security-Policy allowing only self + Google Maps embed · long cache headers for /assets/.
PHP: display_errors off in production, errors to log · escape all output (htmlspecialchars) even from our own data.
Performance targets: Lighthouse ≥ 90 on Performance, Accessibility, Best Practices, SEO (mobile). Images WebP, explicit width/height, lazy-loaded below the fold. No jQuery, no animation library: scroll reveals via IntersectionObserver + CSS transitions. Total JS < 15 KB.

## 9. Workflow for Claude Code
	1	Reference capture and measurement. Read docs/layout-reference.md first; it defines which sections exist. Then, with Playwright, on these Finovate pages: Consulting home, /services/, one single service, /about/, /about/team/, /industries/, /about/careers/, /contact-us/:
	◦	Screenshot at 1440px and 390px → reference/
	◦	For each section we keep, read computed styles: section padding, container width, column gaps, card dimensions and padding, button padding/height/radius, header height (normal and scrolled), heading sizes and line-heights at each breakpoint
	◦	Record transitions and animations: property, duration, easing, delay/stagger, scroll-reveal start offset, sticky-header change point
	◦	Write all values to docs/finovate-measurements.md. This becomes the source for spacing and motion tokens in site.css
	2	Scaffold the structure in §1, router, header/footer, design tokens (YSL colours + typography, Finovate spacing and motion).
	3	Data files populated from the two content docs and the profile PDF (§10).
	4	Templates in this order: practice-area → person → hubs → home → the-firm → clients → contact → careers → legal → 404.
	5	Local preview with php -S localhost:8000 -t public_html (router-aware). After each template, screenshot at both widths and compare side by side with the Finovate reference: layout, spacing and interaction should match; colours and fonts should be YSL's.
	6	Forms with SMTP tested against a real mailbox.
	7	QA pass (§11).
	8	Deploy (§12).

## 10. Content: what's ready, what's blocked
Content|Status|Source|
Introduction|✅ Ready|content doc / PDF p.02|
12 practice areas|✅ Ready, with edits|practice areas doc: split Civil & Criminal into two, merge Employment + Industrial Disputes, rename the two "Regulatory Compliance" entries (see website-structure.md §4)|
Authorities & Forums per area|✅ Ready|extracted table in theme-mapping.md §4|
4 partner profiles|✅ Ready|content doc + PDF pp.05–06|
Founder bio|✅ Ready|PDF p.04|
Careers copy|✅ Ready|content doc|
Partner photos|⚠️ Usable on dark only|PDF (need original high-res files from firm)|
Icons|❌ Missing|profile PDF icon source files from firm, else Lucide/Tabler|
The Firm: values/approach|❌ Missing|firm to supply|
Clients sector descriptions|❌ To draft|derive sectors from client list; no names until consent|
Disclaimer, Privacy Policy|❌ Missing|firm to supply/approve|
All other photography|❌ Missing|shoot recommended|
Brand fonts, exact colours, logo files|❌ Missing|firm to supply|
Copy fixes to apply while populating
	•	"Complaince" → "Compliance" (tagline)
	•	"arbitations" → "arbitrations"
	•	Review "leading full-service law firm" and "distinguished reputation" with the partners before publishing (professional conduct rules, see website-structure.md §5)
Blockers (must be resolved before deploy, not before build)
	•	Sohl vs Sohal: locks the domain and every email address. Build with site.json so it's one change.
	•	Domain: confirm YSL owns yasinsohllaw.com in hPanel.
	•	Address: Mall Road vs 8 Fane Road.
	•	Landline +92 324 3000053 live?
	•	Mailboxes created on the domain: at minimum info@ and careers@.
	•	Founder still in active practice? (Changes The Firm framing.)

## 11. Acceptance checklist (before go-live)
	•	[ ] All 25 routes return 200; unknown paths return 404 status
	•	[ ] Every page screenshotted at 390px and 1440px, no overflow, no horizontal scroll
	•	[ ] Side-by-side check against Finovate reference: layout, spacing and interactions match; colours, fonts and card corners are YSL's
	•	[ ] All motion disabled under prefers-reduced-motion
	•	[ ] Nav + mobile menu work by keyboard
	•	[ ] Contact form delivers to the real mailbox; spam controls tested
	•	[ ] No [[TODO]] left on any public page (or explicitly accepted)
	•	[ ] No Gmail address anywhere on the site
	•	[ ] Contact details identical across header, footer, Contact page, schema
	•	[ ] Client links (if any shown) all correct; the known-broken ones from website-structure.md §5 fixed
	•	[ ] No testimonials, no review badges, no "Free", no invented numbers
	•	[ ] No Finovate code, fonts, icons or images anywhere in the repo
	•	[ ] Lighthouse mobile ≥ 90 on all four scores
	•	[ ] sitemap.xml valid; robots.txt correct; schema validates in Google's Rich Results Test
	•	[ ] Security headers present (check with securityheaders.com)
	•	[ ] app/, config/, docs/, data files not reachable by URL
	•	[ ] Partners have signed off the copy

## 12. Deployment
	1	Private GitHub repo. config/config.php, reference/ and .env-style files git-ignored.
	2	Check what's currently live on yasinsohllaw.com before touching public_html. If anything exists, take a full backup (Hostinger backups + download).
	3	Build and review on a staging location first: a subdomain such as staging.yasinsohllaw.com, password-protected and noindex.
	4	Hostinger Git deployment from the repo's public_html/ into the site's public_html. app/ and config/ deployed above public_html (via SSH/File Manager) so they're not web-accessible. If the plan doesn't allow files above the web root, keep them inside and rely on the .htaccess deny rules; verify with a direct URL request that they return 403.
	5	config/config.php created on the server by hand (SMTP credentials); never in Git.
	6	SSL active, then switch the canonical redirect on.
	7	Post-launch: Search Console + sitemap submission; verify Google Business Profile address matches the site exactly.
Confirm in hPanel before step 4: SSH access and Git deployment are enabled on this plan (a third-party review says both are included on Unlimited Web Hosting, but verify).
