<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			// Clinic::truncate();

      Clinic::create([
				'uuid' => Str::uuid(),
				'email' => 'praktek@clinic.co.id',
				'name' => 'Dr Praktek', 
				'slug' => 'dr-praktek',
				'address' => 'Jl. Jagakarsa No. 81B, Jakarta Selatan',
				'phone' => '085294076828',
				'siup' => 'HASLKJLUYWQMNAJSH'
			]);
    }
}
