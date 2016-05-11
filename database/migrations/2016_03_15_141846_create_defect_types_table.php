<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefectTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defect_types', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('defect_type_id')->unique();
			$table->string('defect_type_name')->unique();
			$table->string('defect_type_name_1')->nullable();
			$table->string('defect_type_name_2')->nullable();
			$table->text('defect_type_description')->nullable();
			$table->text('defect_type_description_1')->nullable();
			$table->text('defect_type_description_2')->nullable();
			$table->string('defect_level_id'); 
			$table->string('defect_level_name');
			$table->string('defect_level_rejected', 3); // yes/no
			$table->string('defect_applay_to_all', 3);  //yes/no
			
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
		Schema::drop('defect_types');
	}

}