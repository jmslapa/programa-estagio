<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe que representa o modelo de veículo
 * @OA/Schema
 */
class Veiculo extends Model
{   
    /**
     * Retorna a linha a qual o veículo integra
     *
     * @return mixed
     */
    public function linha()
    {
        return $this->belongsTo(Linha::class);
    }

    /**
     * Retorna a posição geográfica do veículo
     *
     * @return mixed
     */
    public function posicao()
    {
        return $this->hasOne(PosicaoVeiculo::class);
    }
}
