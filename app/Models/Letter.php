<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
	use HasFactory, SoftDeletes;

	public function clinic()
	{
		return $this->belongsTo('App\Models\Clinic');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function patient()
	{
		return $this->belongsTo('App\Models\Patient');
	}

	public function getDayAttribute($value)
	{
		// return $value->attributes['day'];
	}

	public function getNumberAttribute($value)
	{
		return "LTR{$value}";
	}

	public function setNumberAttribute($value)
	{
		$this->attributes['number'] = date('Ymd') . $value;
	}
}
