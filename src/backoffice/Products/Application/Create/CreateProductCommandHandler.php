<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Categories\Domain\CategoryId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Products\Application\Create\ProductCreator;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Products\Application\Create\CreateProductCommand;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockAlert;
use src\backoffice\Products\Domain\ValueObjects\ProductDescriptionShort;
use src\backoffice\Products\Domain\ValueObjects\ProductLowStockThreshold;

final class CreateProductCommandHandler implements CommandHandler
{
    private $productId;
    private $name;
    private $description;
    private  $descriptionShort;
    private $unitPrice;
    private $categoryId;
    private $lowStockAlert;
    private $lowStockThreshold;
    private $outOfStock;
    private $enabled;
    private $stockId;
    private $stockProductId;
    private $stockPhysicalStockQuantity;
    private $stockSystemStockQuantity;

    public function __construct(private ProductCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateProductCommand $command)
    {
        $this->productId = new ProductId($command->productId());
        $this->name = new ProductName($command->productName());
        $this->description = new ProductDescription($command->productDescription());
        $this->descriptionShort = new ProductDescriptionShort($command->productDescriptionShort());
        $this->unitPrice = new ProductUnitPrice($command->productUnitPrice());
        $this->categoryId = new CategoryId($command->categoryId());
        $this->lowStockAlert = new ProductLowStockAlert($command->productLowStockAlert());
        $this->lowStockThreshold = new ProductLowStockThreshold($command->productLowStockThreshold());
        $this->outOfStock = new ProductOutOfStock($command->productOutOfStock());
        $this->enabled = new ProductEnabled($command->enabled());
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->productId());
        $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($command->stockPhysicalStockQuantity());
        $this->stockSystemStockQuantity = new StockSystemStockQuantity($command->stockSystemStockQuantity());

        $this->creator->__invoke(
            $this->productId,
            $this->name,
            $this->description,
            $this->descriptionShort,
            $this->unitPrice,
            $this->categoryId,
            $this->lowStockAlert,
            $this->lowStockThreshold,
            $this->outOfStock,
            $this->enabled,
            $this->stockId,
            $this->stockProductId,
            $this->stockPhysicalStockQuantity,
            $this->stockSystemStockQuantity,
        );
    }
}
