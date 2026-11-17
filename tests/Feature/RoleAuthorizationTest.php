<?php

use App\Models\User;

test('guests are redirected to login before role authorization', function () {
    foreach (['dashboard', 'seniors.index', 'assistance.index', 'benefits.index'] as $route) {
        $this->get(route($route))
            ->assertRedirect(route('login'));
    }
});

test('admin and super admin can access management pages', function (string $role) {
    $user = User::factory()->create(['role' => $role]);

    foreach (['dashboard', 'seniors.index', 'assistance.index', 'benefits.index'] as $route) {
        $this->actingAs($user)
            ->get(route($route))
            ->assertOk();
    }
})->with(['admin', 'super_admin']);

test('resident users cannot access management routes', function () {
    $user = User::factory()->create(['role' => 'resident']);

    foreach (['dashboard', 'seniors.index', 'assistance.index', 'benefits.index'] as $route) {
        $this->actingAs($user)
            ->get(route($route))
            ->assertForbidden();
    }

    foreach (['seniors.store', 'assistance.store', 'benefits.store'] as $route) {
        $this->actingAs($user)
            ->post(route($route), [])
            ->assertForbidden();
    }
});

test('resident users can manage only their own account profile', function () {
    $user = User::factory()->create(['role' => 'resident']);

    $this->actingAs($user)
        ->get(route('resident.dashboard'))
        ->assertOk();

    $this->actingAs($user)
        ->get(route('resident.profile.edit'))
        ->assertOk();
});

test('admins cannot access resident portal routes', function (string $role) {
    $user = User::factory()->create(['role' => $role]);

    $this->actingAs($user)
        ->get(route('resident.dashboard'))
        ->assertForbidden();
})->with(['admin', 'super_admin']);

test('resident profile updates post to the resident-only route', function () {
    $user = User::factory()->create(['role' => 'resident']);

    $this->actingAs($user)
        ->get(route('resident.profile.edit'))
        ->assertOk()
        ->assertSee(route('resident.profile.update'), false);
});
