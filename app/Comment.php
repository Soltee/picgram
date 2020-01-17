<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     use UsesUuid;
   
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',  'post_id', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);       
    }

    public function post(){
    	return $this->belongsTo(Post::class);
    }

    
}
