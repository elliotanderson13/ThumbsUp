<?php

use Illuminate\Database\Migrations\Migration;

class EditTableAgain extends Migration {

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
			$table->dropColumn('title');
			$table->dropColumn('description');
		});
		Schema::table('users', function($table)
		{
			$table->string('title', 100)->nullable();
			$table->string('description', 500)->nullable();
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
			$table->dropColumn('title', 100);
			$table->dropColumn('description', 500);
		});
		Schema::table('users', function($table)
		{
			$table->string('title', 100);
			$table->string('description', 500);
		});

	}

}