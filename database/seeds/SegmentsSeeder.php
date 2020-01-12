<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SegmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = array_map('str_getcsv', file(storage_path('app/public/csv/segments.csv')));

        foreach ($banks as $bank) {
            $insert = [
                'title' => $bank[1],
                'bank_id' => $bank[2],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            DB::table('segments')->insert($insert);
        }
    }
}
