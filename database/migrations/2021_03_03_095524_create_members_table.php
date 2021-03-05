<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id');
			$table->foreignId('role_id');
			$table->foreignId('permission_id');
			$table->string('code');
			$table->string('password');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('role_id')->references('id')->on('roles');
			$table->foreign('permission_id')->references('id')->on('permissions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('members');
	}
}
