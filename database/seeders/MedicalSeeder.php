<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medical;

class MedicalSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Medical::truncate();

		Medical::insert([
			['clinic_id' => 1, 'registration_id' => 1, 'user_id' => 1, 'patient_id' => 1, 'anamnesa' => 'XX', 'diagnosis' => 'XX', 'action' => 'XX', 'total' => 200000, 'confirmed' => false]
		]);
	}
}
