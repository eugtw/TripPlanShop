<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityItinerary extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('city_itinerary', function(Blueprint $table)
		{
			$table->integer('itinerary_id')->unsigned()->index();
			$table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');

			$table->integer('city_id')->unsigned()->index();
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

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
		Schema::drop('city_itinerary');
	}

}
