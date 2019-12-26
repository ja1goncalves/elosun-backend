<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElectricStationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file(storage_path('app/public/csv/aneel-units-csv.csv'));
        unset($file[0]);

        foreach ($file as $item) {
            $csv = str_getcsv($item, ';');

            $production_type = \App\Entities\ProductionTypes::query()
                ->select(['id'])
                ->where('class', '=', $csv[2])
                ->first()->toArray();

            $modality = \App\Entities\Modalities::query()
                ->select(['id'])
                ->where('description', '=', $csv[4])
                ->first()->toArray();

            $address = [
                'city' => $csv[6],
                'state' => $csv[7],
                'zip_code' => preg_replace('/\D/', '', $csv[8])
            ];
            $address = \App\Entities\Address::query()->updateOrCreate($address, $address)->toArray();

            $station = [
                'name' => '',
                'code_gd' => $csv[0],
                'holder' => $csv[1],
                'production_type_id' => $production_type['id'],
                'subgroup' => $csv[3],
                'area' => '',
                'potency_kW' => (float)str_replace(',', '.', str_replace("\\", '', $csv[12])),
                'inverters' => '',
                'modules' => '',
                'total_ucs' => $csv[5],
                'modality_id' => $modality['id'],
                'address_id' => $address['id'],
                'energy_distributors_id' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'connection_at' => \Carbon\Carbon::createFromFormat('d/m/Y', $csv[9])->format('Y-m-d hh:mm:ss')
            ];

            DB::table('electric_stations')->insert($station);
        }
    }
}
