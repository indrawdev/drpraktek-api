<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Insurance::truncate();

		Insurance::insert([
			['name' => 'BPJS', 'address' => 'Jakarta']
		]);
	}
}
