<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'nom' => "Rafa",
                'cognoms' => "Mora Gutierrez",
                'direccio' => "Murcia",
                'telefon' => 868000000,
            ],
            [
                'nom' => "Jaume",
                'cognoms' => "Busquets Ruiz",
                'direccio' => "Tarragona",
                'telefon' => 977000000,
            ],
        ];
        
        Client::insert($clients);
    }
}
