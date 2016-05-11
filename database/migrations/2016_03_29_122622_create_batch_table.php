<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batch', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('batch_name')->unique();
			$table->string('batch_date');
			$table->string('batch_user');
			$table->string('batch_order');

			$table->string('sku');
			$table->string('style');
			$table->string('color');
			$table->string('size');

			$table->string('po');
			$table->string('brand');
			$table->string('category_id');
			$table->string('category_name');

			$table->string('module_name');
			
			$table->string('cartonbox');
			$table->integer('cartonbox_qty');
			$table->integer('cartonbox_produced');
			$table->string('cartonbox_status');
			$table->dateTime('cartonbox_start_date');
			$table->dateTime('cartonbox_finish_date');

			$table->string('bluebox');
			
			$table->integer('batch_qty');
			$table->string('batch_brand_id');
			$table->integer('batch_brand_min');
			$table->integer('batch_brand_max');
			$table->integer('batch_brand_max_reject');

			$table->string('checked_by_id');
			$table->string('checked_by_name');
						
			$table->integer('rejected'); //exist but ?
			$table->string('batch_status');
			$table->string('batch_barcode_match')->nullable();
			$table->string('batch_barcode')->nullable();

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
		Schema::drop('batch');
	}

}
