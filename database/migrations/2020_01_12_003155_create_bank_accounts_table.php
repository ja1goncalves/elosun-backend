<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBankAccountsTable.
 */
class CreateBankAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bank_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id');
            $table->unsignedInteger('provider_id')->nullable();
            $table->unsignedInteger('segment_id')->nullable();
            $table->boolean('main')->default(false);
            $table->string('agency', 30);
            $table->string('agency_dv', 2)->nullable();
            $table->string('account', 50);
            $table->string('account_dv', 2)->nullable();
            $table->string('type', 5)->default('CC')->nullable();
            $table->string('operation')->nullable();

            $table->foreign('bank_id')
                ->on('banks')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider_id')
                ->on('providers')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('segment_id')
                ->on('segments')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->softDeletes();
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
		Schema::drop('bank_accounts');
	}
}
