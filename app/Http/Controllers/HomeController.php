<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Status;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()){
            $statuses = Status::notReply()->where(function($query){
                return $query->where('user_id', auth()->user()->id)
                             ->orWhereIn('user_id', auth()->user()->friends()->lists('id'));
            })->orderBy('created_at', 'desc')->paginate(10);
            return view('timeline.index', compact('statuses'));
        }
        return view('home');
    }
}