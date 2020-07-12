<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParadaRequest;
use App\Http\Resources\ParadaCollection;
use App\Http\Resources\ParadaResource;
use App\Parada;
use App\Repositories\AbstractRepository;
use App\Services\Api\AbstractService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *   name="Paradas",
 *   description="Conjunto de endpoints com operações de CRUD para Paradas"
 * )
 */

class ParadaController extends Controller
{   
    /**
     * Serviço da entidade Parada
     *
     * @var AbstractService
     */
    private $service;

    /**
     * Retorna uma instância de ParadaController
     */
    public function __construct()
    {
        $repository = new AbstractRepository(new Parada());
        $this->service = new AbstractService($repository);
    }

    /**
     * Retorna uma lista, em formato JSON, com todas as paradas cadastradas.
     *
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *   path="/paradas",
     *   tags={"Paradas"},
     *   summary="Lista de paradas",
     *   description="Retorna uma lista, em formato JSON, com todas as paradas cadastradas",
     *   @OA\Response(
     *     response=200,
     *     description="Operação bem-sucedida",
     *     @OA\JsonContent(ref="#/components/schemas/ParadaResource")
     *     )
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Não autorizado"
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Erro interno do servidor"
     *   )
     * )  
     */
    public function index()
    {
        try {
            
            $body = new ParadaCollection($this->service->getAll());
            return response()->json($body, 200);
            
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 500);
        }
    }

    /**
     * Cria e persiste uma nova parada no banco de dados.
     *
     * @param  App\Http\Requests\ParadaRequest  $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/paradas",
     *      tags={"Paradas"},
     *      summary="Persiste nova parada",
     *      description="Retorna, em formato JSON, dados da nova parada criada",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ParadaRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Parada")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Entidade não processável",
     *      )
     * )
     */
    public function store(ParadaRequest $request)
    {
        try {

            $data = $request->all();
            $body = new ParadaResource($this->service->insert($data));
            return response()->json($body, 201);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 400);
        } 
    }

    /**
     * Recupera uma parada específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/paradas/{id}",
     *      tags={"Paradas"},
     *      summary="Informação de parada",
     *      description="Retorna dados de uma parada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Parada id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Parada")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não Autorizado",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Recurso não encontrado"
     *      )
     * )
     */
    public function show($id)
    {
        try {

            $body = new ParadaResource($this->service->findByID($id));
            return response()->json($body, 200);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Atualiza uma parada específica no banco de dados.
     *
     * @param  App\Http\Requests\ParadaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/paradas/{id}",
     *      tags={"Paradas"},
     *      summary="Atualiza parada existente",
     *      description="Retorna dados de uma parada atualizada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Parada id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ParadaRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Parada")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Recurso não encontrado"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Entidade não processável",
     *      )
     * )
     */
    public function update(ParadaRequest $request, $id)
    {   
        try {

            $data = $request->all();
            $body = new ParadaResource($this->service->update($id, $data));
            return response()->json($body, 202);

        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Exclui uma parada específica do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/paradas/{id}",
     *      tags={"Paradas"},
     *      summary="Exclui parada existente",
     *      description="Exclui uma parada e não retorna nenhum conteúdo",
     *      @OA\Parameter(
     *          name="id",
     *          description="Parada id",
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
     *          description="Não autorizado",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Recurso não encontrado"
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
