<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use src\backoffice\Products\Domain\IProductRepository;
use src\backoffice\StockMovements\Infrastructure\Persistence\Eloquent\EloquentStockModel;
use src\backoffice\StockMovementType\Infrastructure\Persistence\Eloquent\EloquentStockMovementTypeModel;
use Ramsey\Uuid\Uuid;

class StockMovementsSeeder extends Seeder
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = $this->productRepository->searchAll();

        foreach ($products as $product) {
            $stockId = Uuid::uuid4()->toString();
            $productId = $product['id'];
            $quantity = 10;
            $positiveStockMovementTypes = EloquentStockMovementTypeModel::where('is_positive_system', 1)->get();
            $randomStockMovementType = $positiveStockMovementTypes->random();

            EloquentStockModel::create([
                'id' => $stockId,
                'product_id' => $productId,
                'movement_type_id' => $randomStockMovementType['id'],
                'system_quantity' => $quantity,
                'physical_quantity' => $quantity,
                'date' => Carbon::now(),
                'notes' => 'nota generica ...',
                'enabled' => true,
            ]);
        }
    }
}
