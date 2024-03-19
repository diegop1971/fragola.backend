<?php

declare(strict_types=1);

namespace src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\Log;
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

    public function searchWithInitialOrderStatusName($id): ?array
    {
        $paymentMethod = PaymentMethodEloquentModel::where('payment_methods.id', $id)
            ->leftJoin('order_status', 'payment_methods.initial_order_status_id', '=', 'order_status.id')
            ->select('payment_methods.*', 'order_status.name as initial_order_status_name')
            ->first();

        if (null === $paymentMethod) {
            return null;
        }

        return $paymentMethod->toArray();
    }
}
