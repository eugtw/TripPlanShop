<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItiDayPhoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itiday_photos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('itiday_id')->unsigned();
			$table->foreign('itiday_id')->references('id')->on('itidays')->onDelete('cascade');

			$table->string('name');
			$table->string('photo_path');
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
		Schema::drop('itiday_photos');
	}

}
