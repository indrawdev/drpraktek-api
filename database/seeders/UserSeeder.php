<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// User::truncate();

		User::insert([
			['uuid' => Str::uuid(), 'username' => 'superadmin', 'password' => bcrypt('12345678')],
			['uuid' => Str::uuid(), 'username' => 'dokter', 'password' => bcrypt('12345678')],
			['uuid' => Str::uuid(), 'username' => 'officer', 'password' => bcrypt('12345678')]
		]);
	}
}
