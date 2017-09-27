<?php

namespace App\Jobs;

use App\User;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class CreateMessage
{
    /**
     * The user model.
     *
     * @var User
     */
    protected $user;

    /**
     * The message body.
     *
     * @var string
     */
    protected $body;

    /**
     * The message author.
     *
     * @var User
     */
    protected $author;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $body, $author = null)
    {
        $this->user = $user;
        $this->body = $body;
        $this->author = $author;
    }

    /**
     * Parse request data.
     *
     * @return self
     */
    public static function from(CreateMessageRequest $request): self
    {
        $user = self::canReceiveAnonymousMessages($request->getUser(), $request->get('author'));

        return new static(
            $user,
            $request->get('body'),
            $request->get('author')
        );
    }

    /**
     * Execute the job.
     */
    public function handle(): Message
    {
        return $this->user->messages()->create([
            'body' => $this->body,
            'author_id' => $this->author,
        ])->fresh();
    }

    protected static function canReceiveAnonymousMessages(User $user, $author = null): User
    {
        if (is_null($author) && !$user->anonymous) {
            abort(400, 'This user does not accept anonymous messages.');
        }

        return $user;
    }
}
