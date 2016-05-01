<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlaceName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('itiday_places', function(Blueprint $table)
		{
			//$table->string('place_name_short');
			//$table->string('place_name_long');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('itiday_places', function(Blueprint $table)
		{
			//
		});
	}

}
