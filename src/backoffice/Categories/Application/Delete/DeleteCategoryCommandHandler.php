<?php

declare(strict_types=1);

namespace src\backoffice\Categories\Application\Delete;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Categories\Application\Delete\CategoryDeleter;
use src\backoffice\Categories\Application\Delete\DeleteCategoryCommand;

final class DeleteCategoryCommandHandler implements CommandHandler
{
    private $deleter;

    public function __construct(CategoryDeleter $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteCategoryCommand $command)
    {
        $id = $command->id();

        $this->deleter->__invoke($id);
    }
}
