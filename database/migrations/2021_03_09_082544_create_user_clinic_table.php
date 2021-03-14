<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClinicTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_clinic', function (Blueprint $table) {

			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('clinic_id');

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

			$table->primary(['user_id', 'clinic_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user_clinic');
	}
}
