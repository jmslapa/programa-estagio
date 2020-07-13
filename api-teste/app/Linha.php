<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Linha",
 *     description="model Linha",
 *     @OA\Xml(
 *         name="Linha"
 *     )
 * )
 */
class Linha extends Model
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
     *     description="Nome de uma linha",
     *     example="Circular II"
     * )
     *
     * @var string
     */
    private $name;

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
        'name',
    ];

    /**
     * Retorna as paradas atendidas pela linha
     *
     * @return mixed
     */
    public function paradas()
    {
        return $this->belongsToMany(Parada::class);
    }

    /**
     * Retorna os veículos que integram a linha
     *
     * @return mixed
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
