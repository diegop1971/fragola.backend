<?php

namespace src\backoffice\Shared\Domain\Interfaces;

interface IErrorMappingService 
{
    public function mapToHttpCode(int $errorCode): int;
}