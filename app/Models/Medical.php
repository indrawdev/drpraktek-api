<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medical extends Model
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

	public function registration()
	{
		return $this->belongsTo('App\Models\Registration');
	}

	public function patient()
	{
		return $this->belongsTo('App\Models\Patient');
	}

	public function fees()
	{
		return $this->belongsToMany('App\Models\Fee')->using('App\Models\MedicalFee');
	}

}
