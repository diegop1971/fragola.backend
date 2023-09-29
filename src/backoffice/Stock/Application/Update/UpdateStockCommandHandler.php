<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;


use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Domain\ValueObjects\StockDate;
use src\backoffice\Stock\Domain\ValueObjects\StockNotes;
use src\backoffice\Stock\Application\Update\StockUpdater;
use src\backoffice\Stock\Domain\ValueObjects\StockEnabled;
use src\backoffice\Stock\Domain\ValueObjects\StockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Application\Update\UpdateStockCommand;
use src\backoffice\Stock\Domain\ValueObjects\StockMovementTypeId;

final class UpdateStockCommandHandler implements CommandHandler
{
    private $id;
    private $product_id;
    private $movement_type_id;
    private $quantity;
    private $date;
    private $notes;
    private $enabled;

    public function __construct(private StockUpdater $stockUpdater)
    {
        $this->stockUpdater = $stockUpdater;
    }

    public function __invoke(UpdateStockCommand $command)
    {
        $this->id = new StockId($command->stockId());
        $this->product_id = new StockProductId($command->stockProductId());
        $this->movement_type_id = new StockMovementTypeId($command->stockMovementTypeId());
        $this->quantity = new StockQuantity($command->stockQuantity());
        $this->date = new StockDate($command->stockDate());
        $this->notes = new StockNotes($command->stockNotes());
        $this->enabled = new StockEnabled($command->stockEnabled());
        
        $this->stockUpdater->__invoke(
                                    $this->id, 
                                    $this->product_id, 
                                    $this->movement_type_id, 
                                    $this->quantity, 
                                    $this->date, 
                                    $this->notes, 
                                    $this->enabled
                                );
    }
}
