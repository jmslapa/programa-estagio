<?php

namespace App\Services\Api;

use App\Http\Resources\LinhaCollection;
use App\Http\Resources\ParadaCollection;
use App\Http\Resources\VeiculoCollection;
use App\Linha;
use App\Parada;
use App\Repositories\LinhaRepository;
use App\Repositories\ParadaRepository;

/**
 * Serviço de operações de busca
 */
class SearchService
{
    /**
     * Instância de ParadaRepository
     *
     * @var ParadaRepository
     */
    private $paradaRepository;

    /**
     * Instância de LinhaRepository
     *
     * @var LinhaRepository
     */
    private $linhaRepository;

    /**
     * Retorna uma instância de SearchRepository
     */
    public function __construct()
    {
        $this->paradaRepository = new ParadaRepository(new Parada());
        $this->linhaRepository = new LinhaRepository(new Linha());
    }
    
    /**
     * Retorna todas as linhas de uma parada.
     * $id: Id de uma parada.
     *
     * @param int $id
     * @return LinhaCollection
     */
    public function linhasPorParada($id)
    {        
        return new LinhaCollection($this->paradaRepository->getLinhas($id));
    }

    /**
     * Retorna todos os veiculos de uma linha.
     * $id: Id de uma linha.
     *
     * @param int $id
     * @return VeiculoCollection
     */
    public function veiculosPorLinha($id)
    {
        return new VeiculoCollection($this->linhaRepository->getVeiculos($id));
    }

    /**
     * Retorna todas as paradas que estejam até 500 metros da posição informada
     *
     * @param array $data
     * @return PardaCollection
     */
    public function paradasProximas($data)
    {
        return new ParadaCollection($this->paradaRepository->getParadasProximas($data));  
    }
}