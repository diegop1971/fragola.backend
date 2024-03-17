<?php

declare(strict_types=1);

namespace src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent;

use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

class EloquentPaymentMethodsRepository implements IPaymentMethodsRepository
{
    public function searchAll(): ?array
    {
        $paymentMethods = PaymentMethodEloquentModel::where('enabled', true)->get();

        if ($paymentMethods->isEmpty()) {
            return [];
        }

        return $paymentMethods->toArray();
    }

    public function search($id): ?array
    {
        $paymentMethod = PaymentMethodEloquentModel::where('id', '=', $id)->first();

        if (null === $paymentMethod) {
            return null;
        }

        return $paymentMethod->toArray();
    }
}
