<?php

declare(strict_types=1);

namespace src\frontoffice\Orders\Domain;

use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderStatusId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderTotalPaid;
use src\frontoffice\Orders\Domain\ValueObjects\OrderCustomerId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderItemsQuantity;
use src\frontoffice\Orders\Domain\ValueObjects\OrderPaymentMethodId;

final class Order
{
    public function __construct(
        private OrderId $orderId,
        private OrderCustomerId $orderCustomerId,
        private OrderPaymentMethodId $orderPaymentMethodId,
        private OrderStatusId $orderStatusId,
        private OrderItemsQuantity $orderItemsQuantity,
        private OrderTotalPaid $orderTotalPaid,
    ) {
    }

    public static function create(
        OrderId $orderId,
        OrderCustomerId $orderCustomerId,
        OrderPaymentMethodId $orderPaymentMethodId,
        OrderStatusId $orderStatusId,
        OrderItemsQuantity $orderItemsQuantity,
        OrderTotalPaid $orderTotalPaid,
    ): self {
        $order = new self(
            $orderId,
            $orderCustomerId,
            $orderPaymentMethodId,
            $orderStatusId,
            $orderItemsQuantity,
            $orderTotalPaid,
        );

        return $order;
    }

    public static function update(
        OrderId $orderId,
        OrderCustomerId $orderCustomerId,
        OrderPaymentMethodId $orderPaymentMethodId,
        OrderStatusId $orderStatusId,
        OrderItemsQuantity $orderItemsQuantity,
        OrderTotalPaid $orderTotalPaid,
    ): self {
        $order = new self(
            $orderId,
            $orderCustomerId,
            $orderPaymentMethodId,
            $orderStatusId,
            $orderItemsQuantity,
            $orderTotalPaid,
        );

        return $order;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function orderCustomerId(): OrderCustomerId
    {
        return $this->orderCustomerId;
    }

    public function orderPaymentMethodId(): OrderPaymentMethodId
    {
        return $this->orderPaymentMethodId;
    }

    public function orderStatusId(): OrderStatusId
    {
        return $this->orderStatusId;
    }

    public function orderItemsQuantity(): OrderItemsQuantity
    {
        return $this->orderItemsQuantity;
    }

    public function orderTotalPaid(): OrderTotalPaid
    {
        return $this->orderTotalPaid;
    }
}
