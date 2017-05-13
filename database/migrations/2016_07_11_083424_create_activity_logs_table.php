<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_log', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('activity_id');
			$table->string('activity_desc')->nullable();

			$table->string('activity_by_id');
			$table->string('activity_by_name')->nullable();

			$table->dateTime('start');
			$table->dateTime('end')->nullable();
			
			$table->integer('duration_num')->nullable();
			//$table->decimal('duration_num')->nullable();

			$table->string('status'); // Open and Closed
			
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
		Schema::drop('activity_log');
	}

}
