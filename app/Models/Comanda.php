<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class Comanda extends Model
{
    public $table = "comandes"; // Perque si no agafe el plural de "comanda" com a "comandaS".
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'nom', 'preu', 'estat'
    ];

    public function plat()
    {
        return $this->belongsToMany(
            Plat::class,
         'comandes_plats');
    }

}
