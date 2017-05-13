<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBatchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		// composer require doctrine/dbal
		// tip: How about deleting vendor/compiled.php manually?

		Schema::table('batch', function ($table) {

			// $table->string('repaired')->nullable(); //add
			// $table->dropColumn('votes'); //drop
			// $table->string('name', 50)->nullable()->change(); //change
   			// $table->renameColumn('from', 'to'); //rename


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
