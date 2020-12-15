<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStatusCode()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(302);

        $user = User::factory(User::class)->create();
        $response = $this->actingAs($user)->get('/tasks');
        $response->assertStatus(200);

    }
}
