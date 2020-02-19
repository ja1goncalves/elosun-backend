<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(OrdersStatusSeeder::class);
        //$this->call(ModalitiesSeeder::class);
        //$this->call(ProductionTypeSeeder::class);
        //$this->call(EnergyDistributorsTableSeeder::class);
        //$this->call(ElectricStationsSeeder::class);
        //$this->call(BanksSeeder::class);
       // $this->call(ProductionTypeSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(SegmentsSeeder::class);
        
    }
}
