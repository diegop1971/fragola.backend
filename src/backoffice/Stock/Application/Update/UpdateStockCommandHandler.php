<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Update;


use src\backoffice\Shared\Domain\Stock\StockId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Stock\Application\Update\StockUpdater;
use src\backoffice\Stock\Application\Update\UpdateStockCommand;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;

final class UpdateStockCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $stockPhysicalStockQuantity;
    private $stockSystemStockQuantity;

    public function __construct(private StockUpdater $stockUpdater)
    {
        $this->stockUpdater = $stockUpdater;
    }

    public function __invoke(UpdateStockCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($command->stockPhysicalStockQuantity());
        $this->stockSystemStockQuantity = new StockSystemStockQuantity($command->stockSystemStockQuantity());

        $this->stockUpdater->__invoke(
            $this->stockId,
            $this->stockProductId,
            $this->stockPhysicalStockQuantity,
            $this->stockSystemStockQuantity,
        );
    }
}
