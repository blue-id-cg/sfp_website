<?php

use App\Models\Actualite;
use App\Models\Offre;

test('the sitemap includes published actualites and offres', function () {
    $actualite = Actualite::factory()->create();
    $offre = Offre::factory()->create();
    Actualite::factory()->draft()->create();

    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee(route('actualites.show', $actualite), false);
    $response->assertSee(route('offres.show', $offre), false);
});

test('robots.txt references the sitemap', function () {
    $response = $this->get('/robots.txt');

    $response->assertOk();
    $response->assertSee(route('sitemap'));
});
