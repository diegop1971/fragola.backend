<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Update;

use src\backoffice\Categories\Domain\CategoryId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Products\Application\Update\ProductUpdater;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Application\Update\UpdateProductCommand;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;

final class UpdateProductCommandHandler implements CommandHandler
{
    private ProductId $id;
    private ProductName $name;
    private ProductDescription $description;
    private ProductDescriptionShort $descriptionShort;
    private ProductUnitPrice $unitPrice;
    private CategoryId $categoryId;
    private ProductLowStockAlert $lowStockAlert;
    private ProductLowStockThreshold $lowStockThreshold;
    private ProductOutOfStock $outOfStock;
    private ProductEnabled $enabled;

    public function __construct(private ProductUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateProductCommand $command)
    {
        $this->id = new ProductId($command->productId());
        $this->name = new ProductName($command->productName());
        $this->description = new ProductDescription($command->productDescription());
        $this->descriptionShort = new ProductDescriptionShort($command->productDescriptionShort());
        $this->unitPrice = new ProductUnitPrice($command->productUnitPrice());
        $this->categoryId = new CategoryId($command->categoryId());
        $this->lowStockAlert = new ProductLowStockAlert($command->productLowStockAlert());
        $this->lowStockThreshold = new ProductLowStockThreshold($command->productLowStockThreshold());
        $this->outOfStock = new ProductOutOfStock($command->productOutOfStock());
        $this->enabled = new ProductEnabled($command->enabled());

        $this->updater->__invoke(
            $this->id,
            $this->name,
            $this->description,
            $this->descriptionShort,
            $this->unitPrice,
            $this->categoryId,
            $this->lowStockAlert,
            $this->lowStockThreshold,
            $this->outOfStock,
            $this->enabled
        );
    }
}
