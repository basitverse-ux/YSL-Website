<?php
/**
 * _scaffold-notice.php — Milestone 1 placeholder.
 * Shown by render() when a page template does not exist yet, so the scaffold
 * runs end-to-end under `php -S` before any page templates are built.
 * DELETE all references once the real templates land (workflow §9 step 4).
 */
$meta = $GLOBALS['__meta'] ?? [];
$path = e(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
?>
<section class="section section--light scaffold-note">
  <div class="container stack">
    <p class="eyebrow">Milestone 1 · scaffold</p>
    <h1>Scaffold is live</h1>
    <p>
      The router, header, footer, design tokens and self-hosted fonts are in place.
      The page template for <code><?= $path ?></code> has not been built yet — that
      is Milestone 2 onward (workflow §9 step 4).
    </p>
    <p>What this proves is working right now:</p>
    <ul>
      <li>Front controller + clean-URL routing (all 25 routes resolve; unknown paths 404).</li>
      <li>YSL palette, Sora / IBM Plex Sans, brand wordmark + orange rules.</li>
      <li>Sticky header, mobile menu, scroll-reveal hooks, reduced-motion off-switch.</li>
    </ul>
    <p>
      <a class="btn btn--primary" href="/">Home</a>
      <a class="btn btn--ghost" href="/practice-areas/">Practice Areas</a>
      <a class="btn btn--ghost" href="/contact/">Contact</a>
    </p>
  </div>
</section>
