<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Letter;

class LetterSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Letter::truncate();

		Letter::insert([
			['clinic_id' => 1, 'user_id' => 1, 'patient_id' => 1, 'uuid' => Str::uuid(), 'number' => 'LT001', 'start_at' => '2021-01-01', 'end_at' => '2021-01-03'] 
		]);
	}
}
