<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Patient extends Model
{
	use HasFactory, SoftDeletes;

	public function clinic()
	{
		return $this->belongsTo('App\Models\Clinic');
	}

	public function insurance()
	{
		return $this->belongsTo('App\Models\Insurance');
	}

	public function registers()
	{
		return $this->hasMany('App\Models\Registration');
	}

	public function medicals()
	{
		return $this->hasMany('App\Models\Medical');
	}

	public function letters()
	{
		return $this->hasMany('App\Models\Letter');
	}

	public function getAgeAttribute()
	{
		return Carbon::parse($this->attributes['dob'])->age;
	}

	public function setNumberAttribute($value)
	{
		$this->attributes['number'] = $value;
	}
}
