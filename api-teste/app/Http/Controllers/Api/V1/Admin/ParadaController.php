<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParadaRequest;
use App\Parada;
use App\Repositories\AbstractRepository;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *   name="Paradas",
 *   description="Conjunto de endpoints com operações de CRUD para Paradas"
 * )
 */

class ParadaController extends Controller
{   

    private $repository;

    /**
     * Retorna uma instância de ParadaController
     */
    public function __construct()
    {
        $this->repository = new AbstractRepository(new Parada());
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
            return response()->json($this->repository->getAll(), 200);            
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
            return response()->json($this->repository->insert($data), 201);            
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 400);
        } 
    }

    /**
     * Display the specified resource.
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
            return response()->json($this->repository->findByID($id), 200);        
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Update the specified resource in storage.
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
            if(!$this->repository->update($id, $data)) {
                throw new Exception('Ops! Tivemos um problema, tente novamente mais tarde');
            }
            return response()->json($this->repository->findByID($id), 202);
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
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
            if(!$this->repository->delete($id)){;
                throw new \Exception('Ops! Tivemos um problema, tente novamente mais tarde.');
            }
            return response()->json([], 204);    
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 404);
        }
    }
}
