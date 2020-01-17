<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	use UsesUuid;
    protected $fillable = ['user_id', 'token', 'provider_id', 'provider', 'expires_on'];

  	public function user()
  	{
      	return $this->belongsTo(User::class);
  	}
}
