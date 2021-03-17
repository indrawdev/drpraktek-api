<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MedicalDrug extends Pivot
{
	protected $table = 'medical_drugs';
}
