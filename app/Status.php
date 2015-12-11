<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body'];

    public function user()
    {
    	return $this->belongsTo('App\User');//, 'user_id'
    }

    public function scopeNotReply($query)
    {
    	return $query->whereNull('parent_id');
    }

    public function replies()
    {
    	return $this->hasMany('App\Status', 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Likeable', 'likeable');//name of the funct?
    }
}