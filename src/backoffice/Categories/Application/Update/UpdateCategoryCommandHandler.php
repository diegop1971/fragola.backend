<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Update;

use src\backoffice\Categories\Domain\CategoryId;
use src\backoffice\Categories\Domain\CategoryName;
use src\backoffice\Categories\Domain\CategoryEnabled;
use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Categories\Application\Update\CategoryUpdater;
use src\backoffice\Categories\Application\Update\UpdateCategoryCommand;

final class UpdateCategoryCommandHandler implements CommandHandler
{
    private $id;
    private $name;
    private $enabled;

    public function __construct(private CategoryUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateCategoryCommand $command)
    {
        $this->id = new CategoryId($command->id());
        $this->name = new CategoryName($command->categoryName());
        $this->enabled = new CategoryEnabled($command->enabled());
        
        $this->updater->__invoke(
                                $this->id, 
                                $this->name, 
                                $this->enabled
                            );
    }
}
