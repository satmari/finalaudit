<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('category_id')->unique();
			$table->string('category_name')->unique();
			$table->string('category_name_1')->nullable();
			$table->string('category_name_2')->nullable();
			$table->text('category_description')->nullable();
			$table->text('category_description_1')->nullable();
			$table->text('category_description_2')->nullable();
			
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
		Schema::drop('categories');
	}

}
