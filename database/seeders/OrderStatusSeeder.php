<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class OrderStatusSeeder extends Seeder
{
    use HasFactory;
    use HasUuids;

    public function run(): void
    {
        $OrderStatusTypes = [
            [
                'name' => 'Awaiting cash payment at the establishment.',
                'short_name' => 'awaiting_cash_payment',
                'description' => 'The order is pending payment to be made at the establishment when the customer picks up the product.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting bank wire payment',
                'short_name' => 'awaiting_bank_wire',
                'description' => 'The order is pending payment to be made via bank transfer.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting Wallet confirmation',
                'short_name' => 'awaiting_wallet',
                'description' => 'The order is pending payment to be made via a virtual wallet.',
                'enabled' => true,
            ],
            [
                'name' => 'Paid',
                'short_name' => 'paid',
                'description' => 'The customer has completed the payment process and the payment has been successfully received.',
                'enabled' => true,
            ],
            [
                'name' => 'In preparation',
                'short_name' => 'in_preparation',
                'description' => 'The order has been paid for and is in the process of preparation for shipment. Products are being collected and packaged.',
                'enabled' => true,
            ],
            [
                'name' => 'Shipped',
                'short_name' => 'shipped',
                'description' => 'The products of the order have been shipped to the customer and are on their way to their destination.',
                'enabled' => true,
            ],
            [
                'name' => 'Delivered',
                'short_name' => 'delivered',
                'description' => 'The order has reached its destination and has been delivered to the customer.',
                'enabled' => true,
            ],
            [
                'name' => 'Cancelled',
                'short_name' => 'cancelled',
                'description' => 'The order has been canceled for some reason. It may be due to a customer request or an issue with the order.',
                'enabled' => true,
            ],
            [
                'name' => 'Refunded',
                'short_name' => 'refunded',
                'description' => 'A refund has been processed to the customer for the order. This can occur in situations such as returns or cancellations.',
                'enabled' => true,
            ],
            [
                'name' => 'Payment error',
                'short_name' => 'payment_error',
                'description' => 'There was an issue processing the payment for the order. It may require intervention to resolve the problem.',
                'enabled' => true,
            ],
            [
                'name' => 'Merchandise return',
                'short_name' => 'merchandise_return',
                'description' => 'The customer has returned some or all of the products from the order.',
                'enabled' => true,
            ],
        ];        

        foreach ($OrderStatusTypes as $OrderStatusType) {
            $uuid = RamseyUuid::random();
            if (!OrderStatusEloquentModel::where('id', $uuid)->exists()) {
                OrderStatusEloquentModel::create([
                    'id' => $uuid,
                    'name' => $OrderStatusType['name'],
                    'short_name' => $OrderStatusType['short_name'],
                    'description' => $OrderStatusType['description'],
                    'enabled' => true,
                ]);
            }
        }
    }
}
