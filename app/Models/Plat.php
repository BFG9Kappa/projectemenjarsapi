<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    public function ingredient()
    {// La taula no te el nom correcte, tindrie que ser en singular.
   		return $this->belongsToMany(
       		Ingredient::class,
        	'ingredients_plats');
    }
}
