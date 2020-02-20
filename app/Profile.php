<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use UsesUuid;

    protected $casts = [
        'id' => 'string'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'avatar',  'caption', 'about' , 'url',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
