<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LinhaRequest",
 *      description="Dados do corpo da LinhaRequest",
 *      type="object",
 *      required={"name"}
 * )
 */
class LinhaRequest extends FormRequest
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
            'name' => "required|unique:linhas,name,{$id},id",
        ];
    }
}
