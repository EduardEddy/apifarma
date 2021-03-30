<?php

namespace Tests\Feature\API\Invoices;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;

class InvoiceProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
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
        $store = Store::factory(3)->create(['user_id'=>$seller->id]);

        $product = Product::factory(5)->create();

        $response = $this->getJson('/api/invoices-products');

        $response->assertStatus(200);

        $response = $this->postJson('/api/invoices-products',[]);
        $response->assertStatus(422);

        $response = $this->postJson('/api/invoices-products',[
            'store_id'=>$store->first()->id,
            'delivery'=>'casa',
            'products'=>[1,2,3,4,5]
        ]);
        $response->assertStatus(201);

        $response = $this->getJson('/api/invoices-products');
        $response->assertStatus(200);
    }
}
