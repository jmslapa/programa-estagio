<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinhaRequest;
use App\Linha;
use App\Repositories\LinhaRepository;
use App\Services\Api\LinhaService;

/**
 * @OA\Tag(
 *   name="Linhas",
 *   description="Conjunto de endpoints com operações de CRUD para Linhas"
 * )
 */

class LinhaController extends Controller
{   
    /**
     * Serviço da entidade Linha
     *
     * @var AbstractService
     */
    private $service;

    /**
     * Retorna uma instância de LinhaController
     */
    public function __construct()
    {
        $repository = new LinhaRepository(new Linha());
        $this->service = new LinhaService($repository);
    }

    /**
     * Retorna uma lista com todas as linhas cadastradas.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/linhas",
     *      tags={"Linhas"},
     *      summary="Recupera linhas",
     *      description="Recupera todas as linhas",
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/LinhaResource")
     *      ),      
     *      @OA\Response(
     *          response=401,
     *          ref="#/components/responses/401"
     *      ),      
     *      @OA\Response(
     *          response=500,
     *          ref="#/components/responses/500"
     *      )
     *  )
     */
    public function index()
    {
        try {
            
            $body = $this->service->getAll();
            return response()->json($body, 200);
            
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 500);
        }
    }

    /**
     * Cria e persiste uma nova linha no banco de dados.
     *
     * @param  App\Http\Requests\LinhaRequest  $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/linhas",
     *      tags={"Linhas"},
     *      summary="Persiste nova linha",
     *      description="Retorna dados da nova linha criada",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LinhaRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Linha")
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
     *          response=500,
     *          ref="#/components/responses/500"
     *      )
     * )
     */
    public function store(LinhaRequest $request)
    {
        try {

            $data = $request->all();
            $body = $this->service->insert($data);
            return response()->json($body, 201);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 400);
        } 
    }

    /**
     * Recupera uma linha específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/linhas/{id}",
     *      tags={"Linhas"},
     *      summary="Informação de linha",
     *      description="Retorna dados de uma linha",
     *      @OA\Parameter(
     *          name="id",
     *          description="Linha id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Linha")
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
     *          response=404,
     *          ref="#/components/responses/404"
     *      )
     * )
     */
    public function show($id)
    {
        try {

            $body = $this->service->findByID($id);
            return response()->json($body, 200);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Atualiza uma linha específica no banco de dados.
     *
     * @param  App\Http\Requests\LinhaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/linhas/{id}",
     *      tags={"Linhas"},
     *      summary="Atualiza linha existente",
     *      description="Retorna dados de uma linha atualizada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Linha id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LinhaRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Linha")
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
     *          response=404,
     *          ref="#/components/responses/404"
     *      ),      
     *      @OA\Response(
     *          response=422,
     *          ref="#/components/responses/422"
     *      )
     * )
     */
    public function update(LinhaRequest $request, $id)
    {   
        try {

            $data = $request->all();
            $body = $this->service->update($id, $data);
            return response()->json($body, 202);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Exclui uma linha específica do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/linhas/{id}",
     *      tags={"Linhas"},
     *      summary="Exclui linha existente",
     *      description="Exclui uma linha e não retorna nenhum conteúdo",
     *      @OA\Parameter(
     *          name="id",
     *          description="Linha id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Operação bem sucedida",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          ref="#/components/responses/401"
     *      ),      
     *      @OA\Response(
     *          response=404,
     *          ref="#/components/responses/404"
     *      )
     * )
     */
    public function destroy($id)
    {
        try {

            $this->service->delete($id);
            return response()->json(null, 204);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }
}
