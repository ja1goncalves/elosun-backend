<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateElectricStationsTable.
 */
class CreateElectricStationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('electric_stations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20)->unique();
            $table->string('type_production', 20)->default('residence');
            $table->integer('plates')->nullable();
            $table->float('area', 20)->nullable();
            $table->float('production');
            $table->integer('provider_id');

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
		Schema::drop('electric_stations');
	}
}
