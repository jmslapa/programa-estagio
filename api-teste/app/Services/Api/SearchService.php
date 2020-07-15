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

    /**
     * Retorna todas as paradas que estejam até 500 metros da posição informada
     *
     * @param array $data
     * @return PardaCollection
     */
    public function paradasProximas($data)
    {
        $from_lat = $data['latitude'];
        $from_lon = $data['longitude'];

        $paradasProximas = [];

        foreach($this->paradaRepository->getAll() as $p) {
            $dist = $this->calcularDiscanciaGeocordenadas($from_lat, $from_lon, $p->latitude, $p->longitude);
            if($dist <= 500) {
                $paradasProximas[] = [
                    'parada' => $p,
                    'distancia' => round($dist) . ' metros'
                ];
            }
        }

        return $paradasProximas;        
    }

    /**
     * Recebe latitude e longitude de 2 posições e calcula a distância entre elas em metros.
     *
     * @param double $from_lat
     * @param double $from_lon
     * @param double $to_lat
     * @param double $to_lon
     * @return void
     */
    private function calcularDiscanciaGeocordenadas($from_lat, $from_lon, $to_lat, $to_lon)
    {   
        $d_lat = abs($from_lat - $to_lat);
        $d_lon = abs($from_lon - $to_lon);

        $dist = null;

        if(!$d_lat || !$d_lon) {
            if(!$d_lat) {
                $dist = $d_lon*60*1852;
            }else {
                $dist = $d_lat*60*1852;
            }
        }else {
            $c1 = $d_lat*60*1852;
            $c2 = $d_lon*60*1852;
            $dist = sqrt((pow($c1,2)) + pow($c2, 2));
        }

        return $dist;
    }
}