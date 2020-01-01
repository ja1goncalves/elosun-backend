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
        $i = 0;
        foreach ($file as $item) {
            $csv = str_getcsv($item, ';');

            $energy_distributor = \App\Entities\EnergyDistributor::query()
                ->select(['id'])
                ->where('initials', '=', $csv[1])
                ->first()->toArray();

            $production_type = \App\Entities\ProductionTypes::query()
                ->select(['id'])
                ->where('class', '=', $csv[3])
                ->first()->toArray();

            $modality = \App\Entities\Modalities::query()
                ->select(['id'])
                ->where('description', '=', $csv[5])
                ->first()->toArray();

            $address = [
                'city' => $csv[7],
                'state' => $csv[8],
                'zip_code' => preg_replace('/\D/', '', $csv[9])
            ];
            $address = \App\Entities\Address::query()->updateOrCreate($address, $address)->toArray();

            $station = [
                'code_gd' => $csv[0],
                'holder' => $csv[2],
                'production_type_id' => $production_type['id'],
                'subgroup' => $csv[4],
                'potency_kW' => (float)str_replace(',', '.', str_replace("\\", '', $csv[13])),
                'total_ucs' => $csv[6],
                'modality_id' => $modality['id'],
                'address_id' => $address['id'],
                'energy_distributor_id' => $energy_distributor['id'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'connection_at' => \Carbon\Carbon::createFromFormat('d/m/Y', $csv[10])->format('Y-m-d h:m:s')
            ];

            DB::table('electric_stations')->insert($station);
            echo "\n{$i} - {$station['code_gd']}";
            $i++;
        }
    }
}
