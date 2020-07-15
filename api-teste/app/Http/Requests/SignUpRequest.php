<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="SignUpRequest",
 *      description="Dados do corpo da SignUpRequest",
 *      type="object",
 *      required={"name", "email", "password", "password_confirmation"}
 * )
 */
class SignUpRequest extends FormRequest
{

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Nome do usuário",
     *     example="Maria da Silva"
     * )
     *
     * @var string
     */
    private $name;

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
     * @OA\Property(
     *     title="Password Confirmation",
     *     description="Confirmação da senha de usuário",
     *     example="exemplo@123"
     * )
     *
     * @var string
     */
    private $password_confirmation;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
