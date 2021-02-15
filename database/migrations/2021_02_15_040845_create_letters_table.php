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
			$table->foreignId('clinic_id');
			$table->foreignId('doctor_id');
			$table->foreignId('patient_id');
			$table->string('number');
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('doctor_id')->references('id')->on('doctors');
			$table->foreign('patient_id')->references('id')->on('patients');
		});

		Schema::create('letters_sick', function (Blueprint $table) {
			$table->foreignId('letter_id');
			$table->date('start');
			$table->date('end');

			$table->foreign('letter_id')->references('id')->on('letters');
		});

		Schema::create('letters_pregnant', function (Blueprint $table) {
			$table->foreignId('letter_id');
			$table->date('start');
			$table->date('end');

			$table->foreign('letter_id')->references('id')->on('letters');
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
		Schema::dropIfExists('letters_sick');
		Schema::dropIfExists('letters_pregnant');
	}
}
