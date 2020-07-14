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
     * Recupera um registro pelo seu id
     * Se $fail = true, lança uma ModelNotFoundException.
     *
     * @param int  $id
     * @param bool $fail
     *
     * @return Model
     */
    public function findById($id, $fail = true)
    {
        if ($fail) {
        return $this->model->findOrFail($id)->load('posicao');
        }
        return $this->model->find($id)->load('posicao');
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

    /**
     * Atualiza um novo registro no banco de dados
     * $id: $id do registro a ser atualizado
     * $data: array associativo com dados a serem atualizados
     * Se $fail = true, lança uma ModelNotFoundException.
     *
     * @param int $id
     * @param array $data
     * @param boolean $fail
     * @return Model
     */
    public function update($id, $data, $fail = true) {
        $result = DB::transaction(function() use($id, $data, $fail) {

            $veiculo = null;

            if ($fail) {
                $veiculo = $this->model->findOrFail($id);
            }else {
                $veiculo = $this->model->find($id);
            }

            $status = $veiculo->update($data);

            $data['latitude'] ??= $veiculo->posicao->latitude;
            $data['longitude'] ??= $veiculo->posicao->longitude;
            
            $veiculo->posicao->update($data);
            
            return $status;
        });
        return $result;
    }
}