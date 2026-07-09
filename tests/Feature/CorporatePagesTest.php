<?php

test('the métiers page is reachable', function () {
    $response = $this->get('/metiers');

    $response->assertOk();
    $response->assertSee('Le cycle de vie du puits, maîtrisé de bout en bout');
});

test('the hse page is reachable', function () {
    $response = $this->get('/hse');

    $response->assertOk();
    $response->assertSee('La sécurité avant la performance');
});

test('the équipements page is reachable', function () {
    $response = $this->get('/equipements');

    $response->assertOk();
    $response->assertSee('Un parc industriel à la hauteur des enjeux');
});

test('the new corporate pages are referenced in the sitemap', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertSee(route('metiers.index'), false);
    $response->assertSee(route('hse.index'), false);
    $response->assertSee(route('equipements.index'), false);
});

test('the navbar links to the dedicated pages instead of homepage anchors', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee(route('metiers.index'), false);
    $response->assertSee(route('hse.index'), false);
    $response->assertSee(route('equipements.index'), false);
});
