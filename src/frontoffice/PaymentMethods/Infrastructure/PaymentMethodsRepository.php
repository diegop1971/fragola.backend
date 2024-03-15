<?php

declare(strict_types=1);

namespace src\frontoffice\PaymentMethods\Infrastructure;

use src\frontoffice\PaymentMethods\Infrastructure\PaymentMethodEloquentModel;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;

class PaymentMethodsRepository implements IPaymentMethodsRepository
{
    public function searchAll(): ?array
    {
        $paymentMethods = PaymentMethodEloquentModel::where('enabled', true)->get();

        if ($paymentMethods->isEmpty()) {
            return [];
        }

        return $paymentMethods->toArray();
    }
}
