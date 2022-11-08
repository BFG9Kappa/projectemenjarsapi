<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    //lo mismo

    public function ingredient() {
   		return $this->belongsToMany(
       		 Ingredient::class,
        	'ingredients_plats');
    }
}
