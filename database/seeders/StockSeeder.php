<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock = [
            [
                'product_id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '3cc2e924-d334-4d86-9f45-d5707223dc70',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '19a911dc-71f8-4e26-a64b-4efc5e4b83dd',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'f1a7cd0b-b3a5-4d02-9c27-85b3b0ca5f32',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '04e0d91f-3f69-45cd-bcc0-3dca811723d9',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'df047f2e-83f6-4a3e-bb6d-1b1cf42aa6f5',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '7a6171b5-b0b8-4b22-a267-21a33029c23a',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'a1f8b052-9e0c-4f64-9b9b-0c11eaf660a4',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'a9c2e84a-7cd9-4f3d-ae0d-7e64a9f3d731',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '87f82b16-493c-462d-b84b-10f22193230f',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'fce19c5f-4e4b-4e3d-bfb8-d6e4dd22c65b',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => '76b234f3-44bc-4b4a-82e4-88dab82ce754',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'b24adef7-7e34-4e6d-80e3-9c8a390ed57d',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
            [
                'product_id' => 'b1450d9f-6e6c-496c-96d1-c8c8de6a9f81',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],

            [
                'product_id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2',
                'physical_quantity' => 10,
                'system_quantity' => 10,
            ],
        ];

        foreach ($stock as $stockItem) {
            $uuid = RamseyUuid::random();
            EloquentStockModel::create([
                'id' => $uuid,
                'product_id' => $stockItem['product_id'],
                'physical_quantity' => $stockItem['physical_quantity'],
                'system_quantity' => $stockItem['system_quantity'],
            ]);
        }
    }
}
