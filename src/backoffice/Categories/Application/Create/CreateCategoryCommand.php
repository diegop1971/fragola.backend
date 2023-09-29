<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Create;

use src\Shared\Domain\Bus\Command\Command;


final class CreateCategoryCommand implements Command
{   
    public function __construct(
        private string $id, 
        private string $name, 
        private bool $enabled
        )   {
    }

    public function id(): string
    {
        return $this->id;
    }
    
    public function categoryName(): string
    {
        return $this->name;
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }
}
