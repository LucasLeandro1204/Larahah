<?php

namespace Tests\Unit;

use App\User;
use App\Message;
use Tests\TestCase;
use App\Jobs\CreateMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_can_create_a_message_without_an_author()
    {
        $this->assertEmpty(Message::get());

        $user = $this->createUser();

        $message = (new CreateMessage($user, 'foo'))->handle();

        $this->basicAsserts($message, $user);
    }

    /** @test */
    public function we_can_create_a_message_with_an_author()
    {
        $this->assertEmpty(Message::get());

        $user = $this->createUser();
        $author = $this->createUser();
        $message = (new CreateMessage($user, 'foo', $author->id))->handle();

        $this->basicAsserts($message, $user, $author->id);
    }

    protected function basicAsserts(Message $message, User $user, $author = null)
    {
        $this->assertEquals(1, Message::count());
        $this->assertEquals($user->id, $message->user_id);
        $this->assertEquals($author, $message->author_id);
    }
}
