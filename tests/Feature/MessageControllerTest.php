<?php

namespace Tests\Feature;

use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_a_message_without_an_author()
    {
        $user = $this->createUser([
            'username' => 'test',
        ]);

        $response = $this->json('POST', '/api/message', [
            'username' => 'test',
            'body' => 'foo',
        ]);
        $response->assertStatus(200);

        $message = Message::first();

        $this->assertTrue($message->isOwner($user));
    }
}
