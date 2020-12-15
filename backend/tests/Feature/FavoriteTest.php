<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class FavoriteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStatusCode()
    {
        $response = $this->get('/favorites');
        $response->assertStatus(302);


        $user = User::factory(User::class)->create();
        $response = $this->actingAs($user)->get('/favorites');
        $response->assertStatus(200);
    }
}
