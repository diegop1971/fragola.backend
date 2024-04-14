<?php

namespace src\frontoffice\StockMovements\Domain\Services;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;

class StockUpdaterService implements StockUpdaterServiceInterface
{
    private $stockId;
    private $stockProductId;
    private $physicalStockQuantity;
    private $systemStockQuantity;

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
            $this->physicalStockQuantity = new PhysicalStockQuantity($physicalQuantity),
            $this->systemStockQuantity = new SystemStockQuantity($systemQuantity),
        );
        
        $this->stockRepository->updateQuantities($stock);
    }
}
