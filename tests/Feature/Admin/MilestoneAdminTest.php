<?php

use App\Models\Milestone;
use App\Models\User;

test('guests cannot access the admin milestones list', function () {
    $response = $this->get('/admin/milestones');

    $response->assertRedirect('/login');
});

test('an authenticated user can create a milestone', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/milestones', [
        'year_label' => '2028',
        'category' => 'Objectif',
        'title' => 'Nouvelle étape',
        'description' => 'Un résumé',
    ]);

    $response->assertRedirect(route('admin.milestones.index'));
    expect(Milestone::query()->where('title', 'Nouvelle étape')->exists())->toBeTrue();
});

test('an authenticated user can update a milestone', function () {
    $user = User::factory()->create();
    $milestone = Milestone::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/milestones/{$milestone->id}", [
        'year_label' => $milestone->year_label,
        'title' => 'Nouveau titre',
    ]);

    $response->assertRedirect(route('admin.milestones.index'));
    expect($milestone->refresh()->title)->toBe('Nouveau titre');
});

test('an authenticated user can delete a milestone', function () {
    $user = User::factory()->create();
    $milestone = Milestone::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/milestones/{$milestone->id}");

    $response->assertRedirect(route('admin.milestones.index'));
    $this->assertModelMissing($milestone);
});
