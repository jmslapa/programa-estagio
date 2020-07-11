<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe que representa a posição geográfica de um veículo
 * @OA/Schema
 */
class PosicaoVeiculo extends Model
{
    /**
     * Retorna o veículo apontado pela posição
     *
     * @return mixed
     */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
