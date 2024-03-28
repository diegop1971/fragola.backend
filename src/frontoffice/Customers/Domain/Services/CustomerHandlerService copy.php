<?php

namespace src\frontoffice\Customers\Domain\Services;

use src\frontoffice\Customers\Domain\Customer;
use src\Shared\Domain\ValueObject\PasswordValueObject;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerPassword;
use src\frontoffice\Customers\Domain\Interfaces\ICustomerRepository;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Customers\Domain\Interfaces\ICustomerHandlerService;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerRememberToken;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmailVerifiedAt;

class CustomerHandlerService implements ICustomerHandlerService
{
    private ICustomerRepository $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    
    public function save(
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        CustomerEmail $customerEmail,
        CustomerEmailVerifiedAt $customerEmailVerifiedAt,
        CustomerRememberToken $customerRememberToken,
    ): string {
        $customerId = CustomerId::random();
        
        $customerPassword = new CustomerPassword(PasswordValueObject::random()->value());

        $customer = Customer::create(
            $customerId,
            $customerFirstName,
            $customerLastName,
            $customerEmail,
            $customerEmailVerifiedAt,
            $customerPassword,
            $customerRememberToken
        );

        $this->customerRepository->save($customer);

        return $customerId;
    }
}
