<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnsNullableElectricStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_stations', function (Blueprint $table) {
            $table->string('name', 150)->nullable()->change();
            $table->unsignedInteger('provider_id')->nullable()->change();
            $table->unsignedInteger('energy_distributor_id')->nullable()->change();
            $table->dateTime('connection_at')->nullable()->change();
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
