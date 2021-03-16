<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Patient::truncate();

		Patient::insert([
			['clinic_id' => 1, 'name' => 'Budiawan', 'number' => '88888', 'identity' => 'KTP', 'dob' => '1999-09-09', 'gender' => 'LAKI-LAKI', 'blood' => '0', 'height' => '167', 'weight' => '70', 'address' => 'Jl. Kalimalang', 'phone' => '081111111']
		]);
	}
}
