<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    public function plats()
    { // La taula no te el nom correcte, tindrie que ser en singular.
        return $this->belongsToMany(
            Plat::class,
            'ingredients_plats');
    }
    
}
