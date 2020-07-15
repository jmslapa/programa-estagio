<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\User;
use \Illuminate\Http\Response;

/**
 * @OA\Tag(
 *   name="Auth",
 *   description="Conjunto de endpoints com operações de autenticação"
 * )
 */
class AuthController extends Controller
{
    /**
     * Instância da entidade User
     *
     * @var User
     */
    private $user;

    /**
     * Retorna uma instância de AuthController
     */
    public function __construct()
    {
        $this->user = new User();
        $this->middleware('auth:api', [
            'except' => ['login', 'signUp']
        ]);
    }

    /**
     * Cria um novo registro de usuário.
     *
     * @param  App\Http\Requests\SignUpRequest $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/auth/sign-up",
     *      tags={"Auth"},
     *      summary="Registra usuário",
     *      description="Cria um novo registro de usuário.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SignUpRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          ref="#/components/responses/400"
     *      ),      
     *      @OA\Response(
     *          response=422,
     *          ref="#/components/responses/422"
     *      )
     * )
     */
    public function signUp(SignUpRequest $request)
    {
        return $this->user->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
    }

    /**
     * Efetua autenticação do usuário e retorna token, token type e expiração.
     *
     * @param App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Post(
     *      path="/auth/login",
     *      tags={"Auth"},
     *      summary="Efetua login",
     *      description="Efetua autenticação do usuário e retorna token, token type e expiração.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/TokenData")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          ref="#/components/responses/400"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          ref="#/components/responses/401"
     *      ),      
     *      @OA\Response(
     *          response=422,
     *          ref="#/components/responses/422"
     *      )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {

            $credentials = $request->only('email', 'password');
            
            $token = auth()->attempt($credentials);
    
            if(!$token) {
                throw new \Exception('Unauthorized');
            }
    
            return $this->responseToken($token);
            
        }catch(\Exception $e) {       

            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Retorna o usuário autenticado
     *
     * @return \Illuminate\Http\Response
     */
    public function autenticado()
    {
        return response()->json(auth()->user(), 200);
    }

    /**
     * Efetua logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {

            auth()->logout();    
            return response()->json(['message' => 'Logout bem-sucedido.'], 200);
            
        }catch(\Exception $e) {       

            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Retorna novo token, token type e expiração.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        return $this->responseToken(auth()->refresh(), 200);
    }

    /**
     * Retorna um array com token, token type e expiração do token
     *
     * @param mixed
     * @return \Illuminate\Http\Response
     */
    private function responseToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expiracao' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}
