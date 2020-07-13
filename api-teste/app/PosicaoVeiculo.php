<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="PosicaoVeiculo",
 *     description="model PosicaoVeiculo",
 *     @OA\Xml(
 *         name="PosicaoVeiculo"
 *     )
 * )
 */
class PosicaoVeiculo extends Model
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
     *     title="Veiculo ID",
     *     description="Identificador único do veículo vinculado.",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $veiculo_id;

    /**
     * @OA\Property(
     *     title="Latitude",
     *     description="Latitude da posição geográfica do veículo vinculado.",
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
     *     description="Longitude da posição geográfica do veículo vinculado.",
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
        'veiculo_id', 'latitude', 'longitude',
    ];

    /**
     * Retorna o veículo apontado pela posição
     *
     * @return mixed
     */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
