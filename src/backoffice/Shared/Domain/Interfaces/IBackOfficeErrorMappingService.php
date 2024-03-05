<?php

namespace src\backoffice\Shared\Domain\Interfaces;

interface IBackOfficeErrorMappingService 
{
    public function mapToHttpCode(int $errorCode): array;
}