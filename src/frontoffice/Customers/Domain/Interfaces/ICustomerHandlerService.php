<?php

namespace src\frontoffice\Customers\Domain\Interfaces;

use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;

interface ICustomerHandlerService
{
    public function handler($customerFirstName, $customerLastName, $customerEmail, $customerEmailVerifiedAt, $customerRememberToken): CustomerId;
}
