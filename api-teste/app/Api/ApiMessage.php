<?php 

namespace App\Api;
/**
 * @OA\Schema(
 *     title="ApiMessage",
 *     description="model ApiMessage",
 *     @OA\Xml(
 *         name="ApiMessage"
 *     )
 * )
 */
class ApiMessage {
    
    /**
     * @OA\Property(
     *     title="data",
     *     description="Um array que contém informaçõe do sistema para o usuário",
     *     type="array",
     *     example={"message": "Mensagem de erro", "errors": "[...]"},
     *     @OA\Items()
     * )
     * 
     * @var array
     */
    private $data = [];

    public function __construct(string $message, array $errors = [])
    {
        $this->data['message'] = $message;
        $this->data['errors'] = $errors;
    }

    public function getMessage()
    {
        return $this->data;
    }
}