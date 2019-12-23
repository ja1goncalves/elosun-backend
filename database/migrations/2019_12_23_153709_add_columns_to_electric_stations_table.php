<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToElectricStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_stations', function (Blueprint $table) {
            $table->foreign('modality_id')
                ->on('modalities')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('production_type_id')
                ->on('production_types')->references('id')
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
