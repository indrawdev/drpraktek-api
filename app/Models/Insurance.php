<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Insurance extends Model
{
	use HasFactory, SoftDeletes;

	public function patients()
	{
		return $this->hasMany('App\Models\Patient');
	}

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = Str::slug($value);
	}
}
