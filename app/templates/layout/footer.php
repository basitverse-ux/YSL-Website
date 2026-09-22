<?php
/**
 * layout/footer.php — one footer (CLAUDE.md §3): contact block + nav columns
 * (Firm · Practice Areas · Legal) + copyright. Demo's footer form is cut.
 * Contact values come from site.json; unverified ones surface as [[TODO]].
 */
$c   = site()['contact'] ?? [];
$soc = site()['social'] ?? [];
$year = date('Y');

/** Small helper: show a value, or a visible TODO placeholder if empty (§0.4). */
$val = function (?string $v, string $todo): string {
    return ($v !== null && $v !== '') ? e($v) : '<span class="todo">[[TODO: ' . e($todo) . ']]</span>';
};
?>
</main>

<footer class="site-footer">
  <div class="container site-footer__grid">

    <div class="site-footer__col site-footer__col--contact">
      <a class="wordmark" href="/" aria-label="Home">
        <span class="wordmark__rule" aria-hidden="true"></span>
        <span class="wordmark__text">
          <span class="wordmark__name" style="color:#fff">YASIN SOHL</span>
          <span class="wordmark__sub">LAW FIRM</span>
        </span>
      </a>
      <address style="font-style:normal; margin-top:var(--space-4); display:grid; gap:var(--space-2)">
        <span><?= $val($c['address'] ?? null, 'confirm address — Mall Rd vs 8 Fane Rd') ?></span>
        <?php if (!empty($c['phone'])): ?>
          <a href="tel:<?php eo(preg_replace('/\s+/', '', $c['phone'])); ?>"><?php eo($c['phone']); ?></a>
        <?php else: ?>
          <span class="todo">[[TODO: confirm landline]]</span>
        <?php endif; ?>
        <?php if (!empty($c['whatsapp'])): ?>
          <a href="https://wa.me/<?php eo(preg_replace('/\D+/', '', $c['whatsapp'])); ?>" rel="noopener">WhatsApp</a>
        <?php endif; ?>
        <?php if (!empty($c['email'])): ?>
          <a href="mailto:<?php eo($c['email']); ?>"><?php eo($c['email']); ?></a>
        <?php else: ?>
          <span class="todo">[[TODO: domain mailbox — no Gmail]]</span>
        <?php endif; ?>
        <?php if (!empty($c['map_url'])): ?>
          <a href="<?php eo($c['map_url']); ?>" rel="noopener">View on Google Maps</a>
        <?php endif; ?>
      </address>
    </div>

    <div class="site-footer__col">
      <h4>Firm</h4>
      <ul class="site-footer__nav">
        <li><a href="/the-firm/">The Firm</a></li>
        <li><a href="/people/">People</a></li>
        <li><a href="/clients/">Clients</a></li>
        <li><a href="/careers/">Careers</a></li>
      </ul>
    </div>

    <div class="site-footer__col">
      <h4>Practice Areas</h4>
      <ul class="site-footer__nav">
        <li><a href="/practice-areas/">All Practice Areas</a></li>
        <li><a href="/contact/">Contact</a></li>
      </ul>
    </div>

    <div class="site-footer__col">
      <h4>Legal</h4>
      <ul class="site-footer__nav">
        <li><a href="/disclaimer/">Disclaimer</a></li>
        <li><a href="/privacy-policy/">Privacy Policy</a></li>
      </ul>
    </div>

  </div>

  <div class="container site-footer__bottom">
    <span>&copy; <?php eo($year); ?> <?php eo(site_get('name', 'Yasin Sohl Law Firm')); ?>. All rights reserved.</span>
    <span>No solicitor–client relationship is created by contacting the firm.</span>
  </div>
</footer>

<script src="/assets/js/site.js" defer></script>
</body>
</html>
