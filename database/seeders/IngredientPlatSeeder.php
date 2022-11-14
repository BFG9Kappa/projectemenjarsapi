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
            'quantitat' => "2 u"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 4,
            'plat_id' => 1,
            'quantitat' => "2 u"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 5,
            'plat_id' => 1,
            'quantitat' => "1 kg"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 6,
            'plat_id' => 1,
            'quantitat' => "500 gr"
        ]);
        // Dos
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 1,
            'plat_id' => 2,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 2,
            'plat_id' => 2,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 4,
            'plat_id' => 2,
            'quantitat' => "3 u"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 7,
            'plat_id' => 2,
            'quantitat' => ""
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 8,
            'plat_id' => 2,
            'quantitat' => "2 llesques"
        ]);
        //
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 9,
            'plat_id' => 2,
            'quantitat' => "1 cullerada"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 10,
            'plat_id' => 2,
            'quantitat' => "1 cullerada"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 11,
            'plat_id' => 2,
            'quantitat' => "1 u"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 12,
            'plat_id' => 2,
            'quantitat' => "1 cullerada"
        ]);
        DB::table('ingredients_plats')->insert([
            'ingredient_id' => 13,
            'plat_id' => 2,
            'quantitat' => "1 got"
        ]);
    }
}
