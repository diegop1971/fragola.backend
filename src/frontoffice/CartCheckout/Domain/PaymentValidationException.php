<?php 

namespace src\frontoffice\CartCheckout\Domain;

use src\Shared\Domain\DomainError;

final class PaymentValidationException extends DomainError
{
    public function errorCode(): string
    {
        return 'payment_processing_error';
    }

    public function errorMessage(): string
    {
        return 'Error during payment processing';
    }
}