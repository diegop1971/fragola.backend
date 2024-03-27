<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\Orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerEmail;
use src\frontoffice\CartCheckout\Domain\ValueObjects\OrderDetail;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerLastName;
use src\frontoffice\Customers\Domain\ValueObjects\CustomerFirstName;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;
use src\frontoffice\CartCheckout\Application\Create\CheckoutCartCreator;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Application\Create\CreateCartCheckoutCommand;
use src\frontoffice\PaymentMethods\Domain\Interfaces\IPaymentMethodsRepository;

final class CreateCartCheckoutCommandHandler implements CommandHandler
{
    private $orderStatusRepository;
    private $paymentMethodsRepository;
    private $orderId;
    private $customerId;
    private $customerEmail;
    private $customerFirstName;
    private $customerLastName;
    private $paymentMethodId;
    private $itemsQuantity;
    private $totalPaid;
    private $orderDetail;

    public function __construct(
        private CheckoutCartCreator $creator,
        IPaymentMethodsRepository $paymentMethodsRepository,
        IOrderStatusRepository $orderStatusRepository
    ) {
        $this->creator = $creator;
        $this->paymentMethodsRepository = $paymentMethodsRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function __invoke(CreateCartCheckoutCommand $command)
    {
        $this->orderId = OrderId::random();
        $this->customerId = new OrderCustomerId($command->CustomerId());
        $this->customerEmail = new CustomerEmail($command->customerEmail());
        $this->customerFirstName = new CustomerFirstName($command->customerFirstName());
        $this->customerLastName = new CustomerLastName($command->customerLastName());
        $this->paymentMethodId = new OrderPaymentMethodId($command->paymentMethodId());
        $this->itemsQuantity = new OrderItemsQuantity($command->itemsQuantity());
        $this->totalPaid = new OrderTotalPaid($command->totalPaid());
        $this->orderDetail = new OrderDetail($command->orderDetail());

        $this->creator->__invoke(
            $this->orderId,
            $this->customerId,
            $this->customerEmail,
            $this->customerFirstName,
            $this->customerLastName,
            $this->paymentMethodId,
            $this->itemsQuantity,
            $this->totalPaid,
            $this->orderDetail,
            $this->orderStatusRepository,
            $this->paymentMethodsRepository,
        );
    }
}
