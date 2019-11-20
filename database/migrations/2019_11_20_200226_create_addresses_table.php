<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAddressesTable.
 */
class CreateAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('state', 2);
            $table->string('zip_code', 10)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('street', 100)->nullable();
            $table->integer('number')->nullable();
            $table->integer('addressable_id');
            $table->string('addressable_type', 50);
            $table->integer('electric')->nullable();
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
		Schema::drop('addresses');
	}
}
