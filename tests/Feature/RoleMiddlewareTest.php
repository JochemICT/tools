<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the database with roles and permissions if they don't exist
        $this->artisan('db:seed', ['--class' => 'UserAndPermissionSeeder']);
    }

    /** @test */
    public function a_user_with_the_required_role_can_access_the_route()
    {
        $user = User::factory()->create();
        $user->addRole('admin');

        $this->actingAs($user)
             ->get('/test-role-route-admin')
             ->assertStatus(200);
    }

    /** @test */
    public function a_user_without_the_required_role_cannot_access_the_route()
    {
        $user = User::factory()->create();
        $user->addRole('user'); // Assign a different role

        $this->actingAs($user)
             ->get('/test-role-route-admin')
             ->assertStatus(403);
    }

    /** @test */
    public function a_user_with_one_of_the_required_roles_can_access_the_route()
    {
        $user = User::factory()->create();
        $user->addRole('owner');

        $this->actingAs($user)
             ->get('/test-role-route-admin-owner')
             ->assertStatus(200);
    }

    /** @test */
    public function a_user_without_any_of_the_required_roles_cannot_access_the_route()
    {
        $user = User::factory()->create();
        $user->addRole('user');

        $this->actingAs($user)
             ->get('/test-role-route-admin-owner')
             ->assertStatus(403);
    }
}
