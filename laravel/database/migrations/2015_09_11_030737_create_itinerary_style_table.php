<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryStyleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itinerary_style', function(Blueprint $table)
		{
			$table->integer('itinerary_id')->unsigned()->index();
			$table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');

			$table->integer('style_id')->unsigned()->index();
			$table->foreign('style_id')->references('id')->on('travelstyles')->onDelete('cascade');

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
		Schema::drop('itinerary_style');
	}

}
