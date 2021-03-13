<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Profile::insert([
			['user_id' => 1, 'name' => 'Indra Pramana', 'dob' => '1987-06-08', 'phone' => '085294076828'],
			['user_id' => 2, 'name' => 'Dokter Indra', 'dob' => '1987-06-08', 'phone' => '-'],
			['user_id' => 3, 'name' => 'Petugas Pramana', 'dob' => '1987-06-08', 'phone' => '-']
		]);
	}
}
