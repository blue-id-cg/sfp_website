<?php

test('the cookie consent banner is present on public pages', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('id="cookieBanner"', false);
    $response->assertSee(route('legal.cookies'), false);
});
