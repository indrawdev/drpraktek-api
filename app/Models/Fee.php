<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
	use HasFactory, SoftDeletes;

	public function clinic()
	{
		return $this->belongsTo('App\Models\Clinic');
	}

	public function medicals()
	{
		return $this->hasMany('App\Models\Medical');
	}
}
