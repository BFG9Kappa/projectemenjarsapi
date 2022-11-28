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
            ['nom' => 'Macarrons'],
            ['nom' => 'Brou'],
            ['nom' => 'Pa torrat'],
            ['nom' => 'Pebre negre'],
            ['nom' => 'Pebre vermell'],
            ['nom' => 'Comi'],
            ['nom' => 'Vi blanc'],
            ['nom' => 'Carn picada de vedella'],
            ['nom' => 'Carn picada de porc'],
            ['nom' => 'Ou'],
            ['nom' => 'Julivert'],
            ['nom' => 'Llet'],
            ['nom' => 'Pa ratllat'],
            ['nom' => 'Farina'],
            ['nom' => 'Pebrot verd']
        ];

        Ingredient::insert($ingredients);
    }
}
