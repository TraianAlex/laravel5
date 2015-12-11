<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStatusRequest;
use App\Status;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postStatus(CreateStatusRequest $request)
    {
        auth()->user()->statuses()->create(['body' => $request->input('status')]);
        flash('Status posted');
        return redirect()->route('home');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000'
        ], [
            'required' => 'The reply body is required'
        ]);
        $status = Status::notReply()->find($statusId);
        if(!$status) return redirect()->route('home');
        if(!auth()->user()->isFriendsWith($status->user) && auth()->user()->id !== $status->user->id){
            return redirect()->route('home');
        }
        $reply = Status::create(['body' => $request->input("reply-{$statusId}")])->user()->associate(auth()->user());
        $status->replies()->save($reply);
        return redirect()->back();
    }

    public function getLike($statusId)
    {
        $status = Status::find($statusId);
        if(!$status) return redirect()->route('home');
        if(!auth()->user()->isFriendsWith($status->user)) return redirect()->route('home');
        if(auth()->user()->hasLikedStatus($status)) return redirect()->back();//
        $like = $status->likes()->create([]);
        auth()->user()->likes()->save($like);
        return redirect()->back();
    }
}