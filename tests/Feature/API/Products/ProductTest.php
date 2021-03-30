<?php

namespace Tests\Feature\API\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all()
    {
        $user = User::factory()->create(['profile' => 'manager']);
        $seller = User::factory()->create(['profile' => 'seller']);
        $this->actingAs($user);
        $store = Store::factory()->create(['user_id'=>$seller->id]);
        Product::factory(5)->create();

        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
        $response->assertJson([
            'data'=>[
                ['id'=>1],
                ['id'=>2],
                ['id'=>3]
            ]
        ]);

        $response = $this->postJson('/api/products',[]);
        $response->assertStatus(422);

        $response = $this->postJson('/api/products',[
            'name'=>'DOL',
            'description'=>'N/A',
            'components'=>'tiene componentes',
            'cant'=>'500mm',
            'price'=>'3000',
            'store_id'=>$store->id,
            'image'=>null
        ]);
        $response->assertStatus(201);
        $response->assertJson([
            'data'=>[
                'name'=>'DOL'
            ]
        ]);

        $response = $this->getJson('/api/products/6');
        $response->assertStatus(200);

        $response = $this->putJson('/api/products/6',[
            'name'=>'DOL Plus',
            'description'=>'N/A',
            'components'=>'tiene componentes',
            'cant'=>'500mm',
            'price'=>'3000',
            'store_id'=>$store->id,
            'image'=>null,
            'active'=>true
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'data'=>[]
        ]);
    }
}
