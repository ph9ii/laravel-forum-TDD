<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store reply for a specific thread.
     * 
     * @params App\Thread Thread $thread
     * @params $channelId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread, Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }
}
