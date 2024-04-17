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
    private $stockSystemStockQuantity;
    private $stockPhysicalStockQuantity;

    public function __construct(
        private IStockRepository $stockRepository
    ) {
        $this->stockRepository = $stockRepository;
    }

    public function updateStockFromMovement(string $stockProductId, StockSystemStockQuantity $systemStockQuantity, StockPhysicalStockQuantity $physicalStockQuantity): void
    {
        $stockItem = $this->stockRepository->getStockByProductId($stockProductId);
        
        $stockId = $stockItem[0]['id'];
        $systemQuantity = $stockItem[0]['system_quantity'] + $systemStockQuantity->value();
        $physicalQuantity = $stockItem[0]['physical_quantity'] + $physicalStockQuantity->value();
        
        $stock = Stock::create(
            $this->stockId = new StockId($stockId),
            $this->stockProductId = new StockProductId($stockProductId),
            $this->stockSystemStockQuantity = new StockSystemStockQuantity($systemQuantity),
            $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($physicalQuantity),
        );
        
        $this->stockRepository->updateQuantities($stock);
    }
}
