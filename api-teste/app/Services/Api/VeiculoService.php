<?php

namespace App\Services\Api;

use App\Http\Resources\VeiculoCollection;
use App\Http\Resources\VeiculoResource;

/**
 * Serviço base para os serviços de entidade
 */
class VeiculoService extends AbstractService
{
    /**
     * Retorna uma instância de Resource do Model base do serviço.
     *
     * @return Resoruce
     */
    public function newResource($resource)
    {
        return new VeiculoResource($resource);
    }

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public function newCollection($resource)
    {
        return new VeiculoCollection($resource);
    }
}