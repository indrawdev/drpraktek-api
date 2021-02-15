<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('officers', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('clinic_id')->references('id')->on('clinics');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('officers');
	}
}
