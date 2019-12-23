<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressIdElectricStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_stations', function (Blueprint $table) {
            $table->unsignedInteger('address_id')->after('provider_id')->nullable();
            $table->foreign('address_id')
                ->on('addresses')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electric_stations', function (Blueprint $table) {
            //
        });
    }
}
