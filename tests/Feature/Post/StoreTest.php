<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class StoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->withoutMiddleware();
        Notification::fake();

        $param = [
            'title' => 'test',
            'body' => 'body'
        ];

        $response = $this->post(route('posts.store'), $param);

        $response->assertStatus(302);
    }
}
