<?php

declare(strict_types=1);

namespace src\backoffice\Products\Application\Delete;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\backoffice\Products\Application\Delete\ProductDeleter;
use src\backoffice\Products\Application\Delete\DeleteProductCommand;

final class DeleteProductCommandHandler implements CommandHandler
{
    private $deleter;

    public function __construct(ProductDeleter $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteProductCommand $command)
    {
        $id = $command->productId();

        $this->deleter->__invoke($id);
    }
}
