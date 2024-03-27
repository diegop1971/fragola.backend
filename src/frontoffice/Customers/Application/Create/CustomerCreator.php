<?php

declare(strict_types=1);

namespace src\frontoffice\Customers\Application\Create;

use Throwable;
use Illuminate\Support\Facades\Log;
use src\frontoffice\Orders\Domain\Customer;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerPassword;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerRememberToken;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmailVerifiedAt;
use src\frontoffice\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;

final class CustomerCreator
{
    private $customerRepository;
    private $customerId;

    public function __construct(EloquentCustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke(
        CustomerId $customerId,
        CustomerFirstName $customerFirstName,
        CustomerLastName $customerLastName,
        CustomerEmail $customerEmail,
        CustomerEmailVerifiedAt $customerEmailVerifiedAt,
        CustomerPassword $customerPassword,
        CustomerRememberToken $customerRememberToken,
    ) {
        try {
            $this->customerId = $customerId;

            $customer = Customer::create(
                $customerId,
                $customerFirstName,
                $customerLastName,
                $customerEmail,
                $customerEmailVerifiedAt,
                $customerPassword,
                $customerRememberToken,
            );

            $this->customerRepository->save($customer);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
