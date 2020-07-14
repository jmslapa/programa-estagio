<?php

namespace App\Services\Api;

use App\Http\Resources\PosicaoVeiculoCollection;
use App\Http\Resources\PosicaoVeiculoResource;

/**
 * Serviço base para os serviços de entidade
 */
class PosicaoVeiculoService extends AbstractService
{
    /**
     * Retorna uma instância de Resource do Model base do serviço.
     *
     * @return Resoruce
     */
    public function newResource($resource)
    {
        return new PosicaoVeiculoResource($resource);
    }

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public function newCollection($resource)
    {
        return new PosicaoVeiculoCollection($resource);
    }
}