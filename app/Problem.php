<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
	protected $guarded = ['id'];

	public function book ()
	{
		return $this->belongsTo(Book::class);
	}

	public function user ()
	{
		return $this->belongsTo(User::class);
	}
}
