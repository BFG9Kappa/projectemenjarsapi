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
                'nom' => "Macarrons amb tomaquet",
                'preu' => 8.45,
            ],
            [
                'nom' => "Mandonguilles amb salsa",
                'preu' => 12,
            ],
            [ 
                'nom' => "Escudella",
                'preu' => 15,
            ],
            [
                'nom' => "Bacallà a la romana",
                'preu' => 16,
            ],
            [
                'nom' => "Meló amb pernil",
                'preu' => 14,
            ],
        ];
        
        Plat::insert($plats);

    }
}
