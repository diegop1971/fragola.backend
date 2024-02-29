<?php

declare(strict_types=1);

namespace src\backoffice\StockMovements\Application\Delete;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Stock\Application\Delete\StockDeleter;
use src\backoffice\Stock\Application\Delete\DeleteStockCommand;


final class DeleteStockCommandHandler implements CommandHandler
{
    private $deleter;

    public function __construct(StockDeleter $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteStockCommand $command)
    {
        $id = $command->stockId();

        $this->deleter->__invoke($id);
    }
}
