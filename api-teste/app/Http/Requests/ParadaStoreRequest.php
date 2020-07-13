<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="ParadaStoreRequest",
 *      description="Dados do corpo da ParadaStoreRequest",
 *      type="object",
 *      required={"name", "latitude", "longitude"}
 * )
 */
class ParadaStoreRequest extends FormRequest
{

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Nome de uma parada",
     *     example="Final de linha da Pituba"
     * )
     *
     * @var string
     */
    public $name;

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
    public $latitude;
    
    /**
     * @OA\Property(
     *     title="Longitude",
     *     description="Longitude da posição geográfica da parada",
     *     format="double(6,6)",
     *     example="-38.4612137"
     * )
     *
     * @var double
     */
    public $longitude;

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
            'name' => "required|unique:paradas",
            'latitude' => 'required|numeric|between:-90,90|regex:/^-?[0-9]{1,2}(.[0-9]{1,6})?$/',
            'longitude' => 'required|numeric|between:-180,180|regex:/^-?[0-9]{1,3}(.[0-9]{1,6})?$/'
        ];
    }
}
