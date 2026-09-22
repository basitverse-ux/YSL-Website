<?php
/**
 * layout/header.php — one header, sticky, thin orange rule (CLAUDE.md §3, §5).
 * Renders <head> (meta + schema), the wordmark lock-up, primary nav, and the
 * mobile hamburger. Behaviour (sticky shrink, menu open/close, Escape) is in
 * assets/js/site.js.
 */

$meta = $GLOBALS['__meta'] ?? [];
$current = $route_path ?? ($_SERVER['REQUEST_URI'] ?? '/');
$current = parse_url($current, PHP_URL_PATH) ?: '/';

// Primary nav (6 items, §3). Careers/Disclaimer/Privacy live in the footer.
$primary_nav = [
    '/'                => 'Home',
    '/the-firm/'       => 'The Firm',
    '/practice-areas/' => 'Practice Areas',
    '/people/'         => 'People',
    '/clients/'        => 'Clients',
    '/contact/'        => 'Contact',
];

$firm_name = site_get('name', 'Yasin Sohl Law Firm');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php render_meta($meta); ?>
<link rel="preload" href="/assets/fonts/sora-latin-variable.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/fonts/ibm-plex-sans-latin-400.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/assets/css/site.css">
<?php json_ld(legal_service_schema()); ?>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
  <div class="container site-header__inner">
    <a class="wordmark" href="/" aria-label="<?php eo($firm_name); ?> — home">
      <span class="wordmark__rule" aria-hidden="true"></span>
      <span class="wordmark__text">
        <span class="wordmark__name">YASIN SOHL</span>
        <span class="wordmark__sub">LAW FIRM</span>
      </span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false"
            aria-controls="primary-nav" aria-label="Open menu" data-nav-toggle>
      <span class="nav-toggle__bars" aria-hidden="true"></span>
    </button>

    <nav class="nav" id="primary-nav" aria-label="Primary" data-nav>
      <ul class="nav__list">
        <?php foreach ($primary_nav as $href => $label): ?>
          <li>
            <a class="nav__link" href="<?php eo($href); ?>"
               <?php if (is_current($href, $current)) echo 'aria-current="page"'; ?>>
              <?php eo($label); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>

<main id="main">
