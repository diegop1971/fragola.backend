<?php

declare(strict_types=1);

namespace src\backoffice\Stock\Application\Delete;

use src\Shared\Domain\Bus\Command\Command;

final class DeleteStockCommand implements Command
{
    private $id;

    public function __construct(string $id)
    {
    	$this->id = $id;
    }

    public function stockId(): string
    {
        return $this->id;
    }
}
