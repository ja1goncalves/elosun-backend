<?php

use Illuminate\Database\Seeder;

class ProductionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productions = ['Residencial', 'Comercial', 'Industrial', 'Rural'];
        foreach ($productions as $production){
            $insert = [
                'class' =>$production,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            DB::table('production_types')->insert($insert);
        }
    }
}
