<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fee;

class FeeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Fee::truncate();

		Fee::insert([
			['clinic_id' => 1, 'user_id' => 3, 'name' => 'Consult', 'price' => 50000],
			['clinic_id' => 1, 'user_id' => 3, 'name' => 'Injection', 'price' => 100000],
		]);
	}
}
