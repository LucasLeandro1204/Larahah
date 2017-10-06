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

    /** @test */
    public function can_favorite_a_message_if_is_owner()
    {
        $message = factory(Message::class)->create();
        $notOwner = $this->createUser();

        $this->assertFalse($this->toggleFavorite($message, $notOwner, 403));

        $this->assertTrue($this->toggleFavorite($message));
        $this->assertFalse($this->toggleFavorite($message));
        $this->assertTrue($this->toggleFavorite($message));
    }

    private function toggleFavorite(Message $message, $user = null, $status = 200): bool
    {
        $this->actingAs($user ?: $message->user)
            ->json('PUT', route('message.update', $message))
            ->assertStatus($status);

        return $message->fresh()->favorite;
    }
}
