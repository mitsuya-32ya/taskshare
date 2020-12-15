<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStatusCode()
    {
        $response = $this->get('/comments');
        $response->assertStatus(302);

        $user = User::factory(User::class)->create();
        $response = $this->actingAs($user)->get('/comments');
        $response->assertStatus(200);

    }

    
}
