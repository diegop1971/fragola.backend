<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

class PaymentMethodsSeeder extends Seeder
{
    use HasFactory;
    use HasUuids;

    public function run(): void
    {
        $OrderStatusTypes = [
            [
                'name' => 'Bank wire payment',
                'short_name' => 'bank_wire',
                'description' => 'Payment is made by transferring money directly from the customer\'s bank account to the seller\'s bank account.',
                'enabled' => true,
            ],
            [
                'name' => 'Cash On Delivery Payment',
                'short_name' => 'cash_on_delivery',
                'description' => 'Payment is made in cash by the customer at the time of product delivery.',
                'enabled' => true,
            ],
            [
                'name' => 'Wallet Payment',
                'short_name' => 'wallet',
                'description' => 'Payments are made using a digital wallet.',
                'enabled' => true,
            ],
        ];

        foreach ($OrderStatusTypes as $OrderStatusType) {
            $uuid = RamseyUuid::random();
            if (!PaymentMethodEloquentModel::where('id', $uuid)->exists()) {
                PaymentMethodEloquentModel::create([
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
