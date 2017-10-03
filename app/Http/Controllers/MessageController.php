<?php

namespace App\Http\Controllers;

use App\Jobs\CreateMessage as Create;
use App\Jobs\DeleteMessage as Delete;
use App\Queries\MessageQuery as Query;
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
    public function update($id)
    {
        dispatch_now(new Favorite(Message::firstOrFail($id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dispatch_now(new Delete(Message::firstOrFail($id), user()));
    }
}
