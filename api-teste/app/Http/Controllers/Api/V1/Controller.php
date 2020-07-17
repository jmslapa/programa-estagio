<?php

/**
 * @OA\Info(
 *   title="Api Teste",
 *   description="Api teste para o programa de estágio Aiko.
 *     Todas as requisições devem ter o cabeçalho 'Accept' setado para receber o MIME 'application/json'.
 *     Os endpoints PUT, devem ser enviados como POST, porém devem possuir um atributo '_method' com valor 'PUT' no request body.
 *     As representações de data estão no formato UTC (+0:00).",
 *   version="1.0.0",
 *   @OA\Contact(
 *     name="João Lapa",
 *     email="joaomanoel1996@hotmail.com"
 *   )  
 * )
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="Servidor padrão da api"
 * )
 * 
 * @OA\Tag(
 *   name="Disabled",
 *   description="Endpoints que estão desabilitados."
 * )
 * 
 * @OA\Response(
 *     response=400,
 *     description="Bad Request",
 *     @OA\JsonContent(ref="#/components/schemas/ApiMessage")
 * )
 * @OA\Response(
 *     response=401,
 *     description="Unauthorized",
 *     @OA\JsonContent(ref="#/components/schemas/ApiMessage")
 * )
 * @OA\Response(
 *     response=404,
 *     description="Not Found",
 *     @OA\JsonContent(ref="#/components/schemas/ApiMessage")
 * )
 * @OA\Response(
 *     response=422,
 *     description="Unprocessable Entity",
 *     @OA\JsonContent(ref="#/components/schemas/ApiMessage")
 * )
 * @OA\Response(
 *     response=500,
 *     description="Internal Server Error",
 *     @OA\JsonContent(ref="#/components/schemas/ApiMessage")
 * )
 */
class Controller
{
    //
}