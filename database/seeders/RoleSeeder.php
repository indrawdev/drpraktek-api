<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Role::create(
			['name' => 'Superadmin', 'slug' => 'superadmin'],  // superadmin
			['name' => 'Admin', 'slug' => 'admin'], // owner clinic
			['name' => 'Doctor', 'slug' => 'doctor'], // doctor on clinic
			['name' => 'Officer', 'slug' => 'officer'] // officer on clinic
		);
	}
}
