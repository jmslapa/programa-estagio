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
                foreach($data['paradas'] as $p) {
                    $parada = $this->parada->findOrFail($p);
                }
                $linha->paradas()->sync($data['paradas']);
            }
            return $linha;
        });
        return $result;
    }
}