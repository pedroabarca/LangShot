<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id','user_id','content',
    ];

    /**
     * Get the User that owns the story.
     */
    public function story()
    {
        return $this->belongsTo('App\Story');
    }
}
