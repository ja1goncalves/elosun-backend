<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsEnergyDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('energy_distributors', function (Blueprint $table) {
            $table->string('link_ucs', 50)->nullable()->after('site');
            $table->integer('total_stations')->default(0)->after('name');
            $table->integer('total_ucs')->default(0)->after('total_stations');
            $table->float('potential_kW')->default(0.00)->after('total_ucs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('energy_distributors', function (Blueprint $table) {
            //
        });
    }
}
