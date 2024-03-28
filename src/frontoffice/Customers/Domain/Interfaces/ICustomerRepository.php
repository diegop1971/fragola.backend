<?php

namespace src\frontoffice\Customers\Domain\Interfaces;

use src\frontoffice\Customers\Domain\Customer;

interface ICustomerRepository
{
    public function search($id): ?array;

    public function searchByEmail($customerEmail): ?array;

    public function save(Customer $customer): void;
}
