<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom', 'preu'
    ];

    public function ingredient()
    {// La taula no te el nom correcte, tindrie que ser en singular.
   		return $this->belongsToMany(
       		Ingredient::class,
        	'ingredients_plats');
    }

    public function comanda()
    {
   		return $this->belongsToMany(
       		Comanda::class,
        	'comandes_plats');
    }

}
