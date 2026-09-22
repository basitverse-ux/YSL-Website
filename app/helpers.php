<?php
/**
 * helpers.php — escaping, data loading, URL + meta/schema helpers (CLAUDE.md §1).
 * No output is ever emitted without escaping, even from our own data (§8).
 */

/* ---- Paths -------------------------------------------------------------- */
if (!defined('APP_DIR'))  define('APP_DIR', __DIR__);
if (!defined('DATA_DIR')) define('DATA_DIR', APP_DIR . '/data');
if (!defined('TPL_DIR'))  define('TPL_DIR', APP_DIR . '/templates');

/* ---- Escaping ----------------------------------------------------------- */

/** Escape for HTML text/attribute context. Use on EVERYTHING output. */
function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Escape then echo. Convenience for templates. */
function eo(?string $value): void { echo e($value); }

/** Escape a string for safe use inside a URL path/query segment. */
function eurl(string $value): string { return rawurlencode($value); }

/* ---- Data --------------------------------------------------------------- */

/**
 * Load and decode a JSON data file from app/data/. Cached per request.
 * Returns [] on missing/invalid file (never fatals in production).
 */
function data(string $file): array {
    static $cache = [];
    if (isset($cache[$file])) return $cache[$file];

    $path = DATA_DIR . '/' . basename($file);
    if (!is_file($path)) return $cache[$file] = [];

    $decoded = json_decode((string) file_get_contents($path), true);
    return $cache[$file] = is_array($decoded) ? $decoded : [];
}

/** Find one entry in a data array by a key/value match. Null if none. */
function data_find(array $items, string $key, string $value): ?array {
    foreach ($items as $item) {
        if (is_array($item) && ($item[$key] ?? null) === $value) return $item;
    }
    return null;
}

/* ---- Site config -------------------------------------------------------- */

/** The site.json blob (name, contact, socials …). Cached. */
function site(): array {
    static $s = null;
    if ($s === null) $s = data('site.json');
    return $s;
}

/** Read a dotted key from site.json, e.g. site_get('contact.email'). */
function site_get(string $dotted, ?string $default = null): ?string {
    $node = site();
    foreach (explode('.', $dotted) as $part) {
        if (is_array($node) && array_key_exists($part, $node)) $node = $node[$part];
        else return $default;
    }
    return is_string($node) ? $node : $default;
}

/* ---- URLs --------------------------------------------------------------- */

/** Absolute site base URL, e.g. https://www.yasinsohllaw.com (no trailing slash). */
function base_url(): string {
    $configured = site_get('base_url');
    if ($configured) return rtrim($configured, '/');
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host;
}

/** Build an absolute URL from a site-root path (leading slash expected). */
function url(string $path = '/'): string {
    return base_url() . '/' . ltrim($path, '/');
}

/** Is $path the current request path? (for aria-current) */
function is_current(string $path, string $current): bool {
    return rtrim($current, '/') . '/' === rtrim($path, '/') . '/';
}

/* ---- Meta / head -------------------------------------------------------- */

/**
 * Render <title>, description, canonical, OG/Twitter tags (CLAUDE.md §7).
 * $meta: title, description, canonical (path), og_image (path), noindex(bool).
 */
function render_meta(array $meta): void {
    $name  = site_get('name', 'Yasin Sohl Law Firm');
    $title = trim(($meta['title'] ?? '') !== '' ? $meta['title'] . ' — ' . $name : $name);
    $desc  = $meta['description'] ?? '';
    $canon = url($meta['canonical'] ?? '/');
    $ogimg = url($meta['og_image'] ?? '/assets/img/og-default.png');

    echo '<title>' . e($title) . "</title>\n";
    if ($desc !== '') echo '<meta name="description" content="' . e($desc) . "\">\n";
    echo '<link rel="canonical" href="' . e($canon) . "\">\n";
    if (!empty($meta['noindex'])) echo "<meta name=\"robots\" content=\"noindex,nofollow\">\n";

    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="' . e($name) . "\">\n";
    echo '<meta property="og:title" content="' . e($title) . "\">\n";
    if ($desc !== '') echo '<meta property="og:description" content="' . e($desc) . "\">\n";
    echo '<meta property="og:url" content="' . e($canon) . "\">\n";
    echo '<meta property="og:image" content="' . e($ogimg) . "\">\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}

/**
 * Emit a JSON-LD <script>. $data is an associative array; encoded safely.
 */
function json_ld(array $data): void {
    echo '<script type="application/ld+json">'
       . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
       . "</script>\n";
}

/** The LegalService schema shared by every page (§7). */
function legal_service_schema(): array {
    $s = site();
    $c = $s['contact'] ?? [];
    return array_filter([
        '@context'   => 'https://schema.org',
        '@type'      => 'LegalService',
        'name'       => $s['name'] ?? null,
        'url'        => base_url() . '/',
        'telephone'  => $c['phone'] ?? null,
        'email'      => $c['email'] ?? null,
        'address'    => !empty($c['address']) ? [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $c['address'] ?? null,
            'addressLocality' => $c['city'] ?? 'Lahore',
            'addressRegion'   => $c['region'] ?? 'Punjab',
            'addressCountry'  => $c['country'] ?? 'PK',
        ] : null,
        'areaServed' => ['Lahore', 'Punjab', 'Pakistan'],
    ], fn($v) => $v !== null && $v !== '');
}

/* ---- Rendering ---------------------------------------------------------- */

/**
 * Render a template within the header/footer layout.
 * $vars are extracted into the template's scope. $meta drives <head>.
 * Missing template → scaffold placeholder (Milestone 1 safety net).
 */
function render(string $template, array $vars = [], array $meta = []): void {
    $GLOBALS['__meta'] = $meta;
    $tplPath = TPL_DIR . '/' . $template . '.php';

    extract($vars, EXTR_SKIP);
    require TPL_DIR . '/layout/header.php';

    if (is_file($tplPath)) {
        require $tplPath;
    } else {
        require TPL_DIR . '/layout/_scaffold-notice.php';   // template not built yet
    }

    require TPL_DIR . '/layout/footer.php';
}
