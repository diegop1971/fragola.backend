<?php

declare(strict_types=1);

namespace src\frontoffice\OrdersDetails\Domain;

use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailId;
use src\frontoffice\Orders\Domain\ValueObjects\OrderId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailQuantity;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailProductId;
use src\frontoffice\OrdersDetails\Domain\ValueObjects\OrderDetailUnitPrice;

final class OrderDetailEntity
{
    public function __construct(
        private OrderDetailId $id,
        private OrderId $orderId,
        private OrderDetailProductId $productId,
        private OrderDetailQuantity $quantity,
        private OrderDetailUnitPrice $unitPrice,
    ) {
    }

    public static function create(
        OrderDetailId $id,
        OrderId $orderId,
        OrderDetailProductId $productId,
        OrderDetailQuantity $quantity,
        OrderDetailUnitPrice $unitPrice,
    ): self {
        $order = new self(
            $id,
            $orderId,
            $productId,
            $quantity,
            $unitPrice,
        );

        return $order;
    }

    public static function update(
        OrderDetailId $id,
        OrderId $orderId,
        OrderDetailProductId $productId,
        OrderDetailQuantity $quantity,
        OrderDetailUnitPrice $unitPrice,
    ): self {
        $order = new self(
            $id,
            $orderId,
            $productId,
            $quantity,
            $unitPrice,
        );

        return $order;
    }

    public function orderDetailId(): OrderDetailId
    {
        return $this->id;
    }

    public function orderOrderId(): OrderId
    {
        return $this->orderId;
    }

    public function orderDetailProductId(): OrderDetailProductId
    {
        return $this->productId;
    }

    public function orderDetailQuantity(): OrderDetailQuantity
    {
        return $this->quantity;
    }

    public function orderDetailUnitPrice(): OrderDetailUnitPrice
    {
        return $this->unitPrice;
    }
}
