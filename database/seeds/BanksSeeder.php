<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = array_map('str_getcsv', file(storage_path('app/public/csv/banks.csv')));

        foreach ($banks as $bank) {
            $insert = [
                'title' => $bank[3],
                'code' => $bank[4],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            DB::table('banks')->insert($insert);
        }
    }
}
