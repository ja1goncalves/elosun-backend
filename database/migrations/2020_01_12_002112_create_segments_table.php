<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSegmentsTable.
 */
class CreateSegmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('segments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->unsignedInteger('bank_id');
            $table->foreign('bank_id')
                ->on('banks')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
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
		Schema::drop('segments');
	}
}
