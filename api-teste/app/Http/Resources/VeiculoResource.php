<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="VeiculoResource",
 *     description="Recurso veiculo",
 *     @OA\Xml(
 *         name="VeiculoResource"
 *     )
 * )
 */
class VeiculoResource extends JsonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Wrapper de dados"
     * )
     *
     * @var \App\Veiculo[]
     */
    protected $data;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'linha_id' => $this->linha_id,
            'name' => $this->name,
            'modelo' => $this->modelo,
            'posicao' => $this->whenLoaded('posicao'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
