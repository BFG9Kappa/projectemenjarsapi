<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plat;

class PlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plats = [
            [
                //'Id'  => 111,
                'nom' => "Macarrons amb tomaquet",
                'preu' => 8.45,
            ],
            [
                //'Id'  => 112,
                'nom' => "Mandonguilles",
                'preu' => 12,
            ],
            [ 
                //'Id'  => 113,
                'nom' => "Escudella",
                'preu' => 15,
            ],
            [
                //'Id'  => 114,
                'nom' => "Bacallà a la romana",
                'preu' => 16,
            ],
            [
                //'Id'  => 115,
                'nom' => "Meló amb pernil",
                'preu' => 14,
            ],
        ];
        
        Plat::insert($plats);

    }
}
