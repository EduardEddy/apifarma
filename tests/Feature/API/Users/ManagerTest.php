<?php

namespace Tests\Feature\API\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManagerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware/*DatabaseTransactions*/;
    /**
     * test for all funtionability of Manager.
     *
     * @return void
     */
    public function test_all()
    {
        $user = User::factory()->create(['profile' => 'manager']);

        $response = $this->get('/api/managers');
        $response->assertStatus(200);

        // send post with data null
        $response = $this->postJson('/api/managers');
        $response->assertStatus(422);

        $response = $this->postJson('/api/managers', [
            'name'=>'Eduard',
            'last_name'=>'acevedo',
            'email'=>'eduard@mail.com',
            'password'=>bcrypt('123456'),
        ]);
        $response->assertStatus(201);
        $response->assertSee('create succes');
        $new_user = $response['data'];

        // authenticate user
        //$this->actingAs($user);

        $response = $this->get('/api/managers/1');
        $response->assertStatus(200);
        $response->assertSee('success');
        /*->assertJson([
            'data'=>[
                'name'=>'Eduard',
                'last_name'=>'acevedo',
                'id'=>1
            ]
        ]);*/

        // UPDATE
        $response = $this->putJson('/api/managers/1', [
            'name'=>'Eduard Eddy',
            'last_name'=>'Acevedo Bracho',
            'country'=>'Venezuela',
            'identification'=>17460168,
            'type_identification'=>'CI',
        ]);
        $response->assertStatus(200);

        $response = $this->delete('/api/managers/1',[]);
        $response->assertStatus(200);

        //$response = $this->get('/api/managers/active');
        //$response->assertStatus(200);
    }
}
