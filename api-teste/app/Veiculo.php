<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Veiculo",
 *     description="model Veiculo",
 *     @OA\Xml(
 *         name="Veiculo"
 *     )
 * )
 */
class Veiculo extends Model
{   

    /**
     * @OA\Property(
     *     title="ID",
     *     description="Identificador único",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Nome do veículo",
     *     example="Ônibus 48 lugares"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Modelo",
     *     description="Modelo de um veículo",
     *     example="Marcopolo Ideale 770"
     * )
     *
     * @var string
     */
    private $modelo;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Data de criação do registro no banco de dados em formato UTC",
     *     example="2020-07-11 16:30:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;    

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Data da última atualização do registro no banco de dados em formato UTC",
     *     example="2020-07-11 16:30:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * Atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'modelo', 'linha',
    ];

    /**
     * Retorna a linha a qual o veículo integra
     *
     * @return mixed
     */
    public function linha()
    {
        return $this->belongsTo(Linha::class);
    }

    /**
     * Retorna a posição geográfica do veículo
     *
     * @return mixed
     */
    public function posicao()
    {
        return $this->hasOne(PosicaoVeiculo::class);
    }
}
