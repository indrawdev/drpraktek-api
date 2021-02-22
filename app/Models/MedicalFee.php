<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MedicalFee extends Pivot
{
	use HasFactory;

	public function medical()
	{
		return $this->belongsTo('App\Models\Medical');
	}

	public function fee()
	{
		return $this->belongsTo('App\Models\Fee');
	}

	public $incrementing = true;
	
}
