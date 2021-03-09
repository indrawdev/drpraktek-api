<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserClinic extends Pivot
{
	protected $table = 'user_clinic';
}
