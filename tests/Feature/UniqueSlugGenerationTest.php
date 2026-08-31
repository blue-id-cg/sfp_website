<?php

use App\Models\Actualite;
use App\Models\Offre;

test('a duplicate actualite title gets a numbered slug suffix', function () {
    Actualite::factory()->create(['title' => 'Forage de puits', 'slug' => 'forage-de-puits']);

    expect(Actualite::generateUniqueSlug('Forage de puits'))->toBe('forage-de-puits-2');
});

test('a duplicate offre title gets a numbered slug suffix', function () {
    Offre::factory()->create(['title' => 'Ingénieur process', 'slug' => 'ingenieur-process']);

    expect(Offre::generateUniqueSlug('Ingénieur process'))->toBe('ingenieur-process-2');
});

test('generating a slug ignores the record being updated', function () {
    $actualite = Actualite::factory()->create(['title' => 'Forage de puits', 'slug' => 'forage-de-puits']);

    expect(Actualite::generateUniqueSlug('Forage de puits', $actualite->id))->toBe('forage-de-puits');
});
