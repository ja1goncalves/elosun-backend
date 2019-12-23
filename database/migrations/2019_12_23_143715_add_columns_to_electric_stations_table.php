<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToElectricStationsTable extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_stations', function (Blueprint $table) {
            $table->string("name", 150)->after('id');
            $table->dropColumn('number');
            $table->string("code_gd", 20)->after('name');
            $table->string("holder", 150)->after('code_gd');
            $table->dropColumn('type_production');
            $table->unsignedInteger('production_type_id')->after('holder');
            $table->string('subgroup', 2)->after('production_type_id');
            $table->dropColumn('plates');
            $table->dropColumn('production');
            $table->unsignedDecimal('potency_kW')->default(0)->after('area');
            $table->unsignedInteger('modality_id')->after('potency_kW');
            $table->unsignedInteger('total_ucs')->default(0)->after('potency_kW');
            $table->unsignedInteger('modules')->default(0)->after('potency_kW');
            $table->unsignedInteger('inverters')->default(0)->after('potency_kW');
            $table->dateTime('connection_at');
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
