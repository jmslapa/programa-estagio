<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LinhaRemoveParadaRequest",
 *      description="Dados do corpo da LinhaRemoveParadaRequest",
 *      type="object",
 *      required={"paradas"}
 * )
 */
class LinhaRemoveParadaRequest extends FormRequest
{

    /**
     * @OA\Property(
     *     title="paradas",
     *     description="Array com IDs de paradas a serem vinculadas à linha",
     *     type="array",
     *     @OA\Items(
     *         title="array",
     *         example=1
     *     )
     * )
     *
     * @var array
     */
    private $paradas;

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
            'paradas' => 'required',
            'paradas.*' => 'numeric'
        ];
    }
}
