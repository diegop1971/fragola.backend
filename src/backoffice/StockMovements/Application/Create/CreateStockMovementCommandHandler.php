<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\StockMovements\Domain\ValueObjects\StockId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockDate;
use src\backoffice\StockMovements\Domain\ValueObjects\StockNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockEnabled;
use src\backoffice\StockMovements\Domain\ValueObjects\StockQuantity;
use src\backoffice\StockMovements\Domain\ValueObjects\StockProductId;
use src\backoffice\StockMovements\Application\Create\StockMovementCreator;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementTypeId;
use src\backoffice\StockMovements\Application\Create\CreateStockMovementCommand;

final class CreateStockMovementCommandHandler implements CommandHandler
{
    private $stockId; 
    private $stockProductId; 
    private $stockMovementTypeId; 
    private $stockQuantity; 
    private $stockDate; 
    private $stockNotes; 
    private $stockEnabled;

    public function __construct(private StockMovementCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateStockMovementCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->stockMovementTypeId = new StockMovementTypeId($command->stockMovementTypeId());
        $this->stockQuantity = new StockQuantity($command->stockQuantity());
        $this->stockDate = new StockDate($command->stockDate());
        $this->stockNotes = new StockNotes($command->stockNotes());
        $this->stockEnabled = new StockEnabled($command->stockEnabled());

        $this->creator->__invoke(
                                $this->stockId,
                                $this->stockProductId,
                                $this->stockMovementTypeId,
                                $this->stockQuantity,
                                $this->stockDate,
                                $this->stockNotes,
                                $this->stockEnabled,
                            );
    }
}
