<?php

test('switching to an available locale persists it in the session and translates the nav', function () {
    $this->get(route('lang.switch', 'en'));

    expect(session('locale'))->toBe('en');

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Home');
    $response->assertSee('Contact us');
});

test('switching to an unknown locale is ignored', function () {
    $this->get(route('lang.switch', 'de'));

    expect(session('locale'))->toBeNull();

    $response = $this->get('/');

    $response->assertSee('Accueil');
});

test('the default locale is french', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Accueil');
    $response->assertSee('Nous contacter');
});
