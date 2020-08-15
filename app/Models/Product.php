<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
	protected $fillable = ['name', 'excerpt', 'description', 'price', 'stock', 'brand_id', 'category_id', 'photo'];

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
		return $this->belongsTo(Category::class);
	}
}
