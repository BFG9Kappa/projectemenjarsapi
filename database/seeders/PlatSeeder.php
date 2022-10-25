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
        $plats =[
                    [                
                        ‘Id’  => 111,
                        ‘Nom’ => "Mandonguilles",
                        ‘Preu’ => 12,
                    ],
                    [ 
                        ‘Id’  => 112,
                        ‘Nom’ => "Escudella",
                        ‘Preu’ => 15,
                    ],
                    [
                        ‘Id’  => 113,
                        ‘Nom’ => "Bacallà a la romana",
                        ‘Preu’ => 16,
                    ],
                    [
                        ‘Id’  => 114,
                        ‘Nom’ => "Meló amb pernil",
                        ‘Preu’ => 14,
                    ],
                ];

            Plat::insert($plats);

    }
}
