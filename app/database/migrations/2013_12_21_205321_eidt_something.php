<?php

use Illuminate\Database\Migrations\Migration;

class EidtSomething extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('edit', function($table)
		{
			$table->increments('id');
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
		Schema::drop('edit');
	}

}