<?php

declare(strict_types=1);

namespace src\frontoffice\Customers\Infrastructure\Persistence\Eloquent;

use src\frontoffice\Customers\Domain\Customer;
use src\frontoffice\Customers\Domain\Interfaces\ICustomerRepository;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\CustomerEloquentModel;

class EloquentCustomerRepository implements ICustomerRepository
{
    public function search($id): ?array
    {
        $model = CustomerEloquentModel::select('id', 'first_name', 'last_name', 'email')
            ->where('id', '=', $id)
            ->first();

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }

    public function searchByEmail($customerEmail): ?array
    {
        $model = CustomerEloquentModel::select('id', 'first_name', 'last_name', 'email')
            ->where('email', '=', $customerEmail)
            ->first();

        if (null === $model) {
            return null;
        }

        return $model->toArray();
    }

    public function save(Customer $customer): void
    {
        $model = new CustomerEloquentModel();

        $model->id = $customer->customerId()->value();
        $model->first_name = $customer->customerFirstName()->value();
        $model->last_name = $customer->customerLastName()->value();
        $model->email = $customer->customerEmail()->value();
        $model->email_verified_at = $customer->customerEmailVerifiedAt()->value();
        $model->password = $customer->customerPassword()->value();
        $model->remember_token = $customer->customerRememberToken()->value();

        $model->save();
    }
}
