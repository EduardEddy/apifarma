<?php

namespace Tests\Feature\API\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;

class SearchTest extends TestCase
{
    use RefreshDatabase,WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create(['profile' => 'manager']);
        $seller = User::factory()->create(['profile' => 'seller']);
        $this->actingAs($user);
        $store = Store::factory(3)->create(['user_id'=>$seller->id,'country'=>'CO']);

        $product = Product::factory(5)->create();

        $response = $this->get('/api/products/search?q=m&country=CO&lat=4.6665578&lng=-74.0524521');
        dd($response->getContent());
        $response->assertStatus(200);
    }
}
