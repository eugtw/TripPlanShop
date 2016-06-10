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

			//$table->string('place_name_short');
			$table->string('place_address');
			$table->string('website');
			$table->string('loc_lat');
			$table->string('loc_lng');

			$table->string('image_path');
			$table->string('photo_ref_google');
			$table->string('image_desc');

			$table->string('place_title');
			$table->string('time_to_visit');
			$table->string('business_hours');
			$table->string('duration');
			//$table->integer('price_range');
			$table->string('public_transit');
			$table->string('experiences');

			$table->longText('place_intro');
			$table->longText('to_do');
			//$table->longText('to_eat');
			$table->longText('tips');
			$table->longText('transportation')->default(null);
			$table->longText('restaurants')->default(null);
			$table->longText('info_links')->default(null);

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
