<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\backoffice\Shared\Domain\Stock\StockId;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Shared\Domain\Stock\StockProductId;
use src\backoffice\Stock\Application\Create\StockCreator;
use src\backoffice\Stock\Application\Create\CreateStockCommand;
use src\backoffice\Shared\Domain\Stock\StockSystemStockQuantity;
use src\backoffice\Shared\Domain\Stock\StockPhysicalStockQuantity;

final class CreateStockCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $stockPhysicalStockQuantity;
    private $stockSystemStockQuantity;

    public function __construct(private StockCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateStockCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->stockPhysicalStockQuantity = new StockPhysicalStockQuantity($command->stockPhysicalStockQuantity());
        $this->stockSystemStockQuantity = new StockSystemStockQuantity($command->stockSystemStockQuantity());

        $this->creator->__invoke(
            $this->stockId,
            $this->stockProductId,
            $this->stockPhysicalStockQuantity,
            $this->stockSystemStockQuantity,
        );
    }
}
