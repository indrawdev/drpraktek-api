<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClinicUser;

class ClinicUserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// ClinicUser::truncate();

		ClinicUser::insert([
			['user_id' => 2, 'clinic_id' => 1],
			['user_id' => 3, 'clinic_id' => 1]
		]);
	}
}
