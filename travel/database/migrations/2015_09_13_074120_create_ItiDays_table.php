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

			$table->integer('itinerary_id')->unsigned();
			$table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');

			$table->integer('day_num');
			$table->string('title');
			$table->longText('intro');
			//$table->longText('map');
			$table->string('top_exp'); //list of top_exp tags. IDs are imploded by ','

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
