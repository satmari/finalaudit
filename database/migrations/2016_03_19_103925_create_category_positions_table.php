<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_positions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('position_id');
			$table->string('position_name')->nullable();
			$table->string('category_id');
			$table->string('category_name')->nullable();
			$table->string('link_type');
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
		Schema::drop('category_positions');
	}

}
