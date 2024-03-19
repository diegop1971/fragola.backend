<?php

declare(strict_types=1);

namespace src\frontoffice\PaymentMethods\Application\Find;

use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;

final class PaymentMethodsGet
{
    private $repository;

    public function __construct(IPaymentMethodsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $paymentMethods = $this->repository->searchAll();

        return $paymentMethods;
    }
}
