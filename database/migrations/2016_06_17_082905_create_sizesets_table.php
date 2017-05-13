<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sizeset', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('sku')->unique();
			$table->string('style');
			$table->string('color')->nullable();
			$table->string('size');
			$table->string('color_desc')->nullable();

			$table->string('scanned')->nullable();
			$table->dateTime('scanned_date')->nullable();
			$table->string('scanned_user')->nullable();

			$table->string('collected')->nullable();
			$table->dateTime('collected_date')->nullable();
			$table->string('collected_user')->nullable();

			$table->string('shipped')->nullable();
			$table->dateTime('shipped_date')->nullable();
			$table->string('shipped_user')->nullable();

			$table->string('temp_coloumn')->nullable();
			
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
		Schema::drop('sizeset');
	}

}
