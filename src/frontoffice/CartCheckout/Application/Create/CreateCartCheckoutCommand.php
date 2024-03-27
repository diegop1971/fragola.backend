<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\Command;

final class CreateCartCheckoutCommand implements Command
{
    public function __construct(
        private string $customerId,
        private string $customerEmail,
        private string $firstName,
        private string $lastName,
        private string $paymentMethodId,
        private int $itemsQuantity,
        private float $totalPaid,
        private array $orderDetail,
    ) {
    }

    public function customerId(): string
    {
        return $this->customerId;
    }

    public function customerEmail(): string
    {
        return $this->customerEmail;
    }

    public function customerFirstName(): string
    {
        return $this->firstName;
    }

    public function customerLastName(): string
    {
        return $this->lastName;
    }

    public function paymentMethodId(): string
    {
        return $this->paymentMethodId;
    }

    public function itemsQuantity(): int
    {
        return intval($this->itemsQuantity);
    }

    public function totalPaid(): float
    {
        return floatval($this->totalPaid);
    }

    public function orderDetail(): array
    {
        return $this->orderDetail;
    }
}
