<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEnergyDistributorsTable.
 */
class CreateEnergyDistributorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('energy_distributors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('initials', 10)->nullable();
            $table->string('site', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('energy_distributors');
	}
}
