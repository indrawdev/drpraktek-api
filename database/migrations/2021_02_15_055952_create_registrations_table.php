<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrations', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->foreignId('patient_id');
			$table->foreignId('officer_id');
			$table->string('number');
			$table->dateTime('registered_at', 0);
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
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
		Schema::dropIfExists('registrations');
	}
}
