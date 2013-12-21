<?php

use Illuminate\Database\Migrations\Migration;

class CreateThumbsupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('thumbs', function($table){
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('to_id');
			$table->string('contents', 500);
			$table->timestamps();
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
		Schema::drop('thumbs');
	}

}