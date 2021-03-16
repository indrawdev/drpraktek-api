<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			ClinicSeeder::class,
			RoleSeeder::class,
			UserSeeder::class,
			RoleUserSeeder::class,
			ClinicUserSeeder::class,
			ProfileSeeder::class,
			PatientSeeder::class,
			DrugSeeder::class,
			FeeSeeder::class,
			RegistrationSeeder::class,
			MedicalSeeder::class,
			LetterSeeder::class
		]);
	}
}
