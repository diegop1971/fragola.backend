<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Create;

use src\backoffice\Products\Domain\ProductId;
use src\backoffice\Products\Domain\ProductName;
use src\backoffice\Categories\Domain\CategoryId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Products\Domain\ProductEnabled;
use src\backoffice\Products\Domain\ProductUnitPrice;
use src\backoffice\Products\Domain\ProductDescription;
use src\backoffice\Products\Domain\ProductLowStockAlert;
use src\backoffice\Products\Domain\ProductMinimumQuantity;
use src\backoffice\Products\Domain\ProductDescriptionShort;
use src\backoffice\Products\Domain\ProductLowStockThreshold;
use src\backoffice\Products\Application\Create\ProductCreator;
use src\backoffice\Products\Application\Create\CreateProductCommand;

final class CreateProductCommandHandler implements CommandHandler
{
    private $id; 
    private $name; 
    private $description; 
    private  $descriptionShort; 
    private $unitPrice; 
    private $categoryId; 
    private $minimumQuantity; 
    private $lowStockThreshold; 
    private $lowStockAlert;  
    private $enabled;

    public function __construct(private ProductCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateProductCommand $command)
    {
        $this->id = new ProductId($command->productId());
        $this->name = new ProductName($command->productName());
        $this->description = new ProductDescription($command->productDescription());
        $this->descriptionShort = new ProductDescriptionShort($command->productDescriptionShort());
        $this->unitPrice = new ProductUnitPrice($command->productUnitPrice());
        $this->categoryId = new CategoryId($command->categoryId());
        $this->minimumQuantity = new ProductMinimumQuantity($command->productMinimumQuantity());
        $this->lowStockThreshold = new ProductLowStockThreshold($command->productLowStockThreshold());
        $this->lowStockAlert = new ProductLowStockAlert($command->productLowStockAlert());
        $this->enabled = new ProductEnabled($command->enabled());
        
        $this->creator->__invoke(
                                $this->id, 
                                $this->name, 
                                $this->description, 
                                $this->descriptionShort,
                                $this->unitPrice, 
                                $this->categoryId, 
                                $this->minimumQuantity,
                                $this->lowStockThreshold,
                                $this->lowStockAlert,
                                $this->enabled
                            );
    }
}
