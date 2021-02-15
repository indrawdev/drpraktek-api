<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->foreignId('doctor_id');
			$table->foreignId('patient_id');
			$table->foreignId('officer_id');
			$table->datetime('appointment_at');
			$table->string('note');
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('doctor_id')->references('id')->on('doctors');
			$table->foreign('patient_id')->references('id')->on('patients');
			$table->foreign('officer_id')->references('id')->on('officers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('appointments');
	}
}
