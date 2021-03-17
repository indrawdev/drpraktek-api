<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalDrugsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicals_drugs', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clinic_id');
			$table->foreignId('medical_id');
			$table->foreignId('drug_id');
			$table->string('name');
			$table->integer('qty');
			$table->decimal('subtotal');
			$table->timestamps();

			$table->foreign('clinic_id')->references('id')->on('clinics');
			$table->foreign('medical_id')->references('id')->on('medicals');
			$table->foreign('drug_id')->references('id')->on('drugs');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('medicals_drugs');
	}
}
