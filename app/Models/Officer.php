<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
	use HasFactory, SoftDeletes;

	public function clinic()
	{
		return $this->belongsTo('App\Models\Clinic');
	}

	public function appointments()
	{
		return $this->hasMany('App\Models\Appointment');
	}

	public function registers()
	{
		return $this->hasMany('App\Models\Registration');
	}
}
