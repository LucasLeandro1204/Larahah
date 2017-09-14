<?php

namespace App\Http\Controllers;

use App\Jobs\CreateMessage;
use App\Queries\MessageQuery;
use App\Http\Resources\MessageResource;
use App\Http\Requests\CreateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MessageResource::collection(MessageQuery::get(request('query', 'default')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateMessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        dispatch_now(CreateMessage::from($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
