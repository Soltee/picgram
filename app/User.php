<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Overtrue\LaravelFollow\Followable;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable
{
    use Notifiable, UsesUuid, Followable, Liker;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'avatar' => ''
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // public function following()
    // {
    //     return $this->belongsToMany(Profile::class);
    // }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function path()
    {
        return url("/profile/{$this->id}-". Str::slug($this->caption));
    }
}
