<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="PosicaoVeiculoStoreRequest",
 *      description="Dados do corpo da PosicaoVeiculoStoreRequest",
 *      type="object",
 *      required={"veiculo_id", "latitude", "longitude"}
 * )
 */
class PosicaoVeiculoStoreRequest extends FormRequest
{
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
            'veiculo_id' => 'required|integer|exists:veiculos,id|unique:posicao_veiculos',
            'latitude' => 'required|numeric|between:-90,90|regex:/^-?[0-9]{1,2}(.[0-9]{1,6})?$/',
            'longitude' => 'required|numeric|between:-180,180|regex:/^-?[0-9]{1,3}(.[0-9]{1,6})?$/'
        ];
    }
}
