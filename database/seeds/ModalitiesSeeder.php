<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modalities = [
            'Geracao na propria UC',
            'Autoconsumo remoto',
            'Geracao compartilhada',
            'Multiplas UC'
        ];
        foreach ($modalities as $modality){
            $inset = [
                'description' =>$modality,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            DB::table('modalities')->insert($inset);
        }
    }
}
