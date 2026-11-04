<?php

use App\Models\User;

test('guest is redirected to login when visiting protected pages', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('login page is accessible and displays Humify brand', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
    $response->assertSee('Humify');
    $response->assertSee('A clearer view of your workday.');
});

test('employee can login and access permitted personal pages', function () {
    $user = User::where('username', 'alex.morgan')->first();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200)
        ->assertSee('Good morning, Alex');

    $this->actingAs($user)
        ->get('/profile')
        ->assertStatus(200)
        ->assertSee('Personal Information');

    $this->actingAs($user)
        ->get('/attendance-history')
        ->assertStatus(200)
        ->assertSee('My attendance history');

    $this->actingAs($user)
        ->get('/leave-requests')
        ->assertStatus(200)
        ->assertSee('My leave & requests');
});

test('employee is forbidden from manager, hr, and admin pages', function () {
    $user = User::where('username', 'alex.morgan')->first();

    $this->actingAs($user)
        ->get('/manager/attendance-reviews')
        ->assertStatus(403);

    $this->actingAs($user)
        ->get('/hr/employees')
        ->assertStatus(403);

    $this->actingAs($user)
        ->get('/admin/users')
        ->assertStatus(403);
});

test('manager can access manager review and approval pages but not hr settings or admin users', function () {
    $user = User::where('username', 'maya.chen')->first();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200)
        ->assertSee('Manager Workspace');

    $this->actingAs($user)
        ->get('/manager/attendance-reviews')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/manager/leave-approvals')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/manager/team-history')
        ->assertStatus(200);

    // Forbidden from HR and Super Admin areas
    $this->actingAs($user)
        ->get('/hr/shifts')
        ->assertStatus(403);

    $this->actingAs($user)
        ->get('/admin/users')
        ->assertStatus(403);
});

test('hr admin can access hr management pages but not super admin user management', function () {
    $user = User::where('username', 'sofia.patel')->first();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200)
        ->assertSee('HR Workspace');

    $this->actingAs($user)
        ->get('/hr/employees')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/attendance-reviews')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/leave-requests')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/shifts')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/leave-settings')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/reports')
        ->assertStatus(200);

    // Forbidden from Super Admin users management
    $this->actingAs($user)
        ->get('/admin/users')
        ->assertStatus(403);
});

test('super admin can access all hr features and accounts management', function () {
    $user = User::where('username', 'daniel.brooks')->first();

    $this->actingAs($user)
        ->get('/admin/users')
        ->assertStatus(200)
        ->assertSee('Account & Role Management');

    $this->actingAs($user)
        ->get('/hr/employees')
        ->assertStatus(200);

    $this->actingAs($user)
        ->get('/hr/shifts')
        ->assertStatus(200);
});
