<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

     public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'livreur_id');
    }
}
