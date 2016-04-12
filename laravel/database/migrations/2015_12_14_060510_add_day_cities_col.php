<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDayCitiesCol extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('itidays', function(Blueprint $table)
		{
			$table->string('day_cities');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('itidays', function(Blueprint $table)
		{
			$table->dropColumn('day_cities');

		});
	}

}
