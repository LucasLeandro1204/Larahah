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

        $this->json('POST', route('message.store'), [
            'body' => 'foo',
            'username' => 'test',
        ])->assertStatus(200);

        $message = Message::first();

        $this->assertTrue($message->isOwner($user));
        $this->assertNull($message->author);
    }

    /** @test */
    public function can_create_a_message_with_an_author()
    {
        $user = $this->createUser([
            'username' => 'test',
        ]);
        $author = $this->createUser();

        $this->json('POST', route('message.store'), [
            'body' => 'foo',
            'username' => 'test',
            'author' => $author->id,
        ])->assertStatus(200);

        $message = Message::first();

        $this->assertTrue($message->isOwner($user));
        $this->assertEquals($message->author_id, $author->id);
    }
}
