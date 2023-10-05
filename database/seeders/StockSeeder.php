<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use src\backoffice\Stock\Infrastructure\Persistence\Eloquent\EloquentStockModel;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = [
            [
                'id' => '19a911dc-71f8-4e26-a64b-4efc5e4b83dd', 
                'product_id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'movement_type_id' => 1,
                'quantity' => 100, 
                'date' => Carbon::now(), 
                'notes' => 'nota generica ...', 
                'enabled' => true,
            ],
            [
                'id' => '291d2ae8-0cdf-4498-8ca8-7f7303b1281d', 
                'product_id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'movement_type_id' => 5,
                'quantity' => 50, 
                'date' => Carbon::now(), 
                'notes' => 'nota generica ...', 
                'enabled' => true,
            ],
            [
                'id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2', 
                'product_id' => 'b24adef7-7e34-4e6d-80e3-9c8a390ed57d',
                'movement_type_id' => 1,
                'quantity' => 80, 
                'date' => Carbon::now(), 
                'notes' => 'nota generica ...', 
                'enabled' => true,
            ],
            [
                'id' => '6eb56fbe-e87e-4f8e-b65b-59c150987ef4', 
                'product_id' => 'a9c2e84a-7cd9-4f3d-ae0d-7e64a9f3d731',
                'movement_type_id' => 1,
                'quantity' => 25, 
                'date' => Carbon::now(), 
                'notes' => 'nota generica ...', 
                'enabled' => true,
            ],
        ];

        foreach ($stocks as $stock) {
            EloquentStockModel::create([
                'id' => $stock['id'],
                'product_id' => $stock['product_id'],
                'movement_type_id' => $stock['movement_type_id'],
                'quantity' => $stock['quantity'],
                'date' => $stock['date'],
                'notes' => $stock['notes'],
                'enabled' => $stock['enabled'],
            ]);
        }
    }
}

/*


*/