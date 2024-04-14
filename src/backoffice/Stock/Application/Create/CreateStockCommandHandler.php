<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Application\Create\StockCreator;
use src\backoffice\Stock\Application\Create\CreateStockCommand;
use src\backoffice\Stock\Domain\ValueObjects\PhysicalStockQuantity;
use src\backoffice\Stock\Domain\ValueObjects\SystemStockQuantity;

final class CreateStockCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $physicalStockQuantity;
    private $systemStockQuantity;

    public function __construct(private StockCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateStockCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->physicalStockQuantity = new PhysicalStockQuantity($command->physicalStockQuantity());
        $this->systemStockQuantity = new SystemStockQuantity($command->systemStockQuantity());

        $this->creator->__invoke(
            $this->stockId,
            $this->stockProductId,
            $this->physicalStockQuantity,
            $this->systemStockQuantity,
        );
    }
}
