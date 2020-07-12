<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Parada",
 *     description="model Parada",
 *     @OA\Xml(
 *         name="Project"
 *     )
 * )
 */
class Parada extends Model
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
     *     description="Nome de uma parada",
     *     example="Final de linha da Pituba"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Latitude",
     *     description="Latitude da posição geográfica da parada",
     *     format="double(6,6)",
     *     example="-12.994757"
     * )
     *
     * @var double
     */
    private $latitude;
    
    /**
     * @OA\Property(
     *     title="Longitude",
     *     description="Longitude da posição geográfica da parada",
     *     format="double(6,6)",
     *     example="-38.461213"
     * )
     *
     * @var double
     */
    private $longitude;

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
        'name', 'latitude', 'longitude',
    ];

    /**
     * Retorna as linhas que atendem a parada
     *
     * @return mixed
     */
    public function linhas()
    {
        return $this->belongsToMany(Linha::class);
    }
}
