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
            $table->enum('type_production', ['residence', 'industry'])->default('residence');
            $table->integer('plates')->nullable();
            $table->float('area', 20)->nullable();
            $table->float('production');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')
                ->references('id')->on('providers')
                ->onDelete('cascade');
            $table->integer('energy_distributor_id')->unsigned();
            $table->foreign('energy_distributor_id')
                ->references('id')->on('energy_distributors')
                ->onDelete('cascade');

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
