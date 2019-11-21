<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContractAccountsTable.
 */
class CreateElectricAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('electric_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20)->unique();
            $table->string('type_address', 20)->default('residence');
            $table->boolean('low_income')->default(false);
            $table->enum('phase', ['mono', 'bi', 'tri']);
            $table->string('installation', 20)->nullable();
            $table->integer('client_id');
            $table->integer('energy_distributor_id');

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
		Schema::drop('contract_accounts');
	}
}
