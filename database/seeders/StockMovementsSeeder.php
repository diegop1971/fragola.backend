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
                'product_id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'quantity' => 50,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2',
                'product_id' => 'b24adef7-7e34-4e6d-80e3-9c8a390ed57d',
                'quantity' => 80,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
            [
                'id' => '6eb56fbe-e87e-4f8e-b65b-59c150987ef4',
                'product_id' => 'a9c2e84a-7cd9-4f3d-ae0d-7e64a9f3d731',
                'quantity' => 25,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ],
        ];

        foreach ($stock as $stockItem) {
            $randomStockMovementType = EloquentStockMovementTypeModel::inRandomOrder()->first();

            if ($randomStockMovementType) {
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
}

/*


*/