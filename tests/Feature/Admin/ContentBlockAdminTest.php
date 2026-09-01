<?php

use App\Models\ContentBlock;
use App\Models\User;

test('guests cannot access the admin content blocks list', function () {
    $response = $this->get('/admin/content-blocks');

    $response->assertRedirect('/login');
});

test('the list groups blocks by group and shows a friendly label', function () {
    $user = User::factory()->create();
    ContentBlock::factory()->create(['group' => 'hse_metrics', 'title' => 'EPI', 'position' => 1]);
    ContentBlock::factory()->create(['group' => 'hse_metrics', 'title' => 'Audits', 'position' => 2]);

    $response = $this->actingAs($user)->get('/admin/content-blocks');

    $response->assertOk();
    $response->assertViewHas('blocksByGroup', fn ($blocksByGroup) => $blocksByGroup->get('hse_metrics')->count() === 2);
    $response->assertSee(ContentBlock::groupLabel('hse_metrics'));
});

test('the create form offers the curated group and icon choices', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/admin/content-blocks/create');

    $response->assertOk();
    $response->assertSee(ContentBlock::groupLabel('trades'));
    $response->assertSee('data-icon-option="hgi-vest"', false);
});

test('a group outside the known list is rejected', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/content-blocks', [
        'group' => 'not_a_real_group',
        'title' => 'Bloc invalide',
    ]);

    $response->assertSessionHasErrors('group');
    expect(ContentBlock::query()->where('title', 'Bloc invalide')->exists())->toBeFalse();
});

test('an icon outside the curated palette is rejected', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/content-blocks', [
        'group' => 'trades',
        'icon' => 'hgi-square-01',
        'title' => 'Bloc invalide',
    ]);

    $response->assertSessionHasErrors('icon');
    expect(ContentBlock::query()->where('title', 'Bloc invalide')->exists())->toBeFalse();
});

test('an authenticated user can create a content block', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/content-blocks', [
        'group' => 'trades',
        'icon' => 'hgi-factory-01',
        'title' => 'Nouveau bloc',
        'description' => 'Un résumé',
        'position' => 1,
    ]);

    $response->assertRedirect(route('admin.content-blocks.index'));
    expect(ContentBlock::query()->where('title', 'Nouveau bloc')->exists())->toBeTrue();
});

test('an authenticated user can update a content block', function () {
    $user = User::factory()->create();
    $block = ContentBlock::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/content-blocks/{$block->id}", [
        'group' => $block->group,
        'title' => 'Nouveau titre',
        'position' => $block->position,
    ]);

    $response->assertRedirect(route('admin.content-blocks.index'));
    expect($block->refresh()->title)->toBe('Nouveau titre');
});

test('an authenticated user can delete a content block', function () {
    $user = User::factory()->create();
    $block = ContentBlock::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/content-blocks/{$block->id}");

    $response->assertRedirect(route('admin.content-blocks.index'));
    $this->assertModelMissing($block);
});
