<?php

test('the mentions légales page is reachable', function () {
    $response = $this->get('/mentions-legales');

    $response->assertOk();
    $response->assertSee('Mentions légales');
});

test('the privacy policy page is reachable', function () {
    $response = $this->get('/politique-de-confidentialite');

    $response->assertOk();
    $response->assertSee('Politique de confidentialité');
});

test('the cookies policy page is reachable', function () {
    $response = $this->get('/cookies');

    $response->assertOk();
    $response->assertSee('Politique de cookies');
});

test('the footer links to the legal pages', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee(route('legal.mentions'), false);
    $response->assertSee(route('legal.privacy'), false);
    $response->assertSee(route('legal.cookies'), false);
});
