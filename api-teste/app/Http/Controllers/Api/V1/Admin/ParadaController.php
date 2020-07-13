<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParadaRequest;
use App\Parada;
use App\Repositories\ParadaRepository;
use App\Services\Api\ParadaService;

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
        $repository = new ParadaRepository(new Parada());
        $this->service = new ParadaService($repository);
    }

    /**
     * Retorna uma lista, em formato JSON, com todas as paradas cadastradas.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/paradas",
     *      tags={"Paradas"},
     *      summary="Recupera paradas",
     *      description="Recupera todas as paradas",
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/ParadaResource")
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
     * Cria e persiste uma nova parada no banco de dados.
     *
     * @param  App\Http\Requests\ParadaRequest  $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/paradas",
     *      tags={"Paradas"},
     *      summary="Persiste nova parada",
     *      description="Retorna dados da nova parada criada",
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
    public function store(ParadaRequest $request)
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
     *      ),
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
    public function update(ParadaRequest $request, $id)
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
