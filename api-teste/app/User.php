<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     title="User",
 *     description="model User",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obter o identificador que será armazenado na requisição do JWT    
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retorna um array associativo contendo qualquer conteúdo personalizado a ser adicionado ao JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
