# YSL Website — Layout Reference (from Finovate demo data)
Source: finovate/samples/content.xml inside the purchased theme zip. This is the demo's full Elementor data. Purpose: the exact section order of each Finovate page we're referencing, with a keep / adapt / cut decision for YSL. This is structure only. It's not code, copy or images to reuse. For: Claude Code, alongside build-brief-claude-code.md. Use this for structure; use screenshots of the live demo only for visual feel.
Tone key: [dark] near-black section · [light] off-white/cream section · [accent] accent-colour section. On YSL: dark = --ink, light = --cream, accent = use sparingly (orange band or dark).

Home: Finovate "Consulting Company" (post 22)
#|Demo section|YSL|
1|[light] Hero: tabbed slides, 2-line heading + divider, "Free Consultation" button|Adapt. Single static hero, no tabs/slider. Wordmark + tagline + "Contact Us"|
2|[dark] Three image cards: Who we are / Recognition / Report|Adapt → one card only: short positioning + link to The Firm. Drop Recognition/Report (no content)|
3|[light] Services grid: icon + image + title cards|Keep shape → 12 practice-area tiles (icon + title + descriptor). No images|
4|"View All Services" button|Keep → "All Practice Areas"|
5|[accent] Philosophy: 4 icon + heading + text cards|Optional. Only if the firm supplies values copy; otherwise cut|
7|Stats: 4 counters (600+, $5bn, 80%, >90)|Adapt → facts strip, verifiable only: Est. 1991 · 12 Practice Areas · Trial Courts to Supreme Court|
8|Icon + heading + "Set an Appointment" band|Cut (duplicates final CTA)|
9–10|Industries heading + image + industry button list|Adapt → Clients teaser: sector names as links to /clients/|
11|[dark] Testimonial + success-story carousel|Cut. No testimonials, no results claims|
12|Insights loop grid|Cut. Insights omitted|
13–14|"Empowering Our Clients" + 6-logo strip|Cut. No logo wall|
—|(add)|Partners strip: 4 cards → People. Reuse Team-hub card pattern below|
—|(add)|Contact CTA band. Reuse Contact §4 shape|
Practice Areas hub: "Services overview" (post 25)
#|Demo section|YSL|
1|[light] Eyebrow + H2 + intro paragraph|Keep|
2|Stats row|Cut|
3|"Why choose us": 3 icon-list columns|Cut|
4|Services loop grid|Keep → 12 practice-area cards|
5|[dark] Success story|Cut|
6|"Why us" animated headline + "Schedule a Call"|Cut → replace with standard Contact CTA band|
Single practice area: "Consulting" service page (post 37) + "Single Page – Services" template (post 3980)
Template hero (3980): breadcrumb button → page title → subheading → excerpt → "Free Consultation" button → image.
#|Demo section|YSL|
hero|Breadcrumb + title + excerpt + CTA + image|Keep shape. Breadcrumb, title, descriptor. CTA "Contact Us". No image unless photography exists|
1|"Our Philosophy": text + "Schedule a Call" + 3-item accordion|Adapt → Overview: the practice area's paragraphs. No accordion|
3|5 pill buttons (College planning, Income optimization…)|Adapt → Authorities & Forums as pills/chips. Same visual pattern, our authorities array|
4|[dark] "Preparing for your future": heading + text|Cut|
5|[dark] "Our Process": 01–04 numbered steps|Cut (numbered orange numerals do reappear on the hub cards, matching the PDF)|
6|Testimonials carousel + Google 4.9|Cut|
—|(add)|Related practice areas: 2–3 cards|
—|(add)|Contact CTA band|
The Firm: "Who we are" (post 29) + "Our philosophy" (post 1078)
#|Demo section|YSL|
29·1|Stats row ($28.90M AUM…)|Adapt → facts strip (same as Home)|
29·2|"Values" eyebrow + H2 + paragraph|Keep → full Introduction text|
29·3|4 icon value cards|Keep if values copy supplied; else cut|
29·4–5|"Our history" + year tabs (1950, 2004, 2014…)|Adapt, optional → timeline: 1991 founded · 2004–09 Punjab Bar Council · 2008 onward MPA. Only facts from the profile. Confirm framing with firm|
29·6|"Why us" heading + text|Cut|
29·9|Service link buttons|Adapt → Courts & forums of practice|
29·10|[dark] Quote from team member + CTA|Adapt → Founder section on dark: photo (cut-out on black works here), name, "Founder", bio|
1078·2|[dark] Purpose / Commitment two-column|Optional for approach copy|
1078·4|Recognition carousel|Cut (no awards content)|
People hub: "Team" (post 1071)
#|Demo section|YSL|
1|Eyebrow "Our People" + H2 + paragraph|Keep → the "At Yasin Sohl Law Firm, our strength lies…" paragraph|
2|"Leadership" + "Advisors" carousels|Adapt → one grid (not carousel) of 4 partners. Drop Advisors|
3|Featured quote from a team member + "Careers" button|Cut the quote. Optionally keep a small "Careers" link|
Single partner: "Single Page – Team" template (post 8543) + member content (post 2079)
#|Demo section|YSL|
8543·1|Back button "Team" + name + role + email + social icons|Keep → back to People, honorific + name, role, strapline. Email/socials only if the firm wants them published|
2079·1–2|"Expertise" + service link buttons|Keep → Principal Areas as pills, linking to matching practice areas where one exists|
2079·3|Bio text|Keep → full profile paragraphs|
8543·3|"Meet more of our leaders" carousel|Keep as grid → the other 3 partners|
Clients: "Industries Overview" (post 27)
#|Demo section|YSL|
1|"Why us" intro + CTA|Adapt → short intro, no CTA|
2|[dark] Offerings: icon lists + image|Cut|
3|Eyebrow + H2|Keep|
4|6 sector headings, each with a list of links|Keep: this is the Clients page. Sector headings + unattributed descriptions. No links unless a consented client|
5|Stats|Cut|
6|"Why us" animated headline|Cut → Contact CTA band|
Careers: "Careers" (post 35)
#|Demo section|YSL|
1|"Culture & Community" + intro|Keep → "Build Your Future with Yasin Sohl Law Firm" + intro|
2|[dark] Awards & recognition|Cut|
3–4|4 icon benefit cards|Adapt → two cards: Associates · Internship Program|
5|[accent] "Open Positions" list|Adapt → how to apply + careers@ email link (no upload form at launch)|
Contact: "Contact Us" (post 49)
#|Demo section|YSL|
1|Address / Phone / Email: 3 icon blocks|Keep → address, landline, WhatsApp, email|
2|"Get in Touch" + form|Keep → contact form (spec in build brief §6)|
3|[accent] Multiple office locations|Adapt → single office + map embed|
4|[dark] "Schedule a Free Consultation"|Cut|
Header (post 187) · Footer (post 998) · 404 (post 9571)
	•	Header: demo has a mega-menu with the industries list. Cut the mega-menu. Plain 6-item nav + logo; practice areas can be a simple dropdown if wanted.
	•	Footer: demo has a "Schedule consultation" form row + address/email/phone + 4 nav columns. Cut the footer form. Keep contact block + nav columns (Firm · Practice Areas · Legal).
	•	404: "Oops… 404 / page not found / Back to home". Keep shape.

Design constants from the theme (use only where they fit YSL)
|Finovate value|Use for YSL?|
Breakpoints|1024px, 767px|Yes, sensible defaults|
Content max-width|1280px|Yes|
Corner radius|9px cards, 100px pills|Partly. The YSL profile uses square tiles. Square cards; pills for the Authorities chips only|
Headings|Bebas Neue, uppercase|No. Doesn't match the profile's sentence-case geometric sans|
Body|Helvetica|No. Commercial font, not included in the zip|
Palette|accent #C10723 red, #191919, #F3F5F2, #F3EDE3|No. Use YSL palette. (Note: Finovate's #F3EDE3 cream is almost identical to YSL's cream)|
Not usable from the zip
	•	Images: none included. All 212 demo images are hosted on VamTam's demo server, and filenames like GettyImages-… indicate licensed stock for the demo only.
	•	Icons: 32 custom glyphs, finance/UI-oriented (pie, graph, pay, rocket…). No law-relevant icons. Use the icon set from the YSL profile if the firm has the source files, otherwise an open-licence set such as Lucide or Tabler.
	•	PHP theme code, plugins: WordPress-specific; irrelevant to the custom build.
