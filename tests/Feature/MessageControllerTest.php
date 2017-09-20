<?php

namespace Tests\Feature;

use App\Message;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageControllerTest extends BrowserKitTestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_can_create_a_message_without_an_author()
    {
        $this->assertEmpty(Message::get());
    }

    /** @test */
    public function we_can_create_a_message_with_an_author()
    {
        $this->assertEmpty(Message::get());
    }

    /** @test */
    public function we_can_not_create_a_message_without_author_if_user_set_anonymous_to_false()
    {
        $this->assertEmpty(Message::get());
    }
}
