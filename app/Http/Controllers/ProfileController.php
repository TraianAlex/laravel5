<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UpdateProfileRequest;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();//->first();
        if(!$user) abord(404);
        
        $statuses = $user->statuses()->notReply()->orderBy('created_at', 'desc')->paginate(10);//get()
        return view('user.profile.index', compact('user', 'statuses'))
            ->with('authUserIsFriend', auth()->user()->isFriendsWith($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        //$user = User::where('id', $id)->first();
        Auth::user()->update($request->all());
        return redirect()->route('user.edit')->with('info', 'Your profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}