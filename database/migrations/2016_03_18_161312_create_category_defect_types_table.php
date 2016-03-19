<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryDefectTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_defect_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('defect_type_id');
			$table->string('defect_type_name')->nullable();
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
		Schema::drop('category_defect_types');
	}

}
