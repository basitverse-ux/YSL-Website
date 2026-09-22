<?php
/**
 * index.php — front controller / router (CLAUDE.md §1, §2).
 * Every request maps here via .htaccess. Responsibilities:
 *   • normalise the path, enforce trailing-slash 301
 *   • match static / dynamic / generated routes
 *   • dispatch the template (404 with correct status otherwise)
 *
 * app/ lives OUTSIDE public_html in production. This resolves it whether app/
 * is a sibling of public_html (production) or of index.php (flat/dev fallback).
 */

declare(strict_types=1);

/* ---- Dev convenience: `php -S localhost:8000 -t public_html public_html/index.php`
   Let the built-in server serve real static files (assets, fonts) directly;
   route everything else through the front controller. No effect under Apache /
   LiteSpeed, where .htaccess does the rewrite. ----------------------------- */
if (PHP_SAPI === 'cli-server') {
    $reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $file = __DIR__ . $reqPath;
    if ($reqPath !== '/' && is_file($file)) {
        return false; // serve the static file as-is
    }
}

/* ---- Production error handling (§8): no display, log instead ------------- */
$isDev = in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true)
      || (($_SERVER['APP_ENV'] ?? getenv('APP_ENV')) === 'dev');
error_reporting(E_ALL);
ini_set('display_errors', $isDev ? '1' : '0');
ini_set('log_errors', '1');

/* ---- Locate app/ -------------------------------------------------------- */
$appDir = null;
foreach ([__DIR__ . '/../app', __DIR__ . '/app'] as $candidate) {
    if (is_dir($candidate)) { $appDir = realpath($candidate); break; }
}
if ($appDir === null) {
    http_response_code(500);
    exit('Application directory not found.');
}
define('APP_DIR', $appDir);

require APP_DIR . '/helpers.php';
$routes = require APP_DIR . '/routes.php';

/* ---- Optional site config (SMTP etc.) — never committed ------------------ */
$configFile = APP_DIR . '/../config/config.php';
if (is_file($configFile)) require $configFile;

/* ---- Parse the request path -------------------------------------------- */
$uri  = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);

/* Generated routes first (exact, no slash normalisation) — e.g. /sitemap.xml */
if (isset($routes['generated'][$path])) {
    require APP_DIR . '/generated/' . $routes['generated'][$path] . '.php';
    exit;
}

/* Trailing-slash canonicalisation (§2): every route path ends in "/".
   Redirect non-slashed paths (that aren't files) with a 301. */
$hasExtension = (bool) preg_match('#\.[a-z0-9]{2,5}$#i', $path);
if ($path !== '/' && !$hasExtension && substr($path, -1) !== '/') {
    http_response_code(301);
    header('Location: ' . $path . '/');
    exit;
}

/* ---- Dispatch ----------------------------------------------------------- */

/** Render the 404 template with the correct HTTP status. */
function dispatch_404(): void {
    http_response_code(404);
    render('404', [], [
        'title'       => 'Page not found',
        'description' => 'The page you were looking for could not be found.',
        'canonical'   => '/404/',
        'noindex'     => true,
    ]);
}

/* Static routes */
if (isset($routes['static'][$path])) {
    $template = $routes['static'][$path];
    render($template, ['route_path' => $path], [
        'canonical' => $path,
        // Per-page title/description are set inside each template's $meta later;
        // sensible fallbacks live in the templates themselves.
    ]);
    exit;
}

/* Dynamic routes (validate slug against data; 404 if unknown) */
foreach ($routes['dynamic'] as $route) {
    if (!preg_match($route['pattern'], $path, $m)) continue;

    $slug  = $m[1];
    $items = data($route['data']);
    $entry = data_find($items, $route['key'], $slug);

    // Apply any filter (e.g. person route → partners only)
    if ($entry && !empty($route['filter'])) {
        foreach ($route['filter'] as $fk => $fv) {
            if (($entry[$fk] ?? null) !== $fv) { $entry = null; break; }
        }
    }

    if ($entry === null) { dispatch_404(); exit; }

    render($route['template'], [
        'entry'      => $entry,
        'items'      => $items,
        'route_path' => $path,
        'slug'       => $slug,
    ], [
        'canonical' => $path,
    ]);
    exit;
}

/* No match */
dispatch_404();
