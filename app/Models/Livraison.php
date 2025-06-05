<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function livreur()
{
    return $this->belongsTo(User::class, 'livreur_id');
}

public function commande()
{
    return $this->belongsTo(Commande::class);
}
}
