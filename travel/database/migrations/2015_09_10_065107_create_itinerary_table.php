<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itineraries', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions');

			$table->string('title');

			$table->string('best_season');
			$table->text('top_places');
			$table->string('items_list');

			$table->string('image');
			$table->string('gallery_folder_name');

			$table->text('summary');

			$table->float('price');

			$table->boolean('published')->default(0);

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
		Schema::drop('itineraries');
	}

}
