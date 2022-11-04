<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ingredients = [
            ['nom' => 'Sal'],
            ['nom' => 'Oli'],
            ['nom' => 'Ceba'],
            ['nom' => 'All'],
            ['nom' => 'Tomaquet'],
            ['nom' => 'Macarrons']
        ];

        Ingredient::insert($ingredients);
    }
}
