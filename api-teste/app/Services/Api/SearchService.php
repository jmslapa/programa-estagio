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
     * Recebe um array de modelos Linha e retorna uma LinhaCollection
     *
     * @param $collection
     * @return LinhaCollection
     */
    public function linhaCollection($collection)
    {
        return new LinhaCollection($collection);
    }

    /**
     * Recebe um array de modelos Parada e retorna uma ParadaCollection
     *
     * @param $collection
     * @return ParadaCollection
     */
    public function paradaCollection($collection)
    {
        return new ParadaCollection($collection);
    }

    /**
     * Recebe um array de modelos Veiculo e retorna uma VeiculoCollection
     *
     * @param $collection
     * @return LinhaCollection
     */
    public function VeiculoCollection($collection)
    {
        return new VeiculoCollection($collection);
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
        return $this->linhaCollection($this->paradaRepository->getLinhas($id));
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
        return $this->veiculoCollection($this->linhaRepository->getVeiculos($id));
    }

    /**
     * Retorna todas as paradas que estejam até 500 metros da posição informada
     *
     * @param array $data
     * @return PardaCollection
     */
    public function paradasProximas($data)
    {
        return $this->paradaCollection($this->paradaRepository->getParadasProximas($data));  
    }

    /**
     * Recebe um array com uma query string e transforma o parâmetro 
     * filters em um array de sub query strings utilizando o divisor ';'.
     * 
     * $exemplo $data['filter'] = 'name:like:%parada%;id:>:0' | ['name:like:%parada%', 'id:>:0']
     * @param array $data
     * @return Parada[]
     */
    public function filtrarParadas($data)
    {   
        $filters = $data['filters'] ?? null;
        if($filters){            
            $filters = explode(';', $data['filters']);
            return $this->paradaCollection($this->paradaRepository->filtrar($filters));
        }
        else {
            return $this->paradaCollection($this->paradaRepository->getAll());
        }
    }
}