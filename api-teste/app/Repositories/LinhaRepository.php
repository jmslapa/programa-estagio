<?php

namespace App\Repositories;

use App\Parada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Repositório da entidade Parada
 */
class LinhaRepository extends AbstractRepository 
{   

    /**
     * Entidade Parada
     *
     * @var Parada
     */
    private $parada;

    /**
     * Retorna uma instância de Repository
     *
     * @param string $modelClass
     */
    public function __construct(Model $model) 
    {   
        $this->model = $model;
        $this->parada = new Parada();
    }
    /**
     * Cria e persiste um novo registro no banco de dados.
     * $data: Array com os dados a serem atualizados.
     *
     * @param  array  $data
     * @return Model
     */
    public function insert($data)
    {
        $result = DB::transaction(function() use($data) {

            $linha = $this->model->create($data);

            if(isset($data['paradas']) && count($data['paradas'])) {

                $linha->paradas()->sync($data['paradas']);
            }

            return $linha;
        });

        return $result;
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
            return $this->model->findOrFail($id)->load('paradas');
        }
        return $this->model->find($id)->load('paradas');
    }

    /**
     * Atualiza um novo registro no banco de dados.
     * $id: Id do registro a ser atualizado.
     * $data: Array associativo com dados a serem atualizados.
     * $fail: Se $fail = true, lança uma ModelNotFoundException.
     *
     * @param int $id
     * @param array $data
     * @param boolean $fail
     * @return Model
     */
    public function update($id, $data, $fail = true) {
        $result = DB::transaction(function() use($id, $data, $fail) {            
            $linha = null;

            if ($fail) {
                $linha = $this->model->findOrFail($id);
            }else {
                $linha = $this->model->find($id);
            }

            $linha->update($data);

            if(isset($data['paradas']) && count($data['paradas'])) {
                $paradas = $data['paradas'];
                $paradasValidas = [];
                foreach($paradas as $p) {
                    if(!$linha->paradas()->find($p)) {                        
                        $paradasValidas[] = $p;
                    }
                }
                $linha->paradas()->attach($paradasValidas);
            }

            return $linha;
        });
        return $result;
    }

    /**
     * Adiciona uma ou mais paradas à linha especificada.
     * $id: Id da linha alvo.
     * $paradas: array com ids das paradas a serem vinculadas à linha.
     * 
     * @param integer $id
     * @param array $paradas
     * @return Model[]
     */
    public function removeParadas($id, $paradas)
    {
        $result = DB::transaction(function() use($id, $paradas) {

            $linha = $this->model->findOrFail($id);

            if(count($paradas)) {

                $linha->paradas()->detach($paradas);         
            }

            return $linha->paradas;
        });
        return $result;
    }

    /**
     * Retorna todos os veiculos de uma linha.
     * $id: Id de uma linha.
     *
     * @param int $id
     * @return VeiculoCollection
     */
    public function getVeiculos($id)
    {
        $linha = $this->model->findOrFail($id);
        return $linha->veiculos;
    }
}