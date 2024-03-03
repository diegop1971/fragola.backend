<?php

namespace src\backoffice\StockMovements\Domain\Services;

use Illuminate\Support\Facades\Log;
use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\StockMovements\Domain\Interfaces\StockUpdaterServiceInterface;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockPhysicalQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockUsableQuantity;

class StockUpdaterService implements StockUpdaterServiceInterface
{
    private $stockId;
    private $stockProductId;
    private $stockPhysicalQuantity;
    private $stockUsableQuantity;

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
        $usableQuantity = $stockItem[0]['usable_quantity'] + $stockQuantity;

        $stock = Stock::create(
            $this->stockId = new StockId($stockId),
            $this->stockProductId = new StockProductId($stockProductId),
            $this->stockPhysicalQuantity = new StockPhysicalQuantity($physicalQuantity),
            $this->stockUsableQuantity = new StockUsableQuantity($usableQuantity),
        );
        $this->stockRepository->updateQuantities($stock);
    }
}
