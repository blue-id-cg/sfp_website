<?php

use App\Models\Page;
use App\Models\User;

test('guests cannot access the admin pages list', function () {
    $response = $this->get('/admin/pages');

    $response->assertRedirect('/login');
});

test('an authenticated user can list pages', function () {
    $user = User::factory()->create();
    Page::factory()->create(['slug' => 'home']);

    $response = $this->actingAs($user)->get('/admin/pages');

    $response->assertOk();
});

test('an authenticated user can edit a page defined in the schema', function () {
    $user = User::factory()->create();
    Page::factory()->create(['slug' => 'home', 'content' => []]);

    $response = $this->actingAs($user)->get('/admin/pages/home/edit');

    $response->assertOk();
});

test('an authenticated user can update a page\'s content', function () {
    $user = User::factory()->create();
    $page = Page::factory()->create(['slug' => 'home', 'content' => []]);

    $response = $this->actingAs($user)->put('/admin/pages/home', [
        'content' => [
            'hero' => [
                'subhead' => 'Nouveau sous-titre',
                'cta_primary_label' => 'Découvrir',
                'cta_secondary_label' => 'Contact',
            ],
        ],
    ]);

    $response->assertRedirect(route('admin.pages.edit', $page));
    expect($page->refresh()->get('hero.subhead'))->toBe('Nouveau sous-titre');
});

test('accented content is stored correctly', function () {
    $user = User::factory()->create();
    $page = Page::factory()->create(['slug' => 'home', 'content' => []]);

    $this->actingAs($user)->put('/admin/pages/home', [
        'content' => [
            'hero' => ['subhead' => 'Texte modifié avec des accents éèàçê'],
        ],
    ]);

    expect($page->refresh()->get('hero.subhead'))->toBe('Texte modifié avec des accents éèàçê');
});

test('only fields declared in the schema are accepted', function () {
    $user = User::factory()->create();
    Page::factory()->create(['slug' => 'home', 'content' => []]);

    $response = $this->actingAs($user)->put('/admin/pages/home', [
        'content' => [
            'hero' => ['subhead' => 'Texte'],
            'not_a_real_section' => ['field' => 'ignored'],
        ],
    ]);

    $response->assertRedirect();
    $page = Page::query()->where('slug', 'home')->first();
    expect($page->get('not_a_real_section.field'))->toBeNull();
});
