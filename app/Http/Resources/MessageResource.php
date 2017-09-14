<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MessageResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id, // hash this shit
            'user' => new UserResource($this->user),
            'body' => $this->body,
            'favorite' => $this->favorite,
            'created_at' => $this->created_at,
        ];
    }
}
