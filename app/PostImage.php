<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'post_id', 'url',
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
