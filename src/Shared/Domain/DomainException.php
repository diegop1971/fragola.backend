<?php

namespace src\Shared\Domain;

use Exception;
use Throwable;

class DomainException extends Exception
{
    protected int $errorCode;

    public function __construct(int $errorCode, string $message = "", Throwable $previous = null) {
        parent::__construct($message, 0, $previous);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode(): int {
        return $this->errorCode;
    }
}
