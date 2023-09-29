<?php

declare(strict_types=1);

namespace src\frontoffice\Cart\Application\Delete;

use src\Shared\Domain\Bus\Command\CommandHandler;
use src\frontoffice\Cart\Application\Delete\CartItemDeleter;
use src\frontoffice\Cart\Application\Delete\DeleteCartItemCommand;

final class DeleteCartItemCommandHandler implements CommandHandler
{
    private $cartItemDeleter;

    public function __construct(CartItemDeleter $deleter)
    {
        $this->cartItemDeleter = $deleter;
    }

    public function __invoke(DeleteCartItemCommand $command)
    {
        $index = $command->cartIndex();

        $this->cartItemDeleter->__invoke($index);
    }
}
