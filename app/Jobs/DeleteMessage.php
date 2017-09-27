<?php

namespace App\Jobs;

use App\User;
use App\Message;

class DeleteMessage
{
    /**
     * The message.
     *
     * @var Message
     */
    protected $message;

    /**
     * The user.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): Message
    {
        /**
         * If you send a message to your self and then delete it,
         * first it will be removed from "sent", and then from "received".
         * And yeah, at this point you are authorized to delete this message,
         * so we got no point to double check the owner.
         */
        if ($this->message->isAuthor($this->user)) {
            return tap($this->message)->update(['author_id' => null]);
        }

        return tap($this->message)->delete();
    }
}
