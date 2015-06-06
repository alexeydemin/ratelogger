<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectTime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //update `updates` set created_at = TIMESTAMPADD(HOUR, -6, created_at) where id =2;
        DB::table('updates')
            ->update(array('created_at' => DB::raw('TIMESTAMPADD(HOUR, 6, created_at)' ),
                           'updated_at' => DB::raw('TIMESTAMPADD(HOUR, 6, updated_at)' )
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('updates')
            ->update(array('created_at' => DB::raw('TIMESTAMPADD(HOUR, -6, created_at)'),
                           'updated_at' => DB::raw('TIMESTAMPADD(HOUR, -6, updated_at)')
            ));
	}

}
