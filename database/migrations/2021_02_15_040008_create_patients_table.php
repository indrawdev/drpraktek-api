<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->foreignId('insurance_id')->nullable();
			$table->string('number')->nullable();
			$table->string('identity')->nullable();
			$table->string('name');
			$table->date('dob');
			$table->enum('gender', ['LAKI-LAKI', 'PEREMPUAN']);
			$table->enum('blood', ['O', 'A', 'B', 'AB'])->nullable();
			$table->integer('height')->nullable();
			$table->integer('weight')->nullable();
			$table->text('address');
			$table->string('phone');
			$table->string('insurance_number')->nullable();
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('insurance_id')->references('id')->on('insurances');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('patients');
	}
}
