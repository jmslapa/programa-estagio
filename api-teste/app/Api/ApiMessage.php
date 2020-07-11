<?php 

namespace App\Api;

class ApiMessage {
    
    private $message = [];

    public function __construct(string $message, array $errors = [])
    {
        $this->message['message'] = $message;
        $this->message['errors'] = $errors;
    }

    public function getMessage()
    {
        return $this->message;
    }
}