<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="LinhaResource",
 *     description="Recurso linha",
 *     @OA\Xml(
 *         name="LinhaResource"
 *     )
 * )
 */
class LinhaResource extends JsonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Wrapper de dados"
     * )
     *
     * @var \App\Linha[]
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
            'name' => $this->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
