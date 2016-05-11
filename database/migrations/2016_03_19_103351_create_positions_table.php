<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('position_id')->unique();
			$table->string('position_name')->unique();
			$table->string('position_name_1')->nullable();
			$table->string('position_name_2')->nullable();
			$table->text('position_description')->nullable();
			$table->text('position_description_1')->nullable();
			$table->text('position_description_2')->nullable();
			$table->string('position_applay_to_all', 3);  
			
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
		Schema::drop('positions');
	}

}