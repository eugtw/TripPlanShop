<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{/*
		Schema::create('day_location', function(Blueprint $table)
		{
			$table->integer('day_id')->unsigned()->index();
			$table->foreign('day_id')->references('id')->on('itidays')->onDelete('cascade');

			$table->integer('location_id')->unsigned()->index();
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

			$table->timestamps();
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('day_location');
	}

}
