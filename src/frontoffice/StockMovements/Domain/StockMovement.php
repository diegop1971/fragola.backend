<?php

declare(strict_types=1);

namespace src\frontoffice\StockMovements\Domain;

use src\frontoffice\StockMovements\Domain\ValueObjects\StockId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\frontoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;


final class StockMovement
{
    public function __construct(
                                private StockId $stockId, 
                                private StockProductId $stockProductId,
                                private StockMovementTypeId $stockMovementTypeId,
                                private StockQuantity $stockQuantity,
                                private StockDate $stockDate,
                                private StockNotes $stockNotes,
                                private StockEnabled $stockEnabled,
                            ) {
    }

    public static function create(
                                StockId $stockId, 
                                StockProductId $stockProductId, 
                                StockMovementTypeId $stockMovementTypeId, 
                                StockQuantity $stockQuantity, 
                                StockDate $stockDate, 
                                StockNotes $stockNotes, 
                                StockEnabled $StockEnabled,
                            ): self
    {                               
        $stock = new self(
                        $stockId, 
                        $stockProductId, 
                        $stockMovementTypeId, 
                        $stockQuantity, 
                        $stockDate, 
                        $stockNotes,  
                        $StockEnabled,
                    );

        return $stock;
    }

    public function stockId(): StockId
    {
        return $this->stockId;
    }

    public function stockProductId(): StockProductId
    {
        return $this->stockProductId;
    }

    public function stockMovementTypeId(): StockMovementTypeId
    {
        return $this->stockMovementTypeId;
    }

    public function stockQuantity(): StockQuantity
    {
        return $this->stockQuantity;
    }

    public function stockQuantityAbsolute(): int
    {
        return abs($this->stockQuantity->value());
    }

    public function stockDate(): StockDate
    {
        return $this->stockDate;
    }

    public function stockNotes(): StockNotes
    {
        return $this->stockNotes;
    }

    public function stockEnabled(): StockEnabled
    {
        return $this->stockEnabled;
    }
}
