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
