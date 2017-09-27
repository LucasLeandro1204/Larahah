<?php

namespace App\Jobs;

use App\Message;

class ToggleMessageFavorite
{
    /**
     * The message.
     *
     * @var Message
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): Message
    {
        return $this->message->toggleFavorite();
    }
}
