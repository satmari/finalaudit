<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefectTypeTable extends Migration {

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

		Schema::table('defect_types', function ($table) {

			
			$table->string('visible')->nullable(); //add
			//$table->dropColumn('defect_type_status'); //drop
			// $table->string('name', 50)->nullable()->change(); //change
   			//$table->renameColumn('defect_type_status', 'visible'); //rename


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
