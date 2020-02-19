<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = [
            'name' => 'Edu o Apulo',
            'email' => 'pauloloko@gmail.com',
            'cpf_cnpj' => '78451265233',
            'phone' => '78451245',
            'cellphone' => '78451296',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => \Carbon\Carbon::now(),
        ];

            DB::table('providers')->insert($providers);
    }
}