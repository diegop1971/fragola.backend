<?php

declare(strict_types = 1);

namespace src\backoffice\Products\Domain;

use src\Shared\Domain\DomainError;

class ProductCustomValidationException extends DomainError
{
    protected $errors;

    public function __construct($errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    public function errorCode(): string
    {
        return 'validation_error';
    }

    protected function errorMessage(): string
    {
        return "Error de validación en el dominio.";
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
