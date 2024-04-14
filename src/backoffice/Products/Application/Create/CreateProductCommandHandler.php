<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\backoffice\Categories\Domain\CategoryId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Products\Domain\ValueObjects\ProductId;
use src\backoffice\Products\Domain\ValueObjects\ProductName;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Products\Application\Create\ProductCreator;
use src\backoffice\Products\Domain\ValueObjects\ProductEnabled;
use src\backoffice\Products\Domain\ValueObjects\ProductUnitPrice;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Products\Domain\ValueObjects\ProductOutOfStock;
use src\backoffice\Products\Domain\ValueObjects\ProductDescription;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;
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
    private $physicalStockQuantity;
    private $systemStockQuantity;

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
        $this->physicalStockQuantity = new PhysicalStockQuantity($command->physicalStockQuantity());
        $this->systemStockQuantity = new SystemStockQuantity($command->systemStockQuantity());

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
            $this->physicalStockQuantity,
            $this->systemStockQuantity,
        );
    }
}
