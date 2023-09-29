<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;

class StockMovementsTypeSeeder extends Seeder
{
    public function run(): void
    {
        $stockMovementsType = [
                                [
                                    'movement_type' => 'Entrada por Compra',
                                    'description' => 'Se recibe stock de un proveedor.',
                                    'stock_impact' => 'Aumenta el stock.',
                                    'is_positive' => 1,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Entrada por devolución de cliente',
                                    'description' => 'Un cliente devuelve un producto.',
                                    'stock_impact' => 'Aumenta el stock.',
                                    'is_positive' => 1,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Entrada por inventario',
                                    'description' => 'Se realiza un recuento físico del stock.',
                                    'stock_impact' => 'Puede aumentar o disminuir el stock, dependiendo del resultado del recuento.',
                                    'is_positive' => 1,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Salida por inventario',
                                    'description' => 'Se realiza un recuento físico del stock.',
                                    'stock_impact' => 'Puede aumentar o disminuir el stock, dependiendo del resultado del recuento.',
                                    'is_positive' => 0,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Salida por venta',
                                    'description' => 'Se envía un producto a un cliente.',
                                    'stock_impact' => 'Disminuye el stock.',
                                    'is_positive' => 0,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Salida por devolución a proveedor',
                                    'description' => 'Se devuelve stock a un proveedor.',
                                    'stock_impact' => 'Disminuye el stock.',
                                    'is_positive' => 0,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Salida por pérdida o merma',
                                    'description' => 'Se pierde o deteriora un producto.',
                                    'stock_impact' => 'Disminuye el stock.',
                                    'is_positive' => 0,
                                    'enabled' => true,
                                ],
                                [
                                    'movement_type' => 'Ajuste de stock',
                                    'description' => 'Se modifica el registro contable del stock sin que haya un cambio real en la cantidad de productos en el almacén.',
                                    'stock_impact' => 'No tiene impacto en el stock.',
                                    'is_positive' => 0,
                                    'enabled' => true,
                                ],
        ];

        foreach ($stockMovementsType as $stockMovementType) {
            EloquentStockMovementTypeModel::create([
                                        'movement_type' => $stockMovementType['movement_type'],
                                        'description' => $stockMovementType['description'],
                                        'stock_impact' => $stockMovementType['stock_impact'],
                                        'is_positive' => $stockMovementType['is_positive'],
                                        'enabled' => true, 
                                    ]);
        }
    }
}
