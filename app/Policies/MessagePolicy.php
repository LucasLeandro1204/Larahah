<?php

namespace App\Policies;

use App\User;
use App\Message;

class MessagePolicy
{
    const DELETE = 'delete';
    const UPDATE = 'update';

    /**
     * Determine whether the user can update the message.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function update(User $user, Message $message): bool
    {
        return $message->isOwner($user);
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function delete(User $user, Message $message): bool
    {
        return $message->isOwner($user) || $message->isAuthor($user);
    }
}
