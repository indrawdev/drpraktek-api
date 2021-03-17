<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinics', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->string('email')->unique();
			$table->string('name');
			$table->string('slug');
			$table->text('address');
			$table->string('phone');
			$table->string('logo')->nullable();
			$table->string('siup')->nullable();
			$table->integer('count_patient')->unsigned();
			$table->integer('count_registration')->unsigned();
			$table->integer('count_medical')->unsigned();
			$table->integer('count_drug')->unsigned();
			$table->integer('count_fee')->unsigned();
			$table->integer('count_letter')->unsigned();
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('clinics');
	}
}
