<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{/*
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('city_id')->unsigned();
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

			$table->string('name')->unique();
			$table->string('address_number');
			$table->string('address_road');

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
		Schema::drop('locations');
	}

}
