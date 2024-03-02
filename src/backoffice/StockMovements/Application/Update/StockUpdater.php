<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Update;

use src\backoffice\Stock\Domain\Stock;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockDate;
use src\backoffice\Stock\Domain\ValueObjects\StockNotes;
use src\backoffice\Stock\Domain\ValueObjects\StockEnabled;
use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;
use src\backoffice\Stock\Domain\Interfaces\IStockRepository;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovementType\Domain\StockMovementTypeRepository;

final class StockUpdater
{
    public function __construct( 
                                private IStockRepository $stockRepository, 
                                private StockMovementTypeRepository $stockMovementTypeRepository
                            ) {
    }

    public function __invoke(
                            StockId $stockId, 
                            StockProductId $stockProductId, 
                            StockMovementTypeId $stockMovementTypeId, 
                            StockQuantity $stockQuantity, 
                            StockDate $stockDate, 
                            StockNotes $stockNotes, 
                            StockEnabled $stockEnabled
                        )
    {
        $stock = Stock::update(
                                $stockId, 
                                $stockProductId, 
                                $stockMovementTypeId, 
                                $stockQuantity, 
                                $stockDate, 
                                $stockNotes, 
                                $stockEnabled,
                                $this->stockRepository,
                                $this->stockMovementTypeRepository,
                            );

        $this->stockRepository->update($stock);
    }
}
