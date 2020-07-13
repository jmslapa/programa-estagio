<?php

namespace App\Services\Api;

use App\Http\Resources\LinhaResource;
use App\Http\Resources\LinhaCollection;
use App\Http\Resources\ParadaCollection;

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

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public function newParadaCollection($resource)
    {
        return new ParadaCollection($resource);
    }

    /**
     * Adiciona uma ou mais paradas à linha especificada
     * $id: Id da linha alvo
     * $paradas: array com ids das paradas a serem vinculadas à linha
     * 
     * @param integer $id
     * @param array $paradas
     * @return Model[]
     */
    public function removeParadas($id, $paradas = [])
    {
        return $this->newParadaCollection($this->repository->removeParadas($id, $paradas));
    }
}