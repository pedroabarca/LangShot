<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_url','user_id','language',
    ];

    /**
     * Get the Story's comments.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the User that owns the story.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
