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
		Role::insert([
			['name' => 'Superadmin', 'slug' => 'superadmin'],
			['name' => 'Doctor', 'slug' => 'doctor'],
			['name' => 'Officer', 'slug' => 'officer']
		]);
	}
}
