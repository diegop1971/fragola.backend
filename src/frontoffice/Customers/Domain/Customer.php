<?php

declare(strict_types=1);

namespace src\frontoffice\Customers\Domain;

use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerPassword;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerRememberToken;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmailVerifiedAt;

final class Customer
{
    public function __construct(
        private CustomerId $customerId,
        private CustomerFirstName $customerFirstName,
        private CustomerLastName $customerLastName,
        private CustomerEmail $customerEmail,
        private CustomerEmailVerifiedAt $customerEmailVerifiedAt,
        private CustomerPassword $customerPassword,
        private CustomerRememberToken $customerRememberToken,
    ) {
    }

    public static function create(
        CustomerId $customerId,
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        CustomerEmail $customerEmail,
        CustomerEmailVerifiedAt $customerEmailVerifiedAt,
        CustomerPassword $customerPassword,
        CustomerRememberToken $customerRememberToken,
    ): self {
        $order = new self(
            $customerId,
            $customerFirstName,
            $customerLastName,
            $customerEmail,
            $customerEmailVerifiedAt,
            $customerPassword,
            $customerRememberToken,
        );

        return $order;
    }

    public static function update(
        CustomerId $customerId,
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        CustomerEmail $customerEmail,
        CustomerEmailVerifiedAt $customerEmailVerifiedAt,
        CustomerPassword $customerPassword,
        CustomerRememberToken $customerRememberToken
    ): self {
        $order = new self(
            $customerId,
            $customerFirstName,
            $customerLastName,
            $customerEmail,
            $customerEmailVerifiedAt,
            $customerPassword,
            $customerRememberToken,
        );

        return $order;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function customerFirstName(): CustomerFirstName
    {
        return $this->customerFirstName;
    }

    public function customerLastName(): CustomerLastName
    {
        return $this->customerLastName;
    }

    public function customerEmail(): CustomerEmail
    {
        return $this->customerEmail;
    }

    public function customerEmailVerifiedAt(): CustomerEmailVerifiedAt
    {
        return $this->customerEmailVerifiedAt;
    }

    public function customerPassword(): CustomerPassword
    {
        return $this->customerPassword;
    }

    public function customerRememberToken(): CustomerRememberToken
    {
        return $this->customerRememberToken;
    }
}
