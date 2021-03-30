<?php

namespace Tests\Feature\API\Stores;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;

class StoreSellerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * is a test for all finctionability of StoreSeller.
     *
     * @return void
     */
    public function test_all()
    {
        $user = User::factory()->create(['profile' => 'manager']);
        $this->actingAs($user);
        $seller = User::factory()->create(['profile' => 'seller']);
        $store = Store::factory()->create(['user_id'=>$seller->id]);

        $response = $this->getJson('/api/store-sellers?store='.$store->id);
        $response->assertStatus(200);
        $response->assertJson([
            'data'=>[]
        ]);

        $response = $this->putJson('/api/store-sellers/1/disabled');

        $response->assertStatus(200);
        $response->assertJson([
            'data'=>[]
        ]);
    }
}
