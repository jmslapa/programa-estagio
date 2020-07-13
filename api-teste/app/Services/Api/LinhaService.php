<?php

namespace App\Services\Api;

use App\Http\Resources\LinhaCollection;
use App\Http\Resources\LinhaResource;
use App\Linha;

/**
 * Serviço abstrato base para os serviços de entidade
 */
class LinhaService extends AbstractService
{
    /**
     * Retorna uma instância de Resource do Model base do serviço.
     *
     * @return Resoruce
     */
    public function newResource($resource)
    {
        return new LinhaResource($resource);
    }

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public function newCollection($resource)
    {
        return new LinhaCollection($resource);
    }
}