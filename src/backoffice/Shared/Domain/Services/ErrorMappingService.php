<?php

namespace src\backoffice\Shared\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;
use src\Shared\Domain\ErrorCode;

class ErrorMappingService implements IErrorMappingService
{
    public function mapToHttpCode(int $errorCode, ?string $message = null): array
    {
        Log::info($message);

        switch ($errorCode) {
            case 422:
                return [
                    'http_code' => 422,
                    'message' => $message ?? 'Validation error.'
                ];
            case ErrorCode::PRODUCT_NOT_EXIST:
                return [
                    'http_code' => 404,
                    'message' => $message ?? 'Product not found.'
                ]; 
            case 1049:
                return [
                    'http_code' => 500,
                    'message' => 'Database error: Unable to connect to the database.'
                ];
            default:
                return [
                    'http_code' => 500,
                    'message' => 'An unexpected error occurred.'
                ];
        }
    }
}
