<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Delete;

use src\Shared\Domain\Bus\Command\Command;

final class DeleteCategoryCommand implements Command
{
    private $id;

    public function __construct(string $id)
    {
    	$this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
