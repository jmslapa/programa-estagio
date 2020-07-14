<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="PosicaoVeiculoResource",
 *     description="Recurso PosicaoVeiculo",
 *     @OA\Xml(
 *         name="PosicaoVeiculoResource"
 *     )
 * )
 */
class PosicaoVeiculoResource extends JsonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Wrapper de dados"
     * )
     *
     * @var \App\PosicaoVeiculo[]
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
            'veiculo_id' => $this->veiculo_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'veiculo' => $this->whenLoaded('veiculo'),
        ];
    }
}
