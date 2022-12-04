<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ComandaPlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comandes_plats')->insert([
            'comanda_id' => 1,
            'plat_id' => 1,
        ]);
        DB::table('comandes_plats')->insert([
            'comanda_id' => 1,
            'plat_id' => 3,
        ]);
    }
}
