<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use Throwable;
use Illuminate\Support\Facades\DB;
use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Products\Domain\Product;
use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Products\Domain\IProductRepository;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\Interfaces\IValidateLowStockThresholdQuantity;

final class ProductCreator
{
    public function __construct(
        private IProductRepository $productRepository,
        private IStockRepository $stockRepository,
        private IValidateLowStockThresholdQuantity $validateLowStockThresholdQuantityService,
    ) {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    public function __invoke(
        ProductId $productId,
        ProductName $productName,
        ProductDescription $productDescription,
        ProductDescriptionShort $productDescriptionShort,
        ProductUnitPrice $productUnitPrice,
        CategoryId $categoryId,
        ProductLowStockAlert $lowStockAlert,
        ProductLowStockThreshold $lowStockThreshold,
        ProductOutOfStock $outOfStock,
        ProductEnabled $enabled,
        StockId $stockId,
        StockProductId $stockProductId,
        StockPhysicalStockQuantity $stockPhysicalStockQuantity,
        StockSystemStockQuantity $stockSystemStockQuantity,
    ) {
        $this->validateOperation($lowStockThreshold);

        try {
            DB::beginTransaction();

            $product = Product::create(
                $productId,
                $productName,
                $productDescription,
                $productDescriptionShort,
                $productUnitPrice,
                $categoryId,
                $lowStockAlert,
                $lowStockThreshold,
                $outOfStock,
                $enabled,
            );

            $this->productRepository->save($product);

            $stock = Stock::create(
                $stockId,
                $stockProductId,
                $stockPhysicalStockQuantity,
                $stockSystemStockQuantity,
            );

            $this->stockRepository->save($stock);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function validateOperation($lowStockThreshold): void
    {
        $this->validateLowStockThresholdQuantityService->validateLowStockThresholdQuantity($lowStockThreshold);
    }
}
