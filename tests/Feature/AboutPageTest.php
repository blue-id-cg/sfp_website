<?php

test('the about page is reachable', function () {
    $response = $this->get('/a-propos');

    $response->assertOk();
    $response->assertSee('À propos de la SFP');
});

test('the about page is referenced in the sitemap', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertSee(route('about.index'), false);
});
