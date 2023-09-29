<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Delete;

use src\Shared\Domain\Bus\Command\Command;

final class DeleteCartItemCommand implements Command
{
    private $index;

    public function __construct(int $index)
    {
    	$this->index = $index;
    }

    public function cartIndex(): int
    {
        return $this->index;
    }
}
