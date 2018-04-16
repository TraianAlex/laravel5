<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResults(Request $request)
    {
        $query = $request->input('query');
        if(!$query) return redirect()->route('home');
        
        $users = User::where(DB::raw("CONCAT(first_name,' ', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")->get();
        return view('search.results', compact('users'));
    }
}