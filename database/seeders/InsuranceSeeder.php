<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insurance;

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
			['name' => 'BPJS', 'slug' => 'bpjs', 'address' => 'Jakarta']
		]);
	}
}
