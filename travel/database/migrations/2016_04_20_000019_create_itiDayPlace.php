<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItiDayPlace extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itiday_places', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('itiday_id')->unsigned();
			$table->foreign('itiday_id')->references('id')->on('itidays')->onDelete('cascade');

			$table->string('place_name_short');
			$table->string('place_name_long');
			$table->string('loc_lat');
			$table->string('loc_lng');

			$table->string('image_path');
			$table->string('image_desc');

			$table->string('place_title');
			$table->string('time_to_visit');
			$table->string('business_hours');
			$table->string('duration');
			$table->integer('price_range');
			$table->string('transportation');
			$table->string('experiences');

			$table->longText('place_intro');
			$table->longText('to_do');
			$table->longText('to_eat');
			$table->longText('tips');

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
		Schema::drop('itiday_places');
	}

}
