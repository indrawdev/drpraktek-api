<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drug;

class DrugSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Drug::truncate();

		Drug::insert([
			['clinic_id' => 1, 'user_id' => 3, 'sku' => 'PCT', 'name' => 'Paracetamol', 'price' => 20000],
			['clinic_id' => 1, 'user_id' => 3, 'sku' => 'AMX', 'name' => 'Amoxcilin', 'price' => 30000],
		]);
	}
}
