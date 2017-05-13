<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defect', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('defect_name')->unique();	
			$table->string('defect_order');
			
			$table->string('garment_name');
			$table->string('batch_name');

			$table->string('defect_type_id');
			$table->string('defect_type_name');
			$table->string('defect_level_id');
			$table->string('defect_level_name');
			$table->string('defect_level_rejected', 3);

			$table->string('position_id');
			$table->string('position_name');

			$table->string('machine_id');
			$table->string('machine_type');

			$table->string('defect_status')->nullable();
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
		Schema::drop('defect');
	}

}
