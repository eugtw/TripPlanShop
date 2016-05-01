<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLnglat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('itiday_places', function(Blueprint $table)
		{
			//$table->string('loc_lat');
			//$table->string('loc_lng');
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
