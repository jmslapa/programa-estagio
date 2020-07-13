<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LinhaStoreRequest",
 *      description="Dados do corpo da LinhaStoreRequest",
 *      type="object",
 *      required={"name"}
 * )
 */
class LinhaStoreRequest extends FormRequest
{
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
            'name' => "required|unique:linhas",
            'paradas' => 'nullable|array',
            'paradas.*' => 'integer'
        ];
    }
}
