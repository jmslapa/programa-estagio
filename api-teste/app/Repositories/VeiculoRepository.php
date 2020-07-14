<?php

namespace App\Repositories;

use App\PosicaoVeiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Repositório da entidade Veiculo
 */
class VeiculoRepository extends AbstractRepository
{   
    /**
     * Instância de Entidade PosicaoVeiculo
     *
     * @var PosicaoVeiculo
     */
    private $posicao;

    /**
     * Retorna uma instância de Repository
     *
     * @param string $modelClass
     */
    public function __construct(Model $model)
    {   
        $this->model = $model;
        $this->posicao = new PosicaoVeiculo();
    }

    /**
     * Insere um novo registro no banco de dados 
     * 
     * @param array  $data
     *
     * @return Model
     */
    public function insert($data) {
        
        $result = DB::transaction(function() use($data) {

            $veiculo = $this->model->create($data);
            $posicao = [
                'veiculo_id' => $veiculo->id,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude']
            ];
            $this->posicao->create($posicao);
            return $veiculo;
        });

        return $result;
    }
}