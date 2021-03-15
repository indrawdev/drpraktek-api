<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Clinic extends Model
{
	use HasFactory, SoftDeletes;

	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'user_clinic');
	}

	public function appointments()
	{
		return $this->hasMany('App\Models\Appointment');
	}

	public function registrations()
	{
		return $this->hasMany('App\Models\Registration');
	}

	public function patients()
	{
		return $this->hasMany('App\Models\Patient');
	}

	public function medicals()
	{
		return $this->hasMany('App\Models\Medical');
	}

	public function letters()
	{
		return $this->hasMany('App\Models\Letter');
	}

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = Str::slug($value);
	}
}
