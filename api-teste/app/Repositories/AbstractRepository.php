<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe abtstrata base para os repositórios de entidades
 */
abstract class AbstractRepository {

    /**
     * Entidade do repositório
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * Retorna uma instância de Repository
     *
     * @param string $modelClass
     */
    public function __construct(Model $model) 
    {
        $this->model = $model; 
    }
    /**
     * Retorna todos os registros
     *
     * @param int $perPage
     * @return void EloquentCollection|Paginator
     */
    public function getAll($perPage = 15)
    {
        if($perPage > 0) {
            return $this->model->paginate($perPage);
        }

        return $this->model->get();
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
    public function findByID($id, $fail = true)
    {
        if ($fail) {
        return $this->model->findOrFail($id);
        }
        return $this->model->find($id);
    }

    /**
     * Insere um novo registro no banco de dados 
     * 
     * @param array  $data
     *
     * @return Model
     */
    public function insert($data) {
        return $this->model->create($data);
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
        $item = null;
        if ($fail) {
            $item = $this->model->findOrFail($id);
        }else {
            $item = $this->model->find($id);
        }
        return $item->update($data);
    }

    /**
     * Exclui um registro pelo seu id
     * Se $fail = true, lança uma ModelNotFoundException.
     *
     * @param int  $id
     * @param bool $fail
     *
     * @return void;
     */
    public function delete($id, $fail = true)
    {
        $item = null;
        if ($fail) {
            $item = $this->model->findOrFail($id);
        }else {
            $item = $this->model->find($id);
        }
        return $item->delete();

    }

}