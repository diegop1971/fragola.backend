<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateCartCheckoutCommand implements Command
{
    public function __construct(
        private string $customerId,
        private string $PaymentMethodId,
    ) {
    }

    public function CustomerId(): string
    {
        return $this->customerId;
    }

    public function PaymentMethodId(): string
    {
        return $this->PaymentMethodId;
    }
}
