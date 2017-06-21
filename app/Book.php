<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	public function problems ()
	{
		return $this->hasMany(Problem::class);
	}

}
