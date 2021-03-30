<?php

namespace Tests\Feature\API\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;

class SellerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create(['profile'=>'manager']);
        $seller = User::factory()->create(['profile'=>'seller']);
        $this->actingAs($user);
        $store = Store::factory()->create(['user_id'=>$seller->id]);

        /**
         * post with error
         */
        $response = $this->postJson('/api/store-sellers/'.$store->id.'/seller');
        $response->assertStatus(422);

        /**
         * Post success
         */
        $response = $this->postJson('/api/store-sellers/'.$store->id.'/seller', [
            'name'=>'Eduard',
            'last_name'=>'acevedo',
            'email'=>'eduard@mail.com',
            'password'=>bcrypt('123456'),
        ]);

        $response->assertStatus(201);
        $response->assertSee('create success');

        /**
         * Get Index
         */
        $response = $this->getJson('/api/store-sellers/'.$store->id.'/seller');
        $response->assertStatus(200);
        $response->assertJson([
            'message'=>'success',
            'data'=>[]
        ]);
    }
}
