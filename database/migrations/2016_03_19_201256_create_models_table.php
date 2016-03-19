<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('models', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('model_name')->unique();
			$table->string('model_brand');
			$table->string('category_id')->nullable();
			$table->string('category_name')->nullable();
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
		Schema::drop('models');
	}

}
