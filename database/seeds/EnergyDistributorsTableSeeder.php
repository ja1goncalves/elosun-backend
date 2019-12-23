<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnergyDistributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file(storage_path('app/public/csv/aneel-companies-csv.csv')));
        unset($csv[0]);

        foreach ($csv as $element) {
            $distributor = [
                'name' => $element[0],
                'total_stations' => (int)$element[2],
                'total_ucs' => (int)$element[3],
                'potency_kW' => (float)str_replace(',', '.', str_replace('.', '', $element[4])),
                'initials' => $element[1],
                'link_ucs' => $element[5],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            DB::table('energy_distributors')->insert($distributor);
        }
    }
}
