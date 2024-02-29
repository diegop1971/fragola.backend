<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Create;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Domain\ValueObjects\StockId;
use src\backoffice\Stock\Domain\ValueObjects\StockProductId;
use src\backoffice\Stock\Application\Create\StockCreator;
use src\backoffice\Stock\Application\Create\CreateStockCommand;
use src\backoffice\Stock\Domain\ValueObjects\StockPhysicalQuantity;
use src\backoffice\Stock\Domain\ValueObjects\StockUsableQuantity;

final class CreateStockCommandHandler implements CommandHandler
{
    private $stockId;
    private $stockProductId;
    private $stockPhysicalQuantity;
    private $stockUsableQuantity;

    public function __construct(private StockCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateStockCommand $command)
    {
        $this->stockId = new StockId($command->stockId());
        $this->stockProductId = new StockProductId($command->stockProductId());
        $this->stockPhysicalQuantity = new StockPhysicalQuantity($command->stockPhysicalQuantity());
        $this->stockUsableQuantity = new StockUsableQuantity($command->stockUsableQuantity());

        $this->creator->__invoke(
            $this->stockId,
            $this->stockProductId,
            $this->stockPhysicalQuantity,
            $this->stockUsableQuantity,
        );
    }
}
