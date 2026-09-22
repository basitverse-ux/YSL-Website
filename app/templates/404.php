<?php
/**
 * 404.php — minimal branded not-found (CLAUDE.md §2, §4).
 * Scaffold-level version: correct status + links so routing is verifiable now.
 * The full Finovate-404 layout is refined in the template phase.
 */
?>
<section class="section section--ink" style="min-height:60vh; display:grid; place-items:center; text-align:center">
  <div class="container stack">
    <p class="numeral" style="font-size:clamp(4rem,12vw,8rem); line-height:1">404</p>
    <h1>Page not found</h1>
    <p style="margin-inline:auto">The page you were looking for doesn’t exist or may have moved.</p>
    <p>
      <a class="btn btn--primary" href="/">Home</a>
      <a class="btn btn--ghost" href="/practice-areas/">Practice Areas</a>
      <a class="btn btn--ghost" href="/contact/">Contact</a>
    </p>
  </div>
</section>
