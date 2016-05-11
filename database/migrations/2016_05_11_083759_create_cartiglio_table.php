<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartiglioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartiglio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('Cod_Bar');		
			$table->string('Cod_Art_CZ');
			$table->string('Cod_Col_CZ');
			$table->string('Tgl_ENG');

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
		Schema::drop('cartiglio');
	}

}
