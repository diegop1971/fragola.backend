<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Delete;

use src\Shared\Domain\Bus\Command\Command;

final class DeleteProductCommand implements Command
{
    private $id;

    public function __construct(string $id)
    {
    	$this->id = $id;
    }

    public function productId(): string
    {
        return $this->id;
    }
}
