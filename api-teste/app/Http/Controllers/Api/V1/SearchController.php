<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\ApiMessage;
use App\Http\Controllers\Controller;
use App\Services\Api\SearchService;


/**
 * @OA\Tag(
 *   name="Search",
 *   description="Conjunto de endpoints para pesquisas"
 * )
 */
class SearchController extends Controller
{
    /**
     * Dependência de SearchService
     *
     * @var SearchService
     */
    private $service;

    /**
     * Retorna uma instância de SearchController
     */
    public function __construct()
    {
        $this->service = new SearchService();
    }

    /**
     * Retorna uma lista com todas as linhas de uma parada.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/{parada_id}/linhas-por-parada",
     *      tags={"Search"},
     *      summary="Recupera linhas de uma parada",
     *      description="Retorna uma lista com todas as linhas de uma parada.",
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
    public function linhasPorParada($id)
    {
        try {
            
            $body = $this->service->linhasPorParada($id);
            return response()->json($body, 200);
            
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 500);
        }
    }

    /**
     * Retorna uma lista com todos os veículos de uma linha.
     *
     * @return \Illuminate\Http\Response
     * 
     *  @OA\Get(
     *      path="/{linha_id}/veiculos-por-linha",
     *      tags={"Search"},
     *      summary="Recupera veículos de uma linha",
     *      description="Retorna uma lista com todos os veículos de uma linha.",
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
    public function veiculosPorLinha($id)
    {
        try {
            
            $body = $this->service->veiculosPorLinha($id);
            return response()->json($body, 200);
            
        }catch(\Exception $e) {
            $message = new ApiMessage($e->getMessage());
            return response()->json($message->getMessage(), 500);
        }
    }
}
