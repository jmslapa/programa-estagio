<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="SearchParadasProximasRequest",
 *      description="Dados do corpo da SearchParadasProximasRequest",
 *      type="object",
 *      required={"latitude", "longitude"}
 * )
 */
class SearchParadasProximasRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="Latitude",
     *     description="Latitude da posição geográfica do veículo vinculado.",
     *     format="double(6,6)",
     *     example="-12.998250"
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
     *     example="-38.461113"
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
        return [            
            'latitude' => 'required|numeric|between:-90,90|regex:/^-?[0-9]{1,2}(.[0-9]{1,6})?$/',
            'longitude' => 'required|numeric|between:-180,180|regex:/^-?[0-9]{1,3}(.[0-9]{1,6})?$/'
        ];
    }
}
