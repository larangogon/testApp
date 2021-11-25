<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUsuariosTestNotAuthorize(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('users');

        $response->assertStatus(403);
    }

    public function testLoginDisplaysTheLoginForm(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testLoginAuthenticatesAndRedirectsUser(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function testLoginLisplaysValidationErrors(): void
    {
        $response = $this->post(route('login'), []);

        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }
}
