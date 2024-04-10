<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\frontoffice\OrderStatus\Domain\Interfaces\IOrderStatusRepository;
use src\frontoffice\PaymentMethods\Infrastructure\Persistence\Eloquent\PaymentMethodEloquentModel;

class PaymentMethodsSeeder extends Seeder
{
    use HasFactory;
    use HasUuids;
    private $orderStatusRepository;

    public function __construct(IOrderStatusRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function run(): void
    {
        $paymentMathodsTypes = [
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

        $initialOrderStatus = [
            'bank_wire' => 'awaiting_bank_wire',
            'cash_on_delivery' => 'awaiting_cash_payment',
            'wallet' => 'awaiting_wallet',
        ];

        foreach ($paymentMathodsTypes as $paymentMethodType) {
            if (isset($initialOrderStatus[$paymentMethodType['short_name']])) {
                $uuid = RamseyUuid::random();
                $initialOrderStatusId = $this->orderStatusRepository->searchByShortName($initialOrderStatus[$paymentMethodType['short_name']]);
                PaymentMethodEloquentModel::create([
                    'id' => $uuid,
                    'name' => $paymentMethodType['name'],
                    'short_name' => $paymentMethodType['short_name'],
                    'description' => $paymentMethodType['description'],
                    'enabled' => true,
                    'initial_order_status_id' => $initialOrderStatusId['id'],
                ]);
            }
        }
    }
}
