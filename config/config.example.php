<?php
/**
 * config.example.php — template for config/config.php (CLAUDE.md §6, §8, §12).
 *
 * Copy to config/config.php ON THE SERVER, by hand, and fill in real values.
 * config.php is NEVER committed (see .gitignore) and MUST live outside
 * public_html (or be denied by .htaccess) so credentials are not web-reachable.
 *
 * Only SMTP + a couple of runtime toggles belong here. Public site content
 * lives in app/data/*.json, not here.
 */

return [
    // --- SMTP (Hostinger mailbox on the firm's own domain). Never PHP mail(). --
    'smtp' => [
        'host'       => 'smtp.hostinger.com',
        'port'       => 465,            // 465 = implicit TLS (smtps), 587 = STARTTLS
        'encryption' => 'ssl',          // 'ssl' for 465, 'tls' for 587
        'username'   => 'info@yasinsohllaw.com',
        'password'   => 'CHANGE_ME',
        'from_email' => 'info@yasinsohllaw.com',
        'from_name'  => 'Yasin Sohl Law Firm — Website',
        // Where contact-form notifications are delivered:
        'to_email'   => 'info@yasinsohllaw.com',
    ],

    // --- Careers: application address (mailto at launch; no upload form) -------
    'careers_email' => 'careers@yasinsohllaw.com',

    // --- Contact-form spam controls (§6) --------------------------------------
    'form' => [
        'min_submit_seconds' => 3,      // time-to-submit floor (bot check)
        'rate_limit_per_ip'  => 5,      // submissions / window
        'rate_limit_window'  => 3600,   // seconds
        'rate_limit_dir'     => __DIR__ . '/../var/ratelimit', // outside public_html
    ],

    // --- Environment ----------------------------------------------------------
    'app_env' => 'production',           // 'dev' shows errors; keep 'production' live
];
