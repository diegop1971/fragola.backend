<?php

declare(strict_types=1);

namespace src\frontoffice\CartCheckout\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\CartCheckout\Domain\ValueObjects\CartCheckoutId;
use src\frontoffice\CartCheckout\Domain\ValueObjects\IdPaymentMethod;
use src\frontoffice\CartCheckout\Domain\ValueObjects\PaymentMethodName;
use src\frontoffice\CartCheckout\Application\Create\CheckoutCartCreator;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\CartCheckout\Application\Create\CreateCartCheckoutCommand;

final class CreateCartCheckoutCommandHandler implements CommandHandler
{
    private $paymentMethodName;
    private $orderStatusRepository;

    public function __construct(private CheckoutCartCreator $creator, IOrderStatusRepository $orderStatusRepository)
    {
        $this->creator = $creator;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function __invoke(CreateCartCheckoutCommand $command)
    {
        $cartCheckoutId = CartCheckoutId::random();

        $this->paymentMethodName = new PaymentMethodName($command->paymentMethodName());

        $this->creator->__invoke(
            $cartCheckoutId,
            $this->paymentMethodName,
            $this->orderStatusRepository,
        );
    }
}
