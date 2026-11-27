<?php

use App\Models\Actualite;
use App\Models\Offre;
use App\Models\Trade;

test('the sitemap includes published actualites, offres and trades', function () {
    $actualite = Actualite::factory()->create();
    $offre = Offre::factory()->create();
    $trade = Trade::factory()->create();
    Actualite::factory()->draft()->create();

    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/xml');
    $response->assertSee(route('actualites.show', $actualite), false);
    $response->assertSee(route('offres.show', $offre), false);
    $response->assertSee(route('metiers.show', $trade), false);
    $response->assertSee('<lastmod>', false);
});

test('robots.txt references the sitemap', function () {
    $response = $this->get('/robots.txt');

    $response->assertOk();
    $response->assertSee(route('sitemap'));
});
