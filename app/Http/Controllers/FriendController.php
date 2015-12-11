<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $friends = auth()->user()->friends();
        $requests = auth()->user()->friendRequests();
        return view('friends.index', compact('friends', 'requests'));
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();
        if(!$user) return redirect('home')->with('info', 'That user could not be found');
        if(auth()->user()->id === $user->id){
            return redirect()->route('home');
        }
        if(auth()->user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(auth()->user())){
            return redirect()->route('user.show', ['username' => $user->username])
                             ->with('info', 'Friend request already pending.');
        }
        if(auth()->user()->isFriendsWith($user)){
            return redirect()->route('user.show', ['username' => $user->username])
                             ->with('info', 'You are already friends.');
        }
        auth()->user()->addFriend($user);
            return redirect()->route('user.show', ['username' => $user->username])
                             ->with('info', 'Friend request sent.');
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();
        if(!$user) return redirect('home')->with('info', 'That user could not be found');
        if(!auth()->user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }
        auth()->user()->acceptFriendRequest($user);
        return redirect()->route('user.show', ['username' => $user->username])
                             ->with('info', 'Friend request accepted.');
    }

    public function postDelete($username)
    {
        $user = User::where('username', $username)->first();
        if(!auth()->user()->isFriendsWith($user)){
            return redirect()->back();
        }
        auth()->user()->deleteFriend($user);
        flash('Friend deleted');
        return redirect()->back();
    }
}