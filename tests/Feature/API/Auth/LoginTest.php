<?php

namespace Tests\Feature\API\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all()
    {
        $user = User::factory()->create(['profile'=>'manager','account'=>'active']);

        $response = $this->postJson('/api/login');
        $response->assertStatus(422);

        \Artisan::call('passport:client', ['--personal' => true, '--name' => 'client']);
        $response = $this->postJson('/api/login', [
            'email'=>$user->email,
            'password'=>'password'
        ]);
        $response->assertStatus(200);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
    }
}
