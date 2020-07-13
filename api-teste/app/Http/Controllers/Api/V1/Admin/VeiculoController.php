<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\VeiculoStoreRequest;
use App\Http\Requests\VeiculoUpdateRequest;
use App\Veiculo;
use App\Repositories\VeiculoRepository;
use App\Services\Api\VeiculoService;

/**
 * @OA\Tag(
 *   name="Veiculos",
 *   description="Conjunto de endpoints com operações de CRUD para Veiculos"
 * )
 */

class VeiculoController extends Controller
{   
    /**
     * Serviço da entidade Veiculo
     *
     * @var AbstractService
     */
    private $service;

    /**
     * Retorna uma instância de VeiculoController
     */
    public function __construct()
    {
        $repository = new VeiculoRepository(new Veiculo());
        $this->service = new VeiculoService($repository);
    }

    /**
     * Retorna uma lista, em formato JSON, com todos os veículos cadastradas.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/veiculos",
     *      tags={"Veiculos"},
     *      summary="Recupera veículos",
     *      description="Recupera todos os veículos",
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/VeiculoResource")
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
     * @param  App\Http\Requests\VeiculoStoreRequest  $request
     * @return \Illuminate\Http\Response)
     * 
     *  @OA\Post(
     *      path="/veiculos",
     *      tags={"Veiculos"},
     *      summary="Persiste novo veiculo",
     *      description="Retorna dados do novo veículo criado",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VeiculoStoreRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Veiculo")
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
    public function store(VeiculoStoreRequest $request)
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
     *      path="/veiculos/{id}",
     *      tags={"Veiculos"},
     *      summary="Informação de veículo",
     *      description="Retorna dados de um veículo",
     *      @OA\Parameter(
     *          name="id",
     *          description="Veículo id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Veiculo")
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
     * @param  App\Http\Requests\VeiculoUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/veiculos/{id}",
     *      tags={"Veiculos"},
     *      summary="Atualiza veiculo existente",
     *      description="Retorna dados de um veículo atualizado",
     *      @OA\Parameter(
     *          name="id",
     *          description="Veiculo id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VeiculoUpdateRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Operação bem-sucedida",
     *          @OA\JsonContent(ref="#/components/schemas/Veiculo")
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
    public function update(VeiculoUpdateRequest $request, $id)
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
     * Exclui um veículo específic do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/veiculos/{id}",
     *      tags={"Veiculos"},
     *      summary="Exclui veículo existente",
     *      description="Exclui um veículo e não retorna nenhum conteúdo",
     *      @OA\Parameter(
     *          name="id",
     *          description="Veiculo id",
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
