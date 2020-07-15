<?php

namespace App;

/**
 * @OA\Schema(
 *     title="TokenData",
 *     description="model TokenData",
 *     @OA\Xml(
 *         name="TokenData"
 *     )
 * )
 */
abstract class TokenData
{   

    /**
     * @OA\Property(
     *     title="Token",
     *     description="Token de autorização",
     *     example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuYWlrby50ZXN0XC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNTk0Nzg1Nzk5LCJleHAiOjE1OTQ3ODkzOTksIm5iZiI6MTU5NDc4NTc5OSwianRpIjoienlLdXhBMGdGeWJDanFhUSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.NDZ2DtrEUJWr6I2WGz0IFv8BwEWfU2DpMEHHtC1udLI"
     * )
     *
     * @var string
     */
    private $token;

    /**
     * @OA\Property(
     *     title="Token type",
     *     description="Tipo do token",
     *     example="Bearer"
     * )
     *
     * @var string
     */
    private $token_type;

    /**
     * @OA\Property(
     *     title="Expiração",
     *     description="Tempo de validade do token em segundos",
     *     example="3600"
     * )
     *
     * @var int
     */
    private $expiracao;
}
