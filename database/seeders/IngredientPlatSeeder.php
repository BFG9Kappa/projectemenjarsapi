<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;



class IngredientPlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 1,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 2,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 3,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 4,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 5,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 6,
            'plat_id' => 1,
            'quantitat' => ""
        ]);
    }
}
