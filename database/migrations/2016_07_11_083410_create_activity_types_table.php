<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_type', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('activity_id')->unique();
			$table->string('activity_desc');
			$table->string('activity_desc1')->nullable();
			$table->string('activity_desc2')->nullable();

			$table->boolean('deleted')->nullable();

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
		Schema::drop('activity_type');
	}

}
