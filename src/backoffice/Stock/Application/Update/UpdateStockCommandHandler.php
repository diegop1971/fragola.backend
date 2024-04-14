<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;


use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Application\Update\StockUpdater;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Application\Update\UpdateStockCommand;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;

final class UpdateStockCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $physicalStockQuantity;
    private $systemStockQuantity;

    public function __construct(private StockUpdater $stockUpdater)
    {
        $this->stockUpdater = $stockUpdater;
    }

    public function __invoke(UpdateStockCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->physicalStockQuantity = new PhysicalStockQuantity($command->physicalStockQuantity());
        $this->systemStockQuantity = new SystemStockQuantity($command->systemStockQuantity());
        
        $this->stockUpdater->__invoke(
                                    $this->stockId, 
                                    $this->stockProductId, 
                                    $this->physicalStockQuantity, 
                                    $this->systemStockQuantity, 
                                );
    }
}
