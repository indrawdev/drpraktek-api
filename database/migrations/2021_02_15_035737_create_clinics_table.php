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
			$table->foreignId('user_id');
			$table->string('name');
			$table->string('slug');
			$table->text('address');
			$table->string('phone');
			$table->string('email');
			$table->string('logo')->nullable();
			$table->string('siup')->nullable();
			$table->timestamps();
			$table->softDeletes('deleted_at', 0);

			$table->foreign('user_id')->references('id')->on('users');
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
