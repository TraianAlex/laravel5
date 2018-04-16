<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
	protected $table = 'likeable';
	/**
    * class name Like this funct will be likeable
    */
    public function like()
    {
    	return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}