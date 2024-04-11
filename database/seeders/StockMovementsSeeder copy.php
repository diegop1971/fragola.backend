<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockModel;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;

class StockMovementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock = [
            [
                'id' => '19a911dc-71f8-4e26-a64b-4efc5e4b83dd',
                'product_id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'quantity' => 100,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '291d2ae8-0cdf-4498-8ca8-7f7303b1281d',
                'product_id' => '3cc2e924-d334-4d86-9f45-d5707223dc70',
                'quantity' => 50,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2',
                'product_id' => '19a911dc-71f8-4e26-a64b-4efc5e4b83dd',
                'quantity' => 80,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '6eb56fbe-e87e-4f8e-b65b-59c150987ef4',
                'product_id' => 'f1a7cd0b-b3a5-4d02-9c27-85b3b0ca5f32',
                'quantity' => 25,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '04e0d91f-3f69-45cd-bcc0-3dca811723d9',
                'quantity' => 18,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 5,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 10,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 7,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 45,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 2,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 8,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 5,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 3,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 30,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '',
                'product_id' => '',
                'quantity' => 14,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
        ];

        $positiveStockMovementTypes = EloquentStockMovementTypeModel::where('is_positive', 1)->get();

        foreach ($stock as $stockItem) {
            $randomStockMovementType = $positiveStockMovementTypes->random();

            EloquentStockModel::create([
                'id' => $stockItem['id'],
                'product_id' => $stockItem['product_id'],
                'movement_type_id' => $randomStockMovementType['id'],
                'quantity' => $stockItem['quantity'],
                'date' => $stockItem['date'],
                'notes' => $stockItem['notes'],
                'enabled' => $stockItem['enabled'],
            ]);
        }
    }
}
