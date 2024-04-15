<?php

namespace src\backoffice\StockMovements\Domain\Services;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Shared\Domain\Stock\StockId;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;

class StockUpdaterService implements StockUpdaterServiceInterface
{
    private $stockId;
    private $stockProductId;
    private $stockPhysicalStockQuantity;
    private $stockSystemStockQuantity;

    public function __construct(
        private IStockRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }

    public function updateStockFromMovement(string $stockProductId, int $stockQuantity): void
    {
        $stockItem = $this->stockRepository->getStockByProductId($stockProductId);
        
        $stockId = $stockItem[0]['id'];
        $physicalQuantity = $stockItem[0]['physical_quantity'] + $stockQuantity;
        $systemQuantity = $stockItem[0]['system_quantity'] + $stockQuantity;

        $stock = Stock::create(
            $this->stockId = new StockId($stockId),
            $this->stockProductId = new StockProductId($stockProductId),
            $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($physicalQuantity),
            $this->stockSystemStockQuantity = new StockSystemStockQuantity($systemQuantity),
        );
        
        $this->stockRepository->updateQuantities($stock);
    }
}
