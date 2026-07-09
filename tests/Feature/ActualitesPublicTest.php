<?php

use App\Models\Actualite;

test('the index page only lists published actualites', function () {
    $published = Actualite::factory()->create(['title' => 'Publiée']);
    $draft = Actualite::factory()->draft()->create(['title' => 'Brouillon']);

    $response = $this->get('/actualites');

    $response->assertOk();
    $response->assertSee($published->title);
    $response->assertDontSee($draft->title);
});

test('a published actualite can be viewed', function () {
    $actualite = Actualite::factory()->create();

    $response = $this->get(route('actualites.show', $actualite));

    $response->assertOk();
    $response->assertSee($actualite->title);
});

test('a draft actualite returns 404 on the public site', function () {
    $actualite = Actualite::factory()->draft()->create();

    $response = $this->get(route('actualites.show', $actualite));

    $response->assertNotFound();
});

test('an unknown slug returns 404', function () {
    $response = $this->get('/actualites/does-not-exist');

    $response->assertNotFound();
});
