<?php
/**
 * routes.php — the route table (CLAUDE.md §2).
 * Returns a map the front controller matches against. Templates live in
 * app/templates/. Dynamic routes ({slug}) validate the slug against data.
 *
 * Static routes: exact path (with trailing slash) => template name.
 * Dynamic routes: handled explicitly in index.php (practice-area, person).
 */

return [
    'static' => [
        '/'                  => 'home',
        '/the-firm/'         => 'the-firm',
        '/practice-areas/'   => 'practice-areas-index',
        '/people/'           => 'people-index',
        '/clients/'          => 'clients',
        '/contact/'          => 'contact',
        '/careers/'          => 'careers',
        '/disclaimer/'       => 'disclaimer',
        '/privacy-policy/'   => 'privacy-policy',
    ],

    /*
     * Dynamic routes. Each has: a regex over the path, the template to render,
     * and the data file whose entries provide the valid slugs (404 otherwise).
     * Person route is restricted to group === "partner" (founder renders on
     * The Firm, not People — CLAUDE.md §1, §2).
     */
    'dynamic' => [
        [
            'pattern'  => '#^/practice-areas/([a-z0-9-]+)/$#',
            'template' => 'practice-area',
            'data'     => 'practice-areas.json',
            'key'      => 'slug',
        ],
        [
            'pattern'  => '#^/people/([a-z0-9-]+)/$#',
            'template' => 'person',
            'data'     => 'people.json',
            'key'      => 'slug',
            'filter'   => ['group' => 'partner'],
        ],
    ],

    // Special generated routes handled directly by the front controller.
    'generated' => [
        '/sitemap.xml' => 'sitemap',
    ],
];
