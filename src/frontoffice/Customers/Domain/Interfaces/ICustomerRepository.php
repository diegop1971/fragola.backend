<?php

namespace src\frontoffice\Customers\Domain\Interfaces;

interface ICustomerRepository
{
    public function search($id): ?array;
}
