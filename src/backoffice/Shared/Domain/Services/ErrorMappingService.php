<?php

namespace src\backoffice\Shared\Domain\Services;

use src\backoffice\Shared\Domain\Interfaces\IErrorMappingService;

class ErrorMappingService implements IErrorMappingService
{
    public function mapToHttpCode(int $errorCode): int
    {
        switch ($errorCode) {
            case 1049:
                return 500;
            default:
                return 500;
        }
    }
}
