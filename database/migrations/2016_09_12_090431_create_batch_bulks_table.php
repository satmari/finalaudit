<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchBulksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batch_bulk', function(Blueprint $table)
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
			
			$table->string('cartonbox')->nullable();						// must be nullable for bulk
			$table->integer('cartonbox_qty')->nullable();
			$table->integer('cartonbox_produced');					
			$table->string('cartonbox_status')->nullable();
			$table->dateTime('cartonbox_start_date')->nullable();
			$table->dateTime('cartonbox_finish_date')->nullable();

			$table->string('bluebox')->nullable();
			
			$table->integer('batch_qty');
			$table->string('batch_brand_id');
			$table->integer('batch_brand_min');
			$table->integer('batch_brand_max');
			$table->integer('batch_brand_max_reject');

			$table->string('checked_by_id');
			$table->string('checked_by_name');
		
			$table->integer('rejected')->nullable(); // exist but ?
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
		Schema::drop('batch_bulk');
	}

}
