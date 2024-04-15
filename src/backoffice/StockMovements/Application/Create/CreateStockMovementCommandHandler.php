<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Create;

use src\backoffice\Shared\Domain\Stock\StockId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Shared\Domain\Stock\StockQuantity;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Shared\Domain\StockMovementType\StockMovementTypeId;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsDate;
use src\backoffice\StockMovements\Application\Create\StockMovementCreator;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsNotes;
use src\backoffice\StockMovements\Domain\ValueObjects\StockMovementsEnabled;
use src\backoffice\StockMovements\Application\Create\CreateStockMovementCommand;

final class CreateStockMovementCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $stockMovementTypeId;
    private $stockQuantity;
    private $stockMovementsDate;
    private $stockMovementsNotes;
    private $stockMovementsEnabled;

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
        $this->stockMovementsDate = new StockMovementsDate($command->stockMovementsDate());
        $this->stockMovementsNotes = new StockMovementsNotes($command->stockMovementsNotes());
        $this->stockMovementsEnabled = new StockMovementsEnabled($command->stockMovementsEnabled());

        $this->creator->__invoke(
            $this->stockId,
            $this->stockProductId,
            $this->stockMovementTypeId,
            $this->stockQuantity,
            $this->stockMovementsDate,
            $this->stockMovementsNotes,
            $this->stockMovementsEnabled,
        );
    }
}
