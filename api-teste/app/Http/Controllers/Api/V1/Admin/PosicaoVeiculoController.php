<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\PosicaoVeiculoStoreRequest;
use App\Http\Requests\PosicaoVeiculoUpdateRequest;
use App\PosicaoVeiculo;
use App\Repositories\PosicaoVeiculoRepository;
use App\Services\Api\PosicaoVeiculoService;

/**
 * @OA\Tag(
 *   name="PosicaoVeiculos",
 *   description="Conjunto de endpoints com operações de CRUD para PosicaoVeiculos"
 * )
 */

class PosicaoVeiculoController extends Controller
{   
    /**
     * Serviço da entidade PosicaoVeiculo
     *
     * @var AbstractService
     */
    private $service;

    /**
     * Retorna uma instância de PosicaoVeiculoController
     */
    public function __construct()
    {
        $repository = new PosicaoVeiculoRepository(new PosicaoVeiculo());
        $this->service = new PosicaoVeiculoService($repository);
    }

    /**
     * Retorna uma lista, em formato JSON, com todos os veículos cadastradas.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/posicao-veiculos",
     *      tags={"PosicaoVeiculos"},
     *      summary="Recupera Posições de veículos",
     *      description="Recupera todas as Posições de veículos",
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculoResource")
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
     * Cria e persiste um novo veículo no banco de dados.
     *
     * @param  App\Http\Requests\PosicaoVeiculoStoreRequest  $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/posicao-veiculos",
     *      tags={"PosicaoVeiculos"},
     *      summary="Persiste nova PosicaoVeiculo",
     *      description="Retorna dados da nova PosicaoVeiculo criada",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculoStoreRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculo")
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
    public function store(PosicaoVeiculoStoreRequest $request)
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
     * Recupera um veículo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/posicao-veiculos/{id}",
     *      tags={"PosicaoVeiculos"},
     *      summary="Informação de PosicaoVeiculo",
     *      description="Retorna dados de uma posição geográfica de um veículo",
     *      @OA\Parameter(
     *          name="id",
     *          description="PosicaoVeiculo id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculo")
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
     * Atualiza um veículo específico no banco de dados.
     *
     * @param  App\Http\Requests\PosicaoVeiculoUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/posicao-veiculos/{id}",
     *      tags={"PosicaoVeiculos"},
     *      summary="Atualiza PosicaoVeiculo existente",
     *      description="Retorna dados de uma PosicaoVeiculo atualizada",
     *      @OA\Parameter(
     *          name="id",
     *          description="PosicaoVeiculo id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculoUpdateRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/PosicaoVeiculo")
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
    public function update(PosicaoVeiculoUpdateRequest $request, $id)
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
     * Exclui uma PosicaoVeiculo específica do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/posicao-veiculos/{id}",
     *      tags={"PosicaoVeiculos"},
     *      summary="Exclui PosicaoVeiculo existente",
     *      description="Exclui uma PosicaoVeiculo e não retorna nenhum conteúdo",
     *      @OA\Parameter(
     *          name="id",
     *          description="PosicaoVeiculo id",
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
