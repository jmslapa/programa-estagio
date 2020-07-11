<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe que representa o modelo de parada de veículos
 * @OA/Schema
 */
class Parada extends Model
{   
    /**
     * Retorna as linhas que atendem a parada
     *
     * @return mixed
     */
    public function linhas()
    {
        return $this->belongsToMany(Linha::class);
    }
}
