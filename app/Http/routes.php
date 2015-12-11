<?php

$router->controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'friends' => 'FriendController',
	'status' => 'StatusController'
]);

get('search', ['as' => 'search.results', 'uses' => 'SearchController@getResults']);

resource('user', 'ProfileController', ['except' => ['index', 'create', 'store', 'destroy']]);

get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

/*----------------------------------------------------------------------*/

// get('alert', function()
// {
// 	return redirect()->route('home')->with('info', 'You have signed up!.');
// });

// resource('songs', 'SongsController', [
// 	'names' => ['index' => 'songs_path',
// 				 'show' => 'song_path'
// 	 ]
// ]);