<?php

namespace App\Queries;

use App\Message;
use Illuminate\Contracts\Pagination\Paginator;

class MessageQuery
{
    public static function get(string $option, int $perPage = 5): Paginator
    {
        $clauses = [
            'received' => [
                ['deleted_at', '=', null],
                ['user_id', '=', user()->id],
            ],
            'favorite' => [
                ['favorite', '=', 1],
                ['deleted_at', '=', null],
                ['user_id', '=', user()->id],
            ],
            'sent' => [
                ['author_id', '=', user()->id],
            ],
        ];

        return Message::withTrashed()
            ->where(array_get_d($clauses, $option, 'received'))
            ->paginate($perPage)
            ->appends([
                'query' => $option,
            ]);
    }
}
