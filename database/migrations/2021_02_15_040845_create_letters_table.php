<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('letters', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->foreignId('clinic_id');
			$table->foreignId('doctor_id');
			$table->foreignId('patient_id');
			$table->string('number');
			$table->date('start_at')->nullable();
			$table->date('end_at')->nullable();
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('doctor_id')->references('id')->on('doctors');
			$table->foreign('patient_id')->references('id')->on('patients');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('letters');
	}
}
