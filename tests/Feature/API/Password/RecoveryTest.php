<?php

namespace Tests\Feature\API\Password;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\ResetPassword;

class RecoveryTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create(['profile' => 'manager']);
        // send post with data null
        $response = $this->postJson('/api/reset-password');
        $response->assertStatus(422);

        $response = $this->postJson('/api/reset-password', [
            'email'=>$user->email
        ]);

        $response->assertStatus(201);
        $response->assertSee('success');

        $rc = ResetPassword::whereEmail($user->email)->first();

        $response = $this->get('/api/reset-password/'.$rc->token);
        $response->assertStatus(200)
            ->assertJson([
                "data"=>[
                    "email"=>$rc->email,
                    "token"=>$rc->token
                ]
            ]);

        $response = $this->putJson('/api/reset-password/'.$rc->token, [
            'password'=>'123456',
            'password_confirmation'=>'123'
        ]);
        $response->assertStatus(422);

        $response = $this->putJson('/api/reset-password/'.$rc->token, [
            'password'=>'123456',
            'password_confirmation'=>'123456'
        ]);
        $response->assertStatus(200);
    }
}
