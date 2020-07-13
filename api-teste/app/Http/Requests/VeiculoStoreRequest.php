<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="VeiculoStoreRequest",
 *      description="Dados do corpo da VeiculoStoreRequest",
 *      type="object",
 *      required={"name", "latitude", "longitude"}
 * )
 */
class VeiculoStoreRequest extends FormRequest
{

    /**
     * @OA\Property(
     *     title="Linha_ID",
     *     description="Identificador da linha a qual o veículo está vinculado",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $linha_id;

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
     *     title="Latitude",
     *     description="Latitude da posição geográfica da veiculo",
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
     *     description="Longitude da posição geográfica da veiculo",
     *     format="double(6,6)",
     *     example="-38.4612137"
     * )
     *
     * @var double
     */
    private $longitude;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(4);
        return [
            'linha_id' => 'nullable|integer',
            'name' => 'required',
            'modelo' => 'required',
            'latitude' => 'required|numeric|between:-90,90|regex:/^-?[0-9]{1,2}(.[0-9]{1,6})?$/',
            'longitude' => 'required|numeric|between:-180,180|regex:/^-?[0-9]{1,3}(.[0-9]{1,6})?$/'
        ];
    }
}
