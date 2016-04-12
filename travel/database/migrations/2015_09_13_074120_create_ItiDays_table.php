<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItiDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itidays', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('day_of_itinerary');
			$table->integer('itinerary_id')->unsigned();
			$table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');

			$table->string('image');

			$table->string('title');
			$table->string('intro');
			$table->float('budget');

			$table->string('day_cities');
			$table->string('places'); //free type by posters and places are separated by ','
										//to be replaced later with Tripadvisor api. For now, simply text inputs
			$table->string('top_exp'); //list of top_exp tags. IDs are imploded by ','

			$table->string('activities');

			$table->text('summary');
			//$table->string('img');
			//image table

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
		Schema::drop('itidays');
	}

}
