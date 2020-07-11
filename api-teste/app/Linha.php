<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe que representa o modelo de linha de transportes
 * @OA/Schema
 */
class Linha extends Model
{
    /**
     * Retorna as paradas atendidas pela linha
     *
     * @return mixed
     */
    public function paradas()
    {
        return $this->belongsToMany(Parada::class);
    }

    /**
     * Retorna os veículos que integram a linha
     *
     * @return mixed
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
