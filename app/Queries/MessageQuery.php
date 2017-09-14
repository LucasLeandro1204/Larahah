<?php

namespace App\Queries;

use App\Message;
use Illuminate\Contracts\Pagination\Paginator;

class MessageQuery
{
    public static function get(string $option): Paginator
    {
        return Message::where(self::getWhereClauses($option))->paginate(5);
    }

    protected static function getWhereClauses($option)
    {
        $clauses = [
            'received' => [
                ['user_id', '=', user()->id],
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
