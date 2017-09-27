<?php

namespace Tests\Unit;

use App\User;
use App\Message;
use Tests\TestCase;
use App\Jobs\CreateMessage;
use App\Jobs\DeleteMessage;
use App\Jobs\FavoriteMessage;
use App\Jobs\ToggleMessageFavorite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_can_create_a_message_without_an_author()
    {
        $user = $this->createUser();

        $message = (new CreateMessage($user, 'foo'))->handle();

        $this->createMessageAsserts($message, $user);
    }

    /** @test */
    public function we_can_create_a_message_with_an_author()
    {
        $user = $this->createUser();
        $author = $this->createUser();
        $message = (new CreateMessage($user, 'foo', $author->id))->handle();

        $this->createMessageAsserts($message, $user, $author->id);
    }

    /** @test */
    public function we_can_delete_a_message()
    {
        $user = $this->createUser();
        $message = $this->createMessage($user);

        (new DeleteMessage($message, $user))->handle();

        $this->assertEquals(0, Message::count());
        $this->assertEquals(1, Message::withTrashed()->count());
    }

    /** @test */
    public function we_can_remove_author_from_message()
    {
        $user = $this->createUser();
        $author = $this->createUser();
        $message = $this->createMessage($user, $author->id);

        $this->createMessageAsserts($message, $user, $author->id);

        $message = (new DeleteMessage($message, $author))->handle();

        $this->assertInstanceOf(Message::class, $message);
        $this->assertNull($message->author_id);
    }

    /** @test */
    public function we_can_toggle_favorite()
    {
        $user = $this->createUser();

        $message = $this->createMessage($user);
        $this->assertFalse($message->favorite);

        $message = (new ToggleMessageFavorite($message))->handle();
        $this->assertTrue($message->favorite);

        $message = (new ToggleMessageFavorite($message))->handle();
        $this->assertFalse($message->favorite);

        $message = (new ToggleMessageFavorite($message))->handle();
        $this->assertTrue($message->favorite);
    }

    protected function createMessage(User $user, $author_id = null, $body = 'foo'): Message
    {
        $message = new Message([
            'body' => $body,
            'author_id' => $author_id,
        ]);
        $message->user()->associate($user);
        $message->save();

        return $message->fresh();
    }

    protected function createMessageAsserts(Message $message, User $user, $author = null)
    {
        $this->assertEquals(1, Message::count());
        $this->assertEquals($user->id, $message->user_id);
        $this->assertEquals($author, $message->author_id);
    }
}
