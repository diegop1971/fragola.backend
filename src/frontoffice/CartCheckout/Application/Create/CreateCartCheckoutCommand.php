<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateCartCheckoutCommand implements Command
{
    public function __construct(
        private string $PaymentMethodName,
    ) {
        
    }

    public function PaymentMethodName(): string
    {
        return $this->PaymentMethodName;
    }
}
