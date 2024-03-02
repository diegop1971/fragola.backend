<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class StockSeeder extends Seeder
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
                'physical_quantity' => 150,
                'usable_quantity' => 150,
            ],
            [
                'id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2',
                'product_id' => 'b24adef7-7e34-4e6d-80e3-9c8a390ed57d',
                'physical_quantity' => 80,
                'usable_quantity' => 80,
            ],
            [
                'id' => '6eb56fbe-e87e-4f8e-b65b-59c150987ef4',
                'product_id' => 'a9c2e84a-7cd9-4f3d-ae0d-7e64a9f3d731',
                'physical_quantity' => 25,
                'usable_quantity' => 25,
            ],
        ];

        foreach ($stock as $stockItem) {
            EloquentStockModel::create([
                'id' => $stockItem['id'],
                'product_id' => $stockItem['product_id'],
                'physical_quantity' => $stockItem['physical_quantity'],
                'usable_quantity' => $stockItem['usable_quantity'],
            ]);
        }
    }
}
