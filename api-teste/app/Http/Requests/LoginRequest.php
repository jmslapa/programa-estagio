<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LoginRequest",
 *      description="Dados do corpo da LoginRequest",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="E-mail",
     *     description="E-mail do usuário",
     *     example="maria.silva@exemplo.com"
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="Senha de acesso do usuário",
     *     example="exemplo@123"
     * )
     *
     * @var string
     */
    private $password;

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
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:255'
        ];
    }
}
