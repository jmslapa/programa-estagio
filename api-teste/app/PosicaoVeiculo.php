<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosicaoVeiculo extends Model
{
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
