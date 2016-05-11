<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefectLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defect_levels', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('defect_level_id')->unique();
			$table->string('defect_level_name')->unique();
			$table->string('defect_level_rejected', 3);
			
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
		Schema::drop('defect_levels');
	}

}
