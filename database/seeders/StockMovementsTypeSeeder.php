<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class StockMovementsTypeSeeder extends Seeder
{
    public function run(): void
    {
        $stockMovementsType = [
            [
                'movement_type' => 'Entry by Purchase',
                'short_name' => 'entry_by_purchase',
                'description' => 'Stock is received from a supplier.',
                'stock_impact' => 'Increases the stock.',
                'is_positive_system' => 1,
                'is_positive_physical' => 1,
                'enabled' => true,
            ],
            [
                'movement_type' => 'Entry by customer return',
                'short_name' => 'entry_by_customer_return',
                'description' => 'A customer returns a product.',
                'stock_impact' => 'Increases the stock.',
                'is_positive_system' => 1,
                'is_positive_physical' => 1,
                'enabled' => true,
            ],
            /*[
                'movement_type' => 'Entry by inventory',
                'short_name' => 'entry_by_inventory',
                'description' => 'A physical count of the stock is carried out.',
                'stock_impact' => 'Can increase or decrease the stock, depending on the result of the count.',
                'is_positive_system' => 1,
                'is_positive_physical' => 1,
                'enabled' => true,
            ],
            [
                'movement_type' => 'Inventory Outflow',
                'short_name' => 'inventory_outflow',
                'description' => 'A physical count of the stock is carried out.',
                'stock_impact' => 'Can increase or decrease the stock, depending on the result of the count.',
                'is_positive_system' => 0,
                'is_positive_physical' => 1,
                'enabled' => true,
            ],*/
            [
                'movement_type' => 'Sale',
                'short_name' => 'sale',
                'description' => 'A product is purchased by a customer.',
                'stock_impact' => 'Decreases the virtual stock.',
                'is_positive_system' => -1,
                'is_positive_physical' => 0,
                'enabled' => true,
            ],
            [
                'movement_type' => 'Shipping',
                'short_name' => 'shipping',
                'description' => 'A product is shipped to a customer.',
                'stock_impact' => 'Decreases the real stock.',
                'is_positive_system' => 0,
                'is_positive_physical' => -1,
                'enabled' => true,
            ],            
            [
                'movement_type' => 'Exit by return to supplier',
                'short_name' => 'exit_by_return_to_supplier',
                'description' => 'Stock is returned to a supplier.',
                'stock_impact' => 'Decreases the stock.',
                'is_positive_system' => -1,
                'is_positive_physical' => -1,
                'enabled' => true,
            ],
            [
                'movement_type' => 'Exit by loss or shrinkage',
                'short_name' => 'exit_by_loss_or_shrinkage',
                'description' => 'A product is lost or deteriorated.',
                'stock_impact' => 'Decreases the stock.',
                'is_positive_system' => -1,
                'is_positive_physical' => -1,
                'enabled' => true,
            ],
            /*[
                'movement_type' => 'Stock adjustment',
                'short_name' => 'stock_adjustment',
                'description' => 'The accounting record of the stock is modified without there being a real change in the quantity of products in the warehouse.',
                'stock_impact' => 'Has no impact on the stock.',
                'is_positive_system' => -1,
                'is_positive_physical' => -1,
                'enabled' => true,
            ],*/
        ];

        foreach ($stockMovementsType as $stockMovementType) {
            $uuid = RamseyUuid::random();

            if (!EloquentStockMovementTypeModel::where('id', $uuid)->exists()) {
                EloquentStockMovementTypeModel::create([
                    'id' => $uuid,
                    'movement_type' => $stockMovementType['movement_type'],
                    'short_name' => $stockMovementType['short_name'],
                    'description' => $stockMovementType['description'],
                    'stock_impact' => $stockMovementType['stock_impact'],
                    'is_positive_system' => $stockMovementType['is_positive_system'],
                    'is_positive_physical' => $stockMovementType['is_positive_physical'],
                    'enabled' => true,
                ]);
            }
        }
    }
}
