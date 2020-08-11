<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}
}
