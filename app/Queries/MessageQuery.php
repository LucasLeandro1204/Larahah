<?php

namespace App\Queries;

use App\Message;

class MessageQuery
{
    public static function get(string $option): Message
    {
        return Message::where(self::getWhereClauses($option))->get();
    }

    protected static function getWhereClauses($option)
    {
        $clauses = [
            'received' => [
                ['author_id', '=', user()->id],
            ],
            'favorite' => [
                ['favorite', '=', 1],
                ['user_id', '=', user()->id],
            ],
            'default' => [
                ['author_id', '=', user()->id],
            ],
        ];

        return array_get($clauses, $option, $clauses['default']);
    }
}
