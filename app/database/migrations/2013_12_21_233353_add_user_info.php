<?php

use Illuminate\Database\Migrations\Migration;

class AddUserInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users', function($table)
		{
			$table->string('title', 100);
			$table->string('description', 500);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('users', function($table)
		{
			$table->dropColumn('title');
			$table->dropColumn('description');
		});
	}

}