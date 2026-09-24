<?php

use App\Models\Trade;

test('the index page lists trades with a link to their detail page', function () {
    $trade = Trade::factory()->create(['title' => 'Forage pétrolier']);

    $response = $this->get('/metiers');

    $response->assertOk();
    $response->assertSee($trade->title);
    $response->assertSee(route('metiers.show', $trade), false);
});

test('a trade detail page can be viewed', function () {
    $trade = Trade::factory()->create();

    $response = $this->get(route('metiers.show', $trade));

    $response->assertOk();
    $response->assertSee($trade->title);
});

test('an unknown trade slug returns 404', function () {
    $response = $this->get('/metiers/does-not-exist');

    $response->assertNotFound();
});
