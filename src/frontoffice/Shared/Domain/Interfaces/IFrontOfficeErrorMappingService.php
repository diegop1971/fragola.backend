<?php

namespace src\frontoffice\Shared\Domain\Interfaces;

interface IFrontOfficeErrorMappingService 
{
    public function mapToHttpCode(int $errorCode): array;
}