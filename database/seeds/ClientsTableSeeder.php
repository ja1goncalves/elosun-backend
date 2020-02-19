<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            'name' => 'Edu o Loko',
            'email' => 'edu@loko@gmail.com',
            'cpf_cnpj' => '78451265233',
            'phone' => '78451245',
            'cellphone' => '78451296',
            'number'  => '78458956',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'deleted_at' => \Carbon\Carbon::now(),
            'user_id' => '5'
        ];

            DB::table('clients')->insert($clients);
        
    }
}