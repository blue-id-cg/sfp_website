<?php

use App\Models\GalleryImage;

test('the home page shows a teaser of gallery images', function () {
    GalleryImage::factory()->count(12)->create();

    $response = $this->get('/');

    $response->assertOk();
});

test('the gallery page paginates images', function () {
    GalleryImage::factory()->count(30)->create();

    $response = $this->get('/galerie');

    $response->assertOk();
    $response->assertViewHas('images', fn ($images) => $images->count() === 24 && $images->hasMorePages());
});
