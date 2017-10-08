<?php

namespace Tests\Feature;

use App\Message;
use Tests\TestCase;
use App\Notifications\MessageReceived;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_a_message_without_an_author()
    {
        Notification::fake();

        $user = $this->createUser([
            'username' => 'test',
        ]);

        $this->post(route('message.store'), [
            'body' => 'foo',
            'username' => 'test',
        ])->assertStatus(200);

        $message = Message::first();

        $this->assertTrue($message->isOwner($user));
        $this->assertNull($message->author);

        Notification::assertSentTo(
            $user,
            MessageReceived::class,
            function ($notification) use ($message) {
                return $notification->message->id == $message->id;
            }
        );
    }

    /** @test */
    public function can_create_a_message_with_an_author()
    {
        Notification::fake();

        $user = $this->createUser([
            'username' => 'test',
        ]);
        $author = $this->createUser();

        $this->post(route('message.store'), [
            'body' => 'foo',
            'username' => 'test',
            'author' => $author->id,
        ])->assertStatus(200);

        $message = Message::first();

        $this->assertTrue($message->isOwner($user));
        $this->assertEquals($message->author_id, $author->id);

        Notification::assertSentTo(
            $user,
            MessageReceived::class,
            function ($notification) use ($message) {
                return $notification->message->id == $message->id;
            }
        );

        Notification::assertNotSentTo([$author], MessageReceived::class);
    }

    /** @test */
    public function can_favorite_a_message_if_is_owner()
    {
        $message = factory(Message::class)->create();
        $other = $this->createUser();

        $this->assertFalse($this->toggleFavorite($message, $other, 403));

        $this->assertTrue($this->toggleFavorite($message));
        $this->assertFalse($this->toggleFavorite($message));
        $this->assertTrue($this->toggleFavorite($message));
    }

    /** @test */
    public function can_delete_a_message_if_is_owner_or_author()
    {
        $other = $this->createUser();
        $user = $this->createUser();
        $author = $this->createUser();
        $message = factory(Message::class)->create([
            'user_id' => $user->id,
            'author_id' => $author->id,
        ])->fresh();

        $assert = [
            'data' => [
                [
                    'id' => $message->id,
                ],
            ],
        ];

        $this->actingAs($other)
            ->delete(route('message.destroy', $message))
            ->assertStatus(403);

        $this->actingAs($user)
            ->get(route('message.index'))
            ->assertStatus(200)
            ->assertJson($assert);

        $this->actingAs($author)
            ->get(route('message.index', ['query' => 'sent']))
            ->assertStatus(200)
            ->assertJson($assert);

        $this->actingAs($user)
            ->delete(route('message.destroy', $message))
            ->assertStatus(200);

        $response = $this->actingAs($user)
            ->get(route('message.index'))
            ->assertStatus(200);

        $this->assertEmpty(array_get($response->getOriginalContent(), 'data'));

        $this->actingAs($author)
            ->get(route('message.index', ['query' => 'sent']))
            ->assertStatus(200)
            ->assertJson($assert);

        $this->actingAs($author)
            ->delete(route('message.destroy', $message))
            ->assertStatus(200);

        $response = $this->actingAs($user)
            ->get(route('message.index'))
            ->assertStatus(200);

        $this->assertEmpty(array_get($response->getOriginalContent(), 'data'));

        $response = $this->actingAs($author)
            ->get(route('message.index'))
            ->assertStatus(200);

        $this->assertEmpty(array_get($response->getOriginalContent(), 'data'));
    }

    private function toggleFavorite(Message $message, $user = null, $status = 200): bool
    {
        $this->actingAs($user ?: $message->user)
            ->put(route('message.update', $message))
            ->assertStatus($status);

        return $message->fresh()->favorite;
    }
}
