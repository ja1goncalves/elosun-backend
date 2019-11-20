<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProvidersTable.
 */
class CreateProvidersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('email', 100)->unique();
            $table->string('cpf_cnpj', 25)->unique();
            $table->string('phone', 15);
            $table->string('cellphone', 15);
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
		Schema::drop('providers');
	}
}
