<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		RoleUser::insert([
			['user_id' => 1, 'role_id' => 1],
			['user_id' => 2, 'role_id' => 2],
			['user_id' => 3, 'role_id' => 3]
		]);
	}
}
