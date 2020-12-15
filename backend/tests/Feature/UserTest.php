<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStatusCode()
    {
        $response = $this->get('/users');
        $response->assertStatus(302);

        $user = User::factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);

    }

    
    


}
