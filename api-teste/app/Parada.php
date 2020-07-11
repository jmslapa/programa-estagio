<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    public function linhas()
    {
        return $this->belongsToMany(Linha::class);
    }
}
