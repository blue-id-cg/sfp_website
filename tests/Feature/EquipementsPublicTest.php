<?php

use App\Models\Equipment;
use App\Models\Trade;

test('the equipements page lists equipment with its trades and spec sheet link', function () {
    $trade = Trade::factory()->create(['title' => 'Forage pétrolier']);
    $equipment = Equipment::factory()->create(['title' => 'Rig de test', 'spec_sheet' => 'equipment/spec-sheets/fiche.pdf']);
    $equipment->trades()->attach($trade);

    $response = $this->get('/equipements');

    $response->assertOk();
    $response->assertSee($equipment->title);
    $response->assertSee($trade->title);
    $response->assertSee('Fiche technique');
});
