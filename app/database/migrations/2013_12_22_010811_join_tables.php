<?php

use Illuminate\Database\Migrations\Migration;

class JoinTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::drop('thumbs');
		Schema::table('posts', function($table)
		{
			$table->string('type', 10);
			$table->integer('to_id')->nullable();
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
		Schema::table('posts', function($table)
		{
			$table->dropColumn('type');
			$table->dropColumn('to_id');

		});
		Schema::create('thumbs', function($table){
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('to_id');
			$table->string('contents', 500);
			$table->timestamps();
		});
	}

}