<?php

namespace App\Services\Api;

use App\Http\Resources\LinhaCollection;
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
        $parada = $this->paradaRepository->findById($id);
        return new LinhaCollection($parada->linhas);
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
        $linha = $this->linhaRepository->findById($id);
        return new VeiculoCollection($linha->veiculos);
    }
}