<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    public function linha()
    {
        return $this->belongsTo(Linha::class);
    }

    public function posicao()
    {
        return $this->hasOne(PosicaoVeiculo::class);
    }
}
