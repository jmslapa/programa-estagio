<?php

namespace App\Services\Api;

use App\Repositories\AbstractRepository;

/**
 * Serviço abstrato base para os serviços de entidade
 */
abstract class AbstractService
{
    /**
     * Repositório de entidade do serviço     *
     * @var AbstractRepository
     */
    protected $repository;

    /**
     * Retorna uma instância do repositório
     *
     * @param AbstractRepository $repository
     */
    public function __construct(AbstractRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna uma instância de Resource do Model base do serviço.
     *
     * @return Resoruce
     */
    public abstract function newResource();

    /**
     * Retorna uma instância de ResourceCollection do Model base do serviço.
     *
     * @return ResourceCollection
     */
    public abstract function newCollection();

    /**
     * Retorna uma lista com todos os registros.
     *
     * @return Model[]
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Recupera um registro específico.
     * $id: Identificador único do registro em questão.
     *
     * @param  int  $id
     * @return Model
     */
    public function findByID($id)
    {
        return $this->repository->findByID($id);        
    }

    /**
     * Cria e persiste um novo registro no banco de dados.
     * $data: Array com os dados a serem atualizados.
     *
     * @param  array  $data
     * @return Model
     */
    public function insert($data) {
        return $this->repository->insert($data);
    }

    /**
     * Atualiza um registro específico no banco de dados.
     * $data: Array com os dados a serem atualizados.
     * $id: Identificador único do registro em questão.
     * 
     * @param  array  $data
     * @param  int  $id
     * @return Model
     */
    public function update($id, $data) {
        if(!$this->repository->update($id, $data)) {
            throw new Exception('Ops! Tivemos um problema, tente novamente mais tarde');
        }
        return $this->repository->findByID($id);
    }

    /**
     * Exclui um registro específico do banco de dados.
     * $id: Identificador único do registro em questão.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {        
        if(!$this->repository->delete($id)) {
            throw new \Exception('Ops! Tivemos um problema, tente novamente mais tarde.');
        };
    }
}