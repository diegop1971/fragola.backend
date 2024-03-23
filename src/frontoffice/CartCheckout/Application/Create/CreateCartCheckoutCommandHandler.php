<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use Illuminate\Support\Facades\Log;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetail;
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
    private $paymentMethodId;
    private $itemsQuantity;
    private $totalPaid;
    private $orderDetail;

    public function __construct(private CheckoutCartCreator $creator, IPaymentMethodsRepository $paymentMethodsRepository, IOrderStatusRepository $orderStatusRepository)
    {
        $this->creator = $creator;
        $this->paymentMethodsRepository = $paymentMethodsRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function __invoke(CreateCartCheckoutCommand $command)
    {
        $this->orderId = OrderId::random();
        $this->customerId = new OrderCustomerId($command->CustomerId());
        $this->paymentMethodId = new OrderPaymentMethodId($command->paymentMethodId());
        $this->itemsQuantity = new OrderItemsQuantity($command->itemsQuantity());
        $this->totalPaid = new OrderTotalPaid($command->totalPaid());
        $this->orderDetail = new OrderDetail($command->orderDetail());

        $this->creator->__invoke(
            $this->orderId,
            $this->customerId,
            $this->paymentMethodId,
            $this->itemsQuantity,
            $this->totalPaid,
            $this->orderDetail,
            $this->orderStatusRepository,
            $this->paymentMethodsRepository,
        );
    }
}
