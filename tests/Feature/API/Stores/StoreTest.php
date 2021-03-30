<?php

namespace Tests\Feature\API\Stores;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * is a test for all functionality store.
     *
     * @return void
     */
    public function test_all()
    {
        $user = User::factory()->create(['profile' => 'manager']);
        $this->actingAs($user);

        $response = $this->getJson('/api/stores');
        $response->assertStatus(200);

        $response = $this->postJson('/api/stores');
        $response->assertStatus(422);


        $response = $this->json('post','/api/stores', [
            'business_name'=>'eduard farm',
            'bussiness_id'=>'rif123454521',
            'country'=>'Venezuela',
            'city'=>'Maracaibo',
            'address'=>'los olivos',
            'lat'=>"300",
            'lng'=>"600"
        ]);
        $response->assertStatus(201);

        $response = $this->getJson('/api/stores/1');

        $response->assertStatus(200);

        /*$response->assertJson([
            'data'=>[
                'business_name'=>'eduard farm',
                'bussiness_id'=>'rif123454521',
                'country'=>'Venezuela',
                'user'=>[
                    'name'=>$user->name,
                    'last_name'=>$user->last_name
                ]
            ]
        ]);*/
        $response = $this->putJson('/api/stores/1', [
            'business_name'=>'eduard farm update',
            'bussiness_id'=>'rif123454521--',
            'country'=>'Zulia Maracaibo',
            'address'=>'los olivos',
            'city'=>'Maracaibo',
            'lat'=>"300",
            'lng'=>"600"
        ]);
        $response->assertStatus(200);
        /*
        $response = $this->get('/api/stores/1');
        $response->assertStatus(200);
        /*$response->assertJson([
            'data'=>[
                'business_name'=>'eduard farm update',
                'bussiness_id'=>'rif123454521--',
                'country'=>'Zulia Maracaibo',
                'user'=>[
                    'name'=>$user->name,
                    'last_name'=>$user->last_name
                ]
            ]
        ]);
        */
        $response = $this->delete('/api/stores/1');
        $response->assertStatus(200);
        $response->assertSee('success');
    }
}
