<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    
    // no sé si va el fillable aqui o que pasa      vvv ref
    //protected $fillable = ['heroname','realname','gender','planet_id'];

    public function plats() { // si te apete luego le cambias el nombre a la tabla
        return $this->belongsToMany(
            Plat::class,
            'ingredients_plats');
    }
    
}
