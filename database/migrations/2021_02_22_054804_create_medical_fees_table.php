<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalFeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicals_fees', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->foreignId('medical_id');
			$table->foreignId('fee_id');
			$table->timestamps();

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('medical_id')->references('id')->on('medicals');
			$table->foreign('fee_id')->references('id')->on('fees');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('medicals_fees');
	}
}
