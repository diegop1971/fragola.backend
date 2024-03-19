<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerId;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodId;
use src\frontoffice\CartCheckout\Application\Create\CheckoutCartCreator;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Application\Create\CreateCartCheckoutCommand;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;

final class CreateCartCheckoutCommandHandler implements CommandHandler
{
    private $orderStatusRepository;
    private $paymentMethodsRepository;

    public function __construct(private CheckoutCartCreator $creator, IPaymentMethodsRepository $paymentMethodsRepository, IOrderStatusRepository $orderStatusRepository)
    {
        $this->creator = $creator;
        $this->paymentMethodsRepository = $paymentMethodsRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function __invoke(CreateCartCheckoutCommand $command)
    {
        $orderId = OrderId::random();

        $customerId = new CustomerId($command->CustomerId());
        $paymentMethodId = new PaymentMethodId($command->paymentMethodId());

        $this->creator->__invoke(
            $orderId,
            $customerId,
            $paymentMethodId,
            $this->orderStatusRepository,
            $this->paymentMethodsRepository,
        );
    }
}
