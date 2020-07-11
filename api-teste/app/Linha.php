<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linha extends Model
{
    public function paradas()
    {
        return $this->belongsToMany(Parada::class);
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
