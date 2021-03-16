<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;

class RegistrationSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Registration::truncate();

		Registration::insert([
			['clinic_id' => 1, 'user_id' => 1, 'patient_id' => 1, 'number' => 'REG0001', 'registered_at' => now()],
		]);
	}
}
