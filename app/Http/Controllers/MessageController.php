<?php

namespace App\Http\Controllers;

use App\Message;
use App\Jobs\CreateMessage as Create;
use App\Jobs\DeleteMessage as Delete;
use App\Queries\MessageQuery as Query;
use App\Policies\MessagePolicy as Policy;
use App\Jobs\ToggleMessageFavorite as Favorite;
use App\Http\Resources\MessageResource as Resource;
use App\Http\Requests\CreateMessageRequest as Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::collection(Query::get(request('query', 'default')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return void
     */
    public function store(Request $request)
    {
        dispatch_now(Create::from($request));
    }

    /**
     * Update a resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Message $message)
    {
        $this->authorize(Policy::UPDATE, $message);

        dispatch_now(new Favorite($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        dispatch_now(new Delete($message, user()));
    }
}
