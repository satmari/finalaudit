<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('garment', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('garment_name')->unique();
			$table->string('garment_order');

			$table->string('batch_name');

			$table->string('cartonbox');

			$table->string('sku');

			$table->string('po');
			$table->string('brand');
			$table->string('category_id');
			$table->string('category_name');

			$table->string('garment_status');
			$table->string('garment_barcode_match')->nullable();
			$table->string('garment_barcode')->nullable();

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
		Schema::drop('garment');
	}

}
