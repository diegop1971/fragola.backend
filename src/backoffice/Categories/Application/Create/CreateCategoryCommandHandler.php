<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Create;

use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Categories\Domain\CategoryName;
use src\backoffice\Categories\Domain\CategoryEnabled;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Categories\Application\Create\CategoryCreator;
use src\backoffice\Categories\Application\Create\CreateCategoryCommand;

final class CreateCategoryCommandHandler implements CommandHandler
{
    private $id;
    private $name;
    private $enabled;

    public function __construct(private CategoryCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $this->id = new CategoryId($command->id());
        $this->name = new CategoryName($command->categoryName());
        $this->enabled = new CategoryEnabled($command->enabled());
        
        $this->creator->__invoke(
                                $this->id, 
                                $this->name, 
                                $this->enabled
                            );
    }
}
