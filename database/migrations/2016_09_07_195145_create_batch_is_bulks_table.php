<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchIsBulksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batch_is_bulk', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('batch_id')->unique();
			$table->integer('batch_min');
			$table->integer('batch_max');
			$table->integer('batch_check');
			$table->integer('batch_reject');

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
		Schema::drop('batch_is_bulk');
	}

}
