<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    public function __construct(
        string $message,
        public string $errorCode,
        public int $statusCode = 422,
        public ?array $errors = null
    ) {
        parent::__construct($message, $statusCode);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'code' => $this->errorCode,
            'errors' => $this->errors,
        ], $this->statusCode);
    }
}

