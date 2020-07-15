<?php

namespace App\Repositories;

/**
 * Repositório da entidade Parada
 */
class ParadaRepository extends AbstractRepository 
{
    /**
    * Retorna todas as linhas de uma parada.
    * $id: Id de uma parada.
    *
    * @param int $id
    * @return Linha[]
    */
   public function getLinhas($id)
   {        
       $parada = $this->model->findOrFail($id);
       return $parada->linhas;
   }

   /**
     * Retorna todas as paradas que estejam até 500 metros da posição informada
     *
     * @param array $data
     * @return PardaCollection
     */
    public function getParadasProximas($data)
    {
        $from_lat = $data['latitude'];
        $from_lon = $data['longitude'];

        $paradasProximas = [];

        foreach($this->model->all() as $p) {
            $dist = $this->calcularDiscanciaGeoCordenadas($from_lat, $from_lon, $p->latitude, $p->longitude);
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
    private function calcularDiscanciaGeoCordenadas($from_lat, $from_lon, $to_lat, $to_lon)
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