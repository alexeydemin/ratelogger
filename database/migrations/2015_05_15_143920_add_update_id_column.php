<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateIdColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
            $table->integer('update_id')->unsigned();
            $table->foreign('update_id')->references('id')->on('updates');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exchanges', function(Blueprint $table)
		{
			$table->dropColumn('update_id');
            $table->dropForeign('exchanges_update_id_foreign');
		});
	}

}
