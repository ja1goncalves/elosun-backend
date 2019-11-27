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
            $table->enum('type_address', ['residence', 'industry'])->default('residence');
            $table->boolean('low_income')->default(false);
            $table->enum('phase', ['mono', 'bi', 'tri'])->default('mono');
            $table->string('installation', 20)->nullable();
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('cascade');
            $table->integer('energy_distributor_id')->unsigned();
            $table->foreign('energy_distributor_id')
                ->references('id')->on('energy_distributors')
                ->onDelete('cascade');

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
		Schema::drop('electric_accounts');
	}
}
