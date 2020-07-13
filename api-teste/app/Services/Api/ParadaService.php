<?php

namespace App\Services\Api;

use App\Http\Resources\ParadaCollection;
use App\Http\Resources\ParadaResource;

/**
 * Serviço base para os serviços de entidade
 */
class ParadaService extends AbstractService
{
    /**
     * Retorna uma instância de Resource do Model base do serviço.
     *
     * @return Resoruce
     */
    public function newResource($resource)
    {
        return new ParadaResource($resource);
    }

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public function newCollection($resource)
    {
        return new ParadaCollection($resource);
    }
}